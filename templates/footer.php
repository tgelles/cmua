<footer class="content-info" id="foot">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    
    <p>&copy; <?php echo date("Y") ?> CMUA | Central Maryland Ultimate Association. All rights reserved. 
    	<?php if (is_user_logged_in()) : ?>
	    <a class="pull-right btn btn-primary" href="<?php echo wp_logout_url(get_permalink()); ?>">
	  		<span class="fa fa-wordpress fa-lg"></span> Logout
	  	</a>
	<?php else : ?>
		<a class="pull-right btn btn-primary" href="<?php echo wp_login_url(get_permalink()); ?>">
	  		<span class="fa fa-wordpress fa-lg"></span> Login
	  	</a>
	<?php endif;?>
		<a class="pull-right btn btn-primary" href="#">
	  		<span class="fa fa-facebook fa-lg"></span>
	  	</a>
    </p>

  </div>
</footer>
