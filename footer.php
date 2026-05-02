<?php
/**
 * Footer template.
 *
 * @package IchilovTop
 */

if (! defined('ABSPATH')) {
	exit;
}
?>
	</main>

	<footer class="site-footer">
		<div class="container site-footer__inner">
			<div class="site-footer__info">
				<p><strong><?php bloginfo('name'); ?></strong></p>
				<p><?php echo esc_html(get_bloginfo('description')); ?></p>
			</div>

		</div>
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
