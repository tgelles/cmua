    <nav class="navbar navbar-default navbar-custom navbar-fixed-top" role="banner">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>">
                  <img src="/wp-content/themes/cmua/dist/images/cmua-logo.png" alt="logo">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
         
    <div class="collapse navbar-collapse" role="navigation">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav navbar-right']);
      endif;
      ?>
    </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>



