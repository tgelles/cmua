<article <?php post_class(); ?>>
  <header>
	<?php if( is_sticky() ) :?>
		<h1 class="sticky-title">Featured Article</h1>
	<?php endif;?>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php if (!is_sticky()) :?>
    		<?php get_template_part('templates/entry-meta'); ?>
  		<?php endif;?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>
