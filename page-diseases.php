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
<section class="it-hero">
	<div class="it-hero__bg" aria-hidden="true"></div>

	<div class="it-hero__inner">
		<div class="it-hero__left">
			<span class="it-hero__badge">Каталог заболеваний</span>

			<h1 class="it-hero__title">
				Лечение заболеваний в Израиле
				<span class="it-hero__title-accent">с ведущими специалистами Ихилов</span>
			</h1>

			<p class="it-hero__lede">
				Найдите нужное заболевание, направление лечения или получите
				предварительную консультацию по вашему диагнозу.
			</p>

			<form class="it-hero__search" onsubmit="return false;" role="search">
				<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>
				</svg>
				<input id="it-search" type="text" placeholder="Например: рак молочной железы, аритмия, грыжа диска..." autocomplete="off" />
				<button type="submit" class="it-btn it-btn--primary">Найти</button>
			</form>

			<ul class="it-hero__trust">
				<li>
					<span class="it-trust__icon">
						<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
					</span>
					<div><b>72 ч</b><small>организация диагностики</small></div>
				</li>
				<li>
					<span class="it-trust__icon">
						<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
					</span>
					<div><b>200+</b><small>врачей и профессоров</small></div>
				</li>
				<li>
					<span class="it-trust__icon">
						<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
					</span>
					<div><b>24/7</b><small>сопровождение пациента</small></div>
				</li>
				<li>
					<span class="it-trust__icon">
						<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 1 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>
					</span>
					<div><b>Tel Aviv</b><small>Sourasky · JCI</small></div>
				</li>
			</ul>
		</div>

		<div class="it-hero__right">
			<div class="it-grid" id="it-grid">
				<a class="it-card" data-id="onco" href="#onco">
					<span class="it-card__icon">
						<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
					</span>
					<div class="it-card__title">Онкология</div>
					<div class="it-card__count">64 заболевания</div>
				</a>

				<a class="it-card" data-id="cardio" href="#cardio">
					<span class="it-card__icon">
						<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
					</span>
					<div class="it-card__title">Кардиология</div>
					<div class="it-card__count">27 заболеваний</div>
				</a>

				<a class="it-card" data-id="neuro" href="#neuro">
					<span class="it-card__icon">
						<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 3a3 3 0 0 0-3 3v.5A3 3 0 0 0 4 9v3a3 3 0 0 0 1 2.24V17a3 3 0 0 0 4 2.83V21h2V3H9z"/><path d="M15 3a3 3 0 0 1 3 3v.5A3 3 0 0 1 20 9v3a3 3 0 0 1-1 2.24V17a3 3 0 0 1-4 2.83V21h-2V3h2z"/></svg>
					</span>
					<div class="it-card__title">Неврология</div>
					<div class="it-card__count">38 заболеваний</div>
				</a>

				<a class="it-card" data-id="ortho" href="#ortho">
					<span class="it-card__icon">
						<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 3a3 3 0 0 1 3 3 3 3 0 0 1-1 2.2 3 3 0 0 1 1 2.3 3 3 0 0 1-3 3l-1.5 1.5a3 3 0 0 1 0 4.2 3 3 0 0 1-4.2 0 3 3 0 0 1 0-4.2L13 13.5a3 3 0 0 1-3-3 3 3 0 0 1 1-2.3 3 3 0 0 1-1-2.2 3 3 0 0 1 3-3 3 3 0 0 1 2.3 1A3 3 0 0 1 17 3z"/></svg>
					</span>
					<div class="it-card__title">Ортопедия</div>
					<div class="it-card__count">31 заболевание</div>
				</a>

				<a class="it-card" data-id="pulmo" href="#pulmo">
					<span class="it-card__icon">
						<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2v18"/><path d="M5 8c-2 4-2 9 1 12 1 1 3 1 4-1V8"/><path d="M19 8c2 4 2 9-1 12-1 1-3 1-4-1V8"/></svg>
					</span>
					<div class="it-card__title">Пульмонология</div>
					<div class="it-card__count">19 заболеваний</div>
				</a>

				<a class="it-card" data-id="gastro" href="#gastro">
					<span class="it-card__icon">
						<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 3v4a4 4 0 0 0 4 4 5 5 0 0 1 5 5v3a3 3 0 0 1-6 0v-1a4 4 0 0 0-4-4H5"/></svg>
					</span>
					<div class="it-card__title">Гастроэнтерология</div>
					<div class="it-card__count">25 заболеваний</div>
				</a>

				<a class="it-card" data-id="eye" href="#eye">
					<span class="it-card__icon">
						<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
					</span>
					<div class="it-card__title">Офтальмология</div>
					<div class="it-card__count">14 заболеваний</div>
				</a>

				<a class="it-card" data-id="ped" href="#ped">
					<span class="it-card__icon">
						<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="9" r="4"/><path d="M4 21c0-4 4-7 8-7s8 3 8 7"/></svg>
					</span>
					<div class="it-card__title">Педиатрия</div>
					<div class="it-card__count">22 заболевания</div>
				</a>

				<a class="it-card" data-id="gen" href="#gen">
					<span class="it-card__icon">
						<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 2v4a4 4 0 0 1-4 4 4 4 0 0 0-4 4v4a4 4 0 0 0 4 4h2"/><circle cx="18" cy="14" r="3"/><path d="M18 17v4"/></svg>
					</span>
					<div class="it-card__title">Общая хирургия</div>
					<div class="it-card__count">45 заболеваний</div>
				</a>
			</div>

			<p class="it-hero__hint">Выберите направление — или воспользуйтесь поиском</p>
		</div>
	</div>
</section>

	<div class="container content-layout">
		<div class="page-content">
			<?php while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title">
							<?php echo esc_html($catalog_title !== '' ? $catalog_title : get_the_title()); ?>
						</h1>
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
				<section class="section-tight diseases-index__catalog">
					<div class="section-header diseases-index__catalog-header">
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
