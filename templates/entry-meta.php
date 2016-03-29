<?php if (has_tag('news', $post)) : ?>
	<p><time class="updated" datetime="<?= get_post_time('c', true); ?>">Posted: <strong><?= get_the_date(); ?></strong></time></p>
<?php endif; ?>
