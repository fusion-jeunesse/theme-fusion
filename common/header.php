<!DOCTYPE html>
<html class="<?php echo get_theme_option('Style Sheet'); ?>" lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo __($description); ?>">
    <?php endif; ?>

    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
	## Rendre le titre traduisibe - 20190806
    $titleParts[] = __(option('site_title'));
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <!-- Stylesheets -->
    <?php
    queue_css_url('//fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic');
    queue_css_file(array('iconfonts', 'normalize', 'style'), 'screen');
    queue_css_file('print', 'print');
    echo head_css();
    ?>
	<!-- Child them specifics -->
	<style type="text/css">
		/* Hide Item tags */
		#item-tags{ display: none; }
		/* Hide Item citation */
		#item-citation{ display: none; }
		/* Adjust comment styles */
		div.comment{ width: auto; min-width: 240px; max-width:600px; }
		div.comment-author{ width: 40px; white-space: nowrap; font-size: 80%; font-weight: bold; }
		#comments-container .comment-body { margin-left: 50px !important; min-height: 60px; }
		#comments-container .comment-author img.gravatar{ width:40px; }
		.comment-flag, .comment-unflag, .comment-reply{ margin: 0 0 0 10px; font-size: 80%; opacity: 0.5; }
		.comment-flag:hover, .comment-unflag:hover, .comment-reply:hover{ opacity: 1.0; }
		/* Hide Name, Website & Email fields from comment form */
		#comment-form .commenting-field:nth-child(1),
		#comment-form .commenting-field:nth-child(2),
		#comment-form .commenting-field:nth-child(3){ display: none; }
		#avantsearch-primary .search-form-section:last-of-type{ display: none; }
		
	</style>

    <!-- JavaScripts -->
    <?php 
    queue_js_file(array(
        'vendor/selectivizr',
        'vendor/jquery-accessibleMegaMenu',
        'vendor/respond',
        'jquery-extra-selectors',
        'seasons',
        'globals'
    )); 
    ?>

    <?php echo head_js(); ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <a href="#content" id="skipnav"><?php echo __('Skip to main content'); ?></a>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    <div id="wrap">
        <header role="banner">
            <div id="site-title">
                <?php echo link_to_home_page(theme_logo()); ?>
            </div>
			<?php if( current_user() ): ?>
            <div id="search-container" role="search">
                <?php if (get_theme_option('use_advanced_search') === null || get_theme_option('use_advanced_search')): ?>
                <?php echo search_form(array('show_advanced' => true)); ?>
                <?php else: ?>
                <?Php echo search_form(); ?>
                <?php endif; ?>
            </div>
			<?php endif ?>
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
        </header>

        <nav id="top-nav" class="top" role="navigation">
            <?php echo public_nav_main(); ?>
        </nav>

        <div id="content" role="main" tabindex="-1">
            <?php
                if(! is_current_url(WEB_ROOT)) {
                  fire_plugin_hook('public_content_top', array('view'=>$this));
                }
            ?>
