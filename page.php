<?php
/**
 * Page template.
 *
 * @package IchilovTop
 */

if (! defined('ABSPATH')) {
	exit;
}

get_header();
?>

<div class="content-area">
	<div class="container content-layout">
		<div class="page-content">
			<?php while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>

					<?php if (has_post_thumbnail()) : ?>
						<div class="page-thumbnail">
							<?php the_post_thumbnail('large'); ?>
						</div>
					<?php endif; ?>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; ?>
		</div>

		<aside class="sidebar-box">
			<span class="eyebrow"><?php esc_html_e('О клинике', 'ichilovtop'); ?></span>
			<h3><?php esc_html_e('Дополнительная информация', 'ichilovtop'); ?></h3>
			<p><?php esc_html_e('Этот шаблон подходит для внутренних страниц: о клинике, контакты, направления лечения, диагностика и сервис для пациентов.', 'ichilovtop'); ?></p>
		</aside>
	</div>
</div>

<?php
get_footer();
