<?php
/**
 * Template Name: Каталог заболеваний
 * Template for editable Diseases index page.
 *
 * WordPress also loads this file automatically for a Page whose slug is `diseases`
 * (URL `/diseases/`). CPT singles stay at `/diseases/{post-name}/` because
 * `has_archive` is disabled for the `disease` post type.
 *
 * @package IchilovTop
 */

if (! defined('ABSPATH')) {
	exit;
}

get_header();

$page_id = get_queried_object_id();

$catalog_title = ichilovtop_get_field(
	'diseases_index_catalog_title',
	'',
	$page_id
);
if ($catalog_title === '') {
	$catalog_title = __('Заболевания по направлениям', 'ichilovtop');
}

$catalog_lead = ichilovtop_get_field('diseases_index_catalog_lead', '', $page_id);

$uncat_title = ichilovtop_get_field(
	'diseases_index_uncategorized_title',
	'',
	$page_id
);
if ($uncat_title === '') {
	$uncat_title = __('Другие направления', 'ichilovtop');
}

$grouped = ichilovtop_group_diseases_by_department();

$nav_items = array();
foreach ($grouped['sections'] as $section_nav) {
	$nav_items[] = array(
		'id'    => ichilovtop_disease_department_section_id($section_nav['parent']),
		'label' => $section_nav['parent']->name,
	);
}
if (! empty($grouped['uncategorized'])) {
	$nav_items[] = array(
		'id'    => ichilovtop_disease_department_section_id('uncategorized'),
		'label' => $uncat_title,
	);
}
?>

<div class="content-area diseases-index">
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

			<?php
			$has_catalog = ! empty($grouped['sections']) || ! empty($grouped['uncategorized']);
			if ($has_catalog) :
				?>
				<section class="section-tight diseases-index__catalog" aria-labelledby="diseases-catalog-heading">
					<div class="section-header diseases-index__catalog-header">
						<h2 id="diseases-catalog-heading" class="section-title"><?php echo esc_html($catalog_title); ?></h2>
						<?php if ($catalog_lead !== '') : ?>
							<p class="section-description diseases-index__lead"><?php echo esc_html($catalog_lead); ?></p>
						<?php endif; ?>
					</div>

					<?php foreach ($grouped['sections'] as $section) : ?>
						<section
							class="diseases-index__department"
							id="<?php echo esc_attr(ichilovtop_disease_department_section_id($section['parent'])); ?>"
						>
							<h3 class="diseases-index__department-title"><?php echo esc_html($section['parent']->name); ?></h3>
							<?php if ($section['parent']->description) : ?>
								<p class="diseases-index__department-desc"><?php echo esc_html($section['parent']->description); ?></p>
							<?php endif; ?>

							<?php foreach ($section['blocks'] as $block) : ?>
								<?php if (! empty($block['child'])) : ?>
									<div class="diseases-index__sub">
										<h4 class="diseases-index__sub-title"><?php echo esc_html($block['child']->name); ?></h4>
										<?php if ($block['child']->description) : ?>
											<p class="diseases-index__sub-desc"><?php echo esc_html($block['child']->description); ?></p>
										<?php endif; ?>
									</div>
								<?php endif; ?>

								<ul class="diseases-index__list posts-grid">
									<?php foreach ($block['posts'] as $d_post) : ?>
										<li class="diseases-index__item post-card">
											<h5 class="diseases-index__item-title">
												<a href="<?php echo esc_url(get_permalink($d_post)); ?>"><?php echo esc_html(get_the_title($d_post)); ?></a>
											</h5>
											<?php
											$excerpt = get_the_excerpt($d_post);
											if ($excerpt !== '') :
												?>
												<p><?php echo esc_html($excerpt); ?></p>
											<?php endif; ?>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endforeach; ?>
						</section>
					<?php endforeach; ?>

					<?php if (! empty($grouped['uncategorized'])) : ?>
						<section
							class="diseases-index__department diseases-index__department--uncategorized"
							id="<?php echo esc_attr(ichilovtop_disease_department_section_id('uncategorized')); ?>"
						>
							<h3 class="diseases-index__department-title"><?php echo esc_html($uncat_title); ?></h3>
							<ul class="diseases-index__list posts-grid">
								<?php foreach ($grouped['uncategorized'] as $d_post) : ?>
									<li class="diseases-index__item post-card">
										<h5 class="diseases-index__item-title">
											<a href="<?php echo esc_url(get_permalink($d_post)); ?>"><?php echo esc_html(get_the_title($d_post)); ?></a>
										</h5>
										<?php
										$excerpt = get_the_excerpt($d_post);
										if ($excerpt !== '') :
											?>
											<p><?php echo esc_html($excerpt); ?></p>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						</section>
					<?php endif; ?>
				</section>
			<?php endif; ?>
		</div>

		<?php if (! empty($nav_items)) : ?>
			<aside class="sidebar-box sidebar-box--diseases-nav">
				<span class="eyebrow"><?php esc_html_e('Каталог', 'ichilovtop'); ?></span>
				<h3 class="diseases-index__nav-heading"><?php esc_html_e('Отделения', 'ichilovtop'); ?></h3>
				<nav class="diseases-index__nav" aria-label="<?php esc_attr_e('Навигация по отделениям на странице', 'ichilovtop'); ?>" data-diseases-nav>
					<ul class="diseases-index__nav-list">
						<?php foreach ($nav_items as $item) : ?>
							<li>
								<a class="diseases-index__nav-link" href="#<?php echo esc_attr($item['id']); ?>">
									<?php echo esc_html($item['label']); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
			</aside>
		<?php else : ?>
			<aside class="sidebar-box">
				<span class="eyebrow"><?php esc_html_e('Навигация', 'ichilovtop'); ?></span>
				<h3><?php esc_html_e('Разделы сайта', 'ichilovtop'); ?></h3>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'fallback_cb'    => 'wp_page_menu',
						'menu_class'     => 'menu',
					)
				);
				?>
			</aside>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
