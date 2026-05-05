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

$hero_badge = ichilovtop_get_field(
	'diseases_index_hero_badge',
	__('Каталог заболеваний', 'ichilovtop'),
	$page_id
);
$hero_title = ichilovtop_get_field(
	'diseases_index_hero_title',
	__('Лечение заболеваний в Израиле', 'ichilovtop'),
	$page_id
);
$hero_title_accent = ichilovtop_get_field(
	'diseases_index_hero_title_accent',
	__('с ведущими специалистами Ихилов', 'ichilovtop'),
	$page_id
);
$hero_lede = ichilovtop_get_field(
	'diseases_index_hero_lede',
	__('Найдите нужное заболевание, направление лечения или получите предварительную консультацию по вашему диагнозу.', 'ichilovtop'),
	$page_id
);
$hero_search_placeholder = ichilovtop_get_field(
	'diseases_index_hero_search_placeholder',
	__('Например: рак молочной железы, аритмия, грыжа диска...', 'ichilovtop'),
	$page_id
);
$hero_search_button = ichilovtop_get_field(
	'diseases_index_hero_search_button',
	__('Найти', 'ichilovtop'),
	$page_id
);
$hero_hint = ichilovtop_get_field(
	'diseases_index_hero_hint',
	__('Выберите направление — или воспользуйтесь поиском', 'ichilovtop'),
	$page_id
);
$hero_trust_defaults = array(
	array(
		'value' => __('72 ч', 'ichilovtop'),
		'label' => __('организация диагностики', 'ichilovtop'),
	),
	array(
		'value' => __('200+', 'ichilovtop'),
		'label' => __('врачей и профессоров', 'ichilovtop'),
	),
	array(
		'value' => __('24/7', 'ichilovtop'),
		'label' => __('сопровождение пациента', 'ichilovtop'),
	),
	array(
		'value' => __('Tel Aviv', 'ichilovtop'),
		'label' => __('Sourasky · JCI', 'ichilovtop'),
	),
);
$hero_trust_items = ichilovtop_get_fixed_items(
	'diseases_index_hero_trust',
	4,
	array('value', 'label'),
	$hero_trust_defaults,
	$page_id
);
$hero_trust_icons = array(
	'<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>',
	'<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
	'<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
	'<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 1 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>',
);

$catalog_title = ichilovtop_get_field(
	'diseases_index_catalog_title',
	'',
	$page_id
);

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

<div class="diseases-index">
<section class="it-hero">
	<div class="it-hero__bg" aria-hidden="true"></div>

	<div class="it-hero__inner">
		<div class="it-hero__left">
			<span class="it-hero__badge"><?php echo esc_html($hero_badge); ?></span>

			<h1 class="it-hero__title">
				<?php echo esc_html($hero_title); ?>
				<?php if ($hero_title_accent !== '') : ?>
					<span class="it-hero__title-accent"><?php echo esc_html($hero_title_accent); ?></span>
				<?php endif; ?>
			</h1>

			<p class="it-hero__lede">
				<?php echo nl2br(esc_html($hero_lede)); ?>
			</p>

			<form class="it-hero__search" onsubmit="return false;" role="search">
				<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>
				</svg>
				<input id="it-search" type="text" placeholder="<?php echo esc_attr($hero_search_placeholder); ?>" autocomplete="off" />
				<button type="submit" class="it-btn it-btn--primary"><?php echo esc_html($hero_search_button); ?></button>
			</form>

			<ul class="it-hero__trust">
				<?php foreach ($hero_trust_items as $trust_index => $trust_item) : ?>
					<li>
						<span class="it-trust__icon">
							<?php echo ichilovtop_render_icon_markup($hero_trust_icons[ $trust_index ] ?? ''); ?>
						</span>
						<div>
							<b><?php echo esc_html($trust_item['value']); ?></b>
							<small><?php echo esc_html($trust_item['label']); ?></small>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="it-hero__right">
			<div class="it-grid" id="it-grid">
				<?php foreach ($grouped['sections'] as $hero_section) : ?>
					<?php
					$hero_term  = $hero_section['parent'];
					$hero_icon  = ichilovtop_get_disease_department_icon_markup($hero_term);
					$hero_count = ichilovtop_count_disease_department_posts($hero_section);
					$hero_id    = ichilovtop_disease_department_section_id($hero_term);
					?>
					<a class="it-card" data-id="<?php echo esc_attr($hero_id); ?>" href="#<?php echo esc_attr($hero_id); ?>">
						<?php if ($hero_icon !== '') : ?>
							<span class="it-card__icon" aria-hidden="true">
								<?php echo $hero_icon; ?>
							</span>
						<?php endif; ?>
						<div class="it-card__title"><?php echo esc_html($hero_term->name); ?></div>
						<div class="it-card__count"><?php echo esc_html(ichilovtop_format_disease_count($hero_count)); ?></div>
					</a>
				<?php endforeach; ?>
			</div>

			<p class="it-hero__hint"><?php echo esc_html($hero_hint); ?></p>
		</div>
	</div>
</section>

	<div id="diseases-catalog" class="container content-layout">
		<div class="page-content">
			<?php while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="entry-title">
						<?php echo esc_html($catalog_title !== '' ? $catalog_title : get_the_title()); ?>
					</h2>

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
				<section class="section-tight diseases-index__catalog">
					<div class="section-header diseases-index__catalog-header">
						<?php if ($catalog_lead !== '') : ?>
							<p class="section-description diseases-index__lead"><?php echo esc_html($catalog_lead); ?></p>
						<?php endif; ?>
					</div>

					<?php foreach ($grouped['sections'] as $section) : ?>
						<?php $department_icon = ichilovtop_get_disease_department_icon_markup($section['parent']); ?>
						<section
							class="diseases-index__department"
							id="<?php echo esc_attr(ichilovtop_disease_department_section_id($section['parent'])); ?>"
						>
							<h3 class="diseases-index__department-title">
								<?php if ($department_icon !== '') : ?>
									<span class="diseases-index__department-icon" aria-hidden="true">
										<?php echo $department_icon; ?>
									</span>
								<?php endif; ?>
								<span><?php echo esc_html($section['parent']->name); ?></span>
							</h3>
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
											<a class="diseases-index__item-title" href="<?php echo esc_url(get_permalink($d_post)); ?>"><?php echo esc_html(get_the_title($d_post)); ?></a>
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
										<a class="diseases-index__item-title" href="<?php echo esc_url(get_permalink($d_post)); ?>"><?php echo esc_html(get_the_title($d_post)); ?></a>
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

<script>
	(function() {
		var grid = document.getElementById('it-grid');
		if (! grid) {
			return;
		}

		var cards = Array.prototype.slice.call(grid.querySelectorAll('.it-card'));
		var input = document.getElementById('it-search');

		function highlight(filter) {
			cards.forEach(function(card) {
				var match = ! filter || card.getAttribute('data-id') === filter;
				card.classList.toggle('is-dim', !! filter && ! match);
				card.classList.toggle('is-hit', !! filter && match);
			});
		}

		if (input) {
			input.addEventListener('input', function() {
				var query = input.value.trim().toLowerCase();
				if (! query) {
					highlight(null);
					return;
				}

				cards.forEach(function(card) {
					var title = card.querySelector('.it-card__title').textContent.toLowerCase();
					var match = title.indexOf(query) !== -1;
					card.classList.toggle('is-dim', ! match);
					card.classList.toggle('is-hit', match);
				});
			});
		}
	})();
</script>

<?php
get_footer();
