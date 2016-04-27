<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>



    <?php if (is_front_page()) : ?>      
      <header class="intro-header" style="background-image: url('/wp-content/themes/cmua/dist/images/slider4.JPG'); background-position-y: 25%;">
    <?php else :?>
      <header class="intro-header" style="background-image: url('/wp-content/themes/cmua/dist/images/slider5.JPG');">
    <?php endif; ?>           
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <?php if (is_front_page()) : ?> 
                      <div class="site-heading">
                    <?php else :?>
                      <div class="site-heading interior">
                  <?php endif; ?>
                        <h1>Central Maryland Ultimate Association</h1>
                        <hr class="small">
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php if (is_front_page()) : ?> 
      <section class="container" >
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          <p class="lead text-center">The mission of CMUA is to promote the growth and development of the sport of ultimate in the Baltimore metropolitan area by offering mixed, open, and women’s recreation leagues and tournaments, and by supporting local teams at the youth, college, and club levels.</p>   
          <hr>     
        </div>
      </section> 
    <?php endif;?>
   
    <div class="wrap container margin-bottom-2" role="document">
      <div class="content row ">
        <main class="main">
          <?php if (!is_front_page()) : ?> 

            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
                <?php if(function_exists('bcn_display') && !is_front_page())
                {
                    bcn_display();
                }?>
            </div>

          <?php endif; ?>

          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar margin-top-2">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
