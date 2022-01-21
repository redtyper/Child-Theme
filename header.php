<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <title><?php wp_title(); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

    <link type="text/css" rel="stylesheet" href="<?php echo bloginfo('template_url') ?>/css/lightslider.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo bloginfo('template_url') ?>/css/lightGallery.css"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="<?php echo bloginfo('template_url') ?>/js/lightslider.js"></script>
    <script src="<?php echo bloginfo('template_url') ?>/js/lightGallery.js"></script>

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>
    <?php wp_head(); ?>
</head>

<script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>

</head>
<body <?php body_class(); ?>>

<header class="size m0a">

    <div id="logo">
        <a href="<?= bloginfo('url') ?>" title="<?= bloginfo('description') ?>">
            <img src="<?php echo bloginfo('template_url') ?>/img/logo.png" alt="<?php echo bloginfo('name') ?>">
        </a>
    </div>
</header>