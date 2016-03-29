<?php get_template_part('templates/page', 'header'); ?>

<?php while (have_posts()) : the_post(); ?>

<?php endwhile; ?>

<?php
  /* Include the Post-Format-specific template for the content.
   * If you want to override this in a child theme, then include a file
   * called content-___.php (where ___ is the Post Format name) and that will be used instead.
   */
  $description = term_description();
  echo term_description();

?>


<?php the_posts_navigation(); ?>
