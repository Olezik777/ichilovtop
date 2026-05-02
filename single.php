<?php
/**
 * Single post template.
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
		<div class="single-content">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<p class="post-meta"><?php echo esc_html(get_the_date()); ?></p>
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header>

						<?php if (has_post_thumbnail()) : ?>
							<div class="single-thumbnail">
								<?php the_post_thumbnail('large'); ?>
							</div>
						<?php endif; ?>

						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</article>
				<?php endwhile; ?>
			<?php else : ?>
				<p class="archive-empty"><?php esc_html_e('Запись не найдена.', 'ichilovtop'); ?></p>
			<?php endif; ?>
		</div>

		<aside class="sidebar-box">
			<span class="eyebrow"><?php esc_html_e('Публикации', 'ichilovtop'); ?></span>
			<h3><?php esc_html_e('Последние материалы', 'ichilovtop'); ?></h3>
			<ul>
				<?php
				$recent_posts = wp_get_recent_posts(
					array(
						'numberposts' => 5,
						'post_status' => 'publish',
					)
				);

				if (! empty($recent_posts)) :
					foreach ($recent_posts as $recent_post) :
						?>
						<li>
							<a href="<?php echo esc_url(get_permalink($recent_post['ID'])); ?>">
								<?php echo esc_html($recent_post['post_title']); ?>
							</a>
						</li>
						<?php
					endforeach;
				else :
					?>
					<li><?php esc_html_e('Пока нет опубликованных материалов.', 'ichilovtop'); ?></li>
				<?php endif; ?>
			</ul>
		</aside>
	</div>
</div>

<?php
get_footer();
