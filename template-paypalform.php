<?php
/**
 * Template Name: Paypal Form Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<script type="text/javascript">
jQuery(document).ready(function($){
$("#dynamic_content").append('<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"> <input type="hidden" name="cmd" value="_xclick"> <input type="hidden" name="business" value="web@md-ultimate.org"> <input type="hidden" name="currency_code" value="USD"> <input type="hidden" name="item_name" value="' + $("#description").html() + '"> <input type="hidden" name="amount" value="' + $("#cost").html() + '"> <input type="image" src="http://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it is fast, free and secure!"> </form>');
});
</script>
