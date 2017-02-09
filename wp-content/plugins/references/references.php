<?php
/*
Plugin Name: References
Description: Enables post references (for any type of publications) to connect articles to each other.
Version: 1.0
Author: Shra <to@shra.ru>
Author URI: http://shra.ru
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

	Copyright (C) 2016  Yuriy Korol aka SHRA

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/ 
 
class REFShraClass 
{
	
    public function __construct()
    {
		if (is_admin()){
			//Actions
			add_action('admin_enqueue_scripts', array($this, 'load_admin_style') );
			add_action('admin_menu', array($this, '_add_menu'));
			add_action('add_meta_boxes', array($this, 'metabox_init')); 
			add_action('save_post', array($this, 'metabox_save')); 
		}		
	}

	/* admin_menu hook */
	public function _add_menu() {
		add_options_page('Post references', 'Post references', 8, __FILE__, array($this, '_options_page'));
	}
	
	public function load_admin_style() {
		//add chosen jquery plugin
		wp_enqueue_style( 'references_chosen_css', plugin_dir_url( __FILE__ ) . 'admin/chosen.min.css', false, '1.0.0' );
		wp_enqueue_script( 'chosen_js', plugin_dir_url( __FILE__ ) . 'admin/chosen.jquery.min.js', array('jquery'), '1.0.0' );
		wp_enqueue_script( 'references_js', plugin_dir_url( __FILE__ ) . 'admin/references.js', array('jquery', 'chosen_js'), '1.0.0' );
	}
	
	/* create reference metabox in editor */
	public function metabox_init() {
		//load current options
		$ini = get_option('post_references_settings');		
		
		if (!empty($ini['refs'])) {
			foreach ($ini['refs'] as $v) 
				add_meta_box('reference_box_' . $v['id'], $v['ref_title'], array($this, 'metabox_showup'), $v['ref_post'], 'side', 'default', $v);
		}
	}
	
	/* render metabox */
	public function metabox_showup($post, $ref_data) {
		global $wpdb;
		if (empty($ref_data['args']['linked_post']))
			$ps = $wpdb->get_results("SELECT ID, post_title FROM {$wpdb->posts} WHERE post_status = 'publish' ORDER BY post_title", ARRAY_A);	
		else 
			$ps = $wpdb->get_results("SELECT ID, post_title FROM {$wpdb->posts} 
			WHERE post_status = 'publish' AND post_type in ('" . implode("','", $ref_data['args']['linked_post']) . "')  ORDER BY post_title", ARRAY_A);
		
		// Используем nonce для верификации
		wp_nonce_field( plugin_basename(__FILE__), 'reference_nonce' );
		
		$key = '_ref_' . $ref_data['args']['id'];
		echo $this->form_select($key, $ps, array('multy' => true, 'col_key' => 'ID', 'col' => 'post_title', 
			'class' => 'chosen', 'NULL' => false, 'value' => get_post_meta( $post->ID, $key, true )));
	}
	
	/* save metabox data */
	public function metabox_save($post_id) {
		
		// проверяем, если это автосохранение, то ничего не делаем с данными нашей формы.
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
			return $post_id;

		//нет данных
		if (empty($_POST)) return $post_id;
		
		// проверяем nonce нашей страницы, потому что save_post может быть вызван с другого места.
		if (! isset( $_POST['reference_nonce'] ) || ! wp_verify_nonce( $_POST['reference_nonce'], plugin_basename(__FILE__) ) )
			return $post_id;
		
		foreach ($_POST as $key => $value) {
			if (substr($key, 0, 5) != '_ref_') continue;
			update_post_meta( $post_id, $key, $value );
		}		
	}
	
    /* Options admin page */
    public function _options_page() {
		global $wpdb;
?>
<style>
	.refer {
		border: 1px solid #888;
		padding: 10px;
		border-radius: 2px;
		background-color: #eee;
		display: inline-block;
		vertical-align: top;
		margin: 0 5px 5px 0;
	}

</style>
<div class="wrap">
	<h2><?=__('References settings');?></h2>
	

<?		
		//load current options
		$ini = get_option('post_references_settings');	
	
		if (!empty($_POST['action']) ) {
			if (empty($_POST['ref_title'])) {
				echo '<div id="message" class="error notice is-dismissible">
						<p>' . __("Metabox title is empty!") . '</p></div>';
			} else {
			
				switch ($_POST['action']) {
				case 'manage_reference':
					//manage existing reference
					$index = $_POST['ref_index'];
				
					if ($_POST['sbm'] == __('Update')) {
						if (empty($_POST['linked_post'])) $_POST['linked_post'] = array();
						
						$ini['refs'][$index] = array(
							'ref_title' => $_POST['ref_title'],
							'ref_post' => $_POST['ref_post'],
							'linked_post' => $_POST['linked_post'],
							'id' => $_POST['ref_id'],
						);
						update_option('post_references_settings', $ini);
					}
					if ($_POST['sbm'] == __('Delete')) {
						unset($ini['refs'][$index]);
						$ini['refs'] = array_values($ini['refs']);
						update_option('post_references_settings', $ini);
						$wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE meta_key = '_ref_" . $_POST['id'] . "'");
					}
					break;
				case 'add_new_reference':
					if (!preg_match('#^[\w]+$#s', $_POST['ref_id']))
						echo '<div id="message" class="error notice is-dismissible">
							<p>' . __("Meta key contains invalid chars!") . '</p></div>';
					else {
						if (empty($_POST['linked_post'])) $_POST['linked_post'] = array();
						//new reference
						$ini['refs'][] = array(
							'ref_title' => $_POST['ref_title'],
							'ref_post' => $_POST['ref_post'],
							'linked_post' => $_POST['linked_post'],
							'id' => $_POST['ref_id'],
						);
						$ini['next_id'] ++;
						
						update_option('post_references_settings', $ini);
					}				
					break;
				}
			}
		}
		
		//post types
		$pt = get_post_types( array('public' => true), 'names');

		if (!empty($ini['refs'])) {
			echo "<p>" . __('Existing references.') . "</p>";
			
			foreach ($ini['refs'] as $k => $v) {
?>
	<div class="refer">
		<form method="post">
		<table>
		<tr valign="top"><td>
			<p>
				<b>Metabox Title *:</b><br />
				<input size="35" name="ref_title" type="text" value="<?=esc_attr($v['ref_title'])?>">
			</p>
			<p>
				<b>Content type:</b><br />
				<?=$this->form_select('ref_post', $pt, array('multy' => false, 'NULL' => false, 'value' => $v['ref_post'] ))?>
			</p>
			<p>
				<b>Used meta key:</b> _ref_<input size="10" type="text" name="ref_id" value="<?=esc_attr($v['id'])?>"><br />
				<small>Use this key to get data from postmetas inside of code.</small>
			</p>			
			<input type="hidden" name="ref_index" value="<?=$k?>" />
			<input type="hidden" name="action" value="manage_reference" />
			<input type="submit" class="button-primary" name="sbm" value="<?=__('Update')?>" />
			<input type="submit" class="button-primary" name="sbm" value="<?=__('Delete')?>" />
		</td>
		<td>&nbsp;</td>
		<td>
			<p>
				<b>Referenced post types :</b><br />
				Use CTRL to select more then one type.<br />
				<?=$this->form_select('linked_post', $pt, array('multy' => true, 'value' => $v['linked_post'], 'NULL' => false))?>
			</p>
		</td></tr>
		</table>
		</form>
	</div>
<?				
			}
		}
?>
	<p><?=__('Connect different types of publications.')?></p>
	<div class="refer">
		<form method="post">
		<table>
		<tr valign="top"><td>
			<p>
				<b>Metabox Title *:</b><br />
				<input size="35" name="ref_title" type="text" value="">
			</p>
			<p>
				<b>Add references metabox to editor of:</b><br />
				<?=$this->form_select('ref_post', $pt, array('multy' => false, 'NULL' => false))?>
			</p>
			<p>
				<b>Use meta key:</b> _ref_<input size="10" type="text" name="ref_id" value="<?=$ini['next_id']?>"><br />
				<small>Use this key [a-z0-9] to get data from postmetas inside of code.<br />
				For example: get_post_meta($post->ID, '_ref_<?=$ini['next_id']?>', true);
				</small>
			</p>				
			<input type="hidden" name="action" value="add_new_reference" />	
			<input type="submit" class="button-primary" name="sbm" value="<?=__('Add')?>" />
			
		</td>
		<td>&nbsp;</td>
		<td>
			<p>
				<b>Allow to connect only next types of articles:</b><br />
				Don't select any type if you need references to any type of records.<br/>
				Use CTRL to select more then one type.<br />
				<?=$this->form_select('linked_post', $pt, array('multy' => true, 'NULL' => false))?>
			</p>
		</td></tr>
		</table>
		</form>
	</div>

</div>
<?php
    }
	
	/* форирование выпадающего списка */
	public function form_select($id, $src, $args) {
		$defaults = array(
			'NULL' => true,
			'value' => '',
			'col' => '',
			'col_key' => '',
			'multy' => false,
			'class' => '',
		);
		$args = array_merge($defaults, $args);
		
		$options = '';
		
		//список может быть пуст
		if ($args['NULL']) 
			$options = '<option value="">---</option>';

		foreach ($src as $k => $v) {
			if (is_array($v)) {
				if (!empty($args['col']))
					$value = $v[$args['col']];
				else 
					$value = array_shift($v);

				if (!empty($args['col_key']))
					$key = $v[$args['col_key']];
				else 
					$key = $k;
				
			} else {
				$key = $k;
				$value = $v;
			}
			
			if ($args['multy'] && is_array($args['value']) && in_array($key, $args['value']))
				$options .= '<option value="' . $key . '" selected>' . $value . '</option>';
			else if (!$args['multy'] && $args['value'] !== '' && $key == $args['value'])
				$options .= '<option value="' . $key . '" selected>' . $value . '</option>';
			else
				$options .= '<option value="' . $key . '">' . $value . '</option>';
		}
		
		if ($args['multy'])
			return '<select class="' . $args['class'] . '" id="id_' . $id . '" name="' . $id . '[]" multiple>' . $options . '</select>';
		else
			return '<select class="' . $args['class'] . '" id="id_' . $id . '" name="' . $id . '">' . $options . '</select>';
	}	
	
	/* default settings */
	static function default_settings() {
		return array('refs' => array(), 'next_id' => 1);
	}
	
	/* install actions (when activate first time) */
    static function install() {
		global $wpdb;	
		//set defaults
		add_option('post_references_settings', REFShraClass::default_settings() );		
	}
	
	/* uninstall hook */
    static function uninstall() {
		global $wpdb;
		//delete_option('post_references_settings');
	}

} 

class ReferencesList_Widget extends WP_Widget {
    
	// widget constructor
	public function __construct(){
	
        parent::__construct(
            'rererenceslist_widget', 
			__('References List Widget'),
            array(
                'classname'   => 'rererenceslist_widget',
                'description' => __( 'A basic References List widget to output list of articles.')
                )
        );
	}
 
     /**  
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {    
        global $wpdb;
		if (!is_singular()) return false;
		$postID = get_the_ID(); 
		if (!$postID) return false;
		$post_type = get_post_type();

        extract( $args );
         
        $title      = apply_filters( 'widget_title', $instance['title'] );
        $message    = $instance['message'];
		$ref		= $instance['ref'];
         
		$ini = get_option('post_references_settings');
		foreach ($ini['refs'] as $v) {
			$id = '_ref_' . $v['id'];
			
			if ($id == $ref && $post_type == $v['ref_post']) {
				$ids = get_post_meta($postID, $id, true);

				if (empty($ids)) return false;
				
				$pubs = $wpdb->get_results("SELECT post_title, guid
					FROM {$wpdb->posts} WHERE post_status = 'publish' 
					AND ID in (" . implode(',', $ids) . ")");
				
				if (empty($pubs)) return false;
				
				echo $before_widget;
				 
				if ( $title ) {
					echo $before_title . $title . $after_title;
				}

				echo $message;
				
				echo "<ul>";
				foreach ($pubs as $v) 
					echo '<li><a href="' . $v->guid . '">' . $v->post_title . '</a></li>';
				echo "</ul>";

				echo $after_widget;
			}
		}
    }
 
    public function update( $new_instance, $old_instance ) {        
         
        $instance = $old_instance;
         
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['message'] = strip_tags( $new_instance['message'] );
		$instance['ref'] = strip_tags( $new_instance['ref'] );
		
        return $instance;
         
    }
    
	public function form( $instance ) {
		// creates the back-end form
		$instance = array_merge(array('title' => '', 'message' => '', 'ref' => ''), $instance);
		
        $title      = esc_attr( $instance['title'] );
        $message    = esc_attr( $instance['message'] );
		$ref        = esc_attr( $instance['ref'] );
		
		$ini = get_option('post_references_settings');
		
		if (empty($ini['refs'])) {
			echo __('You should create record(s) on <a href="/wp-admin/options-general.php?page=references%2Freferences.php">
			References settings page</a> first.');
		} else {
			$selector = '';
			foreach ($ini['refs'] as $v) {
				$id = '_ref_' . $v['id'];
				$selector .= '<option ' . ($id == $ref ? 'selected' : '') . ' value="' . $id . '">' . esc_attr($v['ref_title']) . ' (' . $v['id'] . ')' .  '</option>';
			}
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Description'); ?></label> 
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>"><?php echo $message; ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('ref'); ?>"><?php _e('References'); ?></label> 
            <select class="widefat" id="<?php echo $this->get_field_id('ref'); ?>" name="<?php echo $this->get_field_name('ref'); ?>"><?php echo $selector; ?></select>
        </p>		
<?php 
		}

	}
    
}

register_uninstall_hook( __FILE__, array('REFShraClass', 'uninstall'));
register_activation_hook( __FILE__, array('REFShraClass', 'install') );

$ref_obj = new REFShraClass();
	
/* Register the widgets */
add_action( 'widgets_init', function(){
	register_widget( 'ReferencesList_Widget');
});	

if (isset($ref_obj)) {
	//to do:
	;
}
