<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>><head>
<!-- SEO -->
<title><?php the_title(); echo (' | '); bloginfo('name'); ?></title>
<!-- End SEO -->
<!-- Mobile devices browser configuration -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="description" content="<?php bloginfo('description');?>"/>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">

<!-- stylesheets -->
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" charset="utf-8" />
<link href="<?php bloginfo('template_url'); ?>/carkod5.css" rel="stylesheet" type="text/css" charset="utf-8" />
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css" charset="utf-8" />
<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet" type="text/css" charset="utf-8" />


<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />
<!-- scripts  -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/hc-sticky.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/analogclock.js"></script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>