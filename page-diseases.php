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

$catalog_department_count = count($grouped['sections']) + (! empty($grouped['uncategorized']) ? 1 : 0);
$catalog_department_word  = __('отделений', 'ichilovtop');
$catalog_mod_10           = $catalog_department_count % 10;
$catalog_mod_100          = $catalog_department_count % 100;
if ($catalog_mod_10 === 1 && $catalog_mod_100 !== 11) {
	$catalog_department_word = __('отделение', 'ichilovtop');
} elseif ($catalog_mod_10 >= 2 && $catalog_mod_10 <= 4 && ($catalog_mod_100 < 10 || $catalog_mod_100 >= 20)) {
	$catalog_department_word = __('отделения', 'ichilovtop');
}
$catalog_count_label = sprintf('%1$d %2$s', $catalog_department_count, $catalog_department_word);

$catalog_default_icon = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 21s7-4.4 7-10.5A7 7 0 0 0 5 10.5C5 16.6 12 21 12 21z"/><path d="M9 10h6"/><path d="M12 7v6"/></svg>';
$catalog_visible_limit = 6;

$render_catalog_card = static function ($section, $is_uncategorized = false) use ($catalog_default_icon, $catalog_visible_limit, $uncat_title) {
	$term              = $is_uncategorized ? null : $section['parent'];
	$section_id        = $is_uncategorized ? ichilovtop_disease_department_section_id('uncategorized') : ichilovtop_disease_department_section_id($term);
	$department_name   = $is_uncategorized ? $uncat_title : $term->name;
	$department_url    = '#' . $section_id;
	$department_icon   = $is_uncategorized ? '' : ichilovtop_get_disease_department_icon_markup($term);
	$department_icon   = $department_icon !== '' ? $department_icon : ichilovtop_render_icon_markup($catalog_default_icon);
	$disease_items     = array();
	$child_names       = array();
	$department_desc   = '';

	if (! $is_uncategorized && $term instanceof WP_Term) {
		$term_link = get_term_link($term);
		if (! is_wp_error($term_link)) {
			$department_url = $term_link;
		}
		$department_desc = trim((string) $term->description);
	}

	if ($is_uncategorized) {
		$disease_items = $section;
	} else {
		foreach ($section['blocks'] as $block) {
			if (! empty($block['child']) && $block['child'] instanceof WP_Term) {
				$child_names[] = $block['child']->name;
			}
			foreach ($block['posts'] as $d_post) {
				$disease_items[] = $d_post;
			}
		}
	}

	$total_diseases = count($disease_items);
	$meta_text      = $department_desc;
	if ($meta_text === '' && ! empty($child_names)) {
		$meta_text = implode(', ', array_slice(array_unique($child_names), 0, 3));
	}
	if ($meta_text === '' && $is_uncategorized) {
		$meta_text = __('Без привязки к отделению', 'ichilovtop');
	}

	$search_parts = array($department_name, $meta_text);
	foreach ($disease_items as $d_post) {
		$search_parts[] = get_the_title($d_post);
	}
	?>
	<article
		class="it-dept diseases-index__department"
		id="<?php echo esc_attr($section_id); ?>"
		data-name="<?php echo esc_attr($department_name); ?>"
		data-search="<?php echo esc_attr(implode(' ', array_filter($search_parts))); ?>"
	>
		<div class="it-dept-top">
			<span class="it-icn" aria-hidden="true">
				<?php echo $department_icon; ?>
			</span>
			<div class="it-dept-title">
				<h3><a href="<?php echo esc_url($department_url); ?>"><?php echo esc_html($department_name); ?></a></h3>
				<div class="it-meta">
					<span class="it-pill"><?php echo esc_html(ichilovtop_format_disease_count($total_diseases)); ?></span>
					<?php if ($meta_text !== '') : ?>
						<span><?php echo esc_html($meta_text); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<ul class="it-list<?php echo $total_diseases > $catalog_visible_limit ? ' is-collapsed' : ''; ?>"<?php echo $total_diseases > $catalog_visible_limit ? ' data-collapsible="true"' : ''; ?>>
			<?php foreach ($disease_items as $item_index => $d_post) : ?>
				<li<?php echo $item_index >= $catalog_visible_limit ? ' class="it-hide"' : ''; ?>>
					<a href="<?php echo esc_url(get_permalink($d_post)); ?>"><?php echo esc_html(get_the_title($d_post)); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php if ($total_diseases > $catalog_visible_limit || ! $is_uncategorized) : ?>
			<div class="it-foot">
				<?php if ($total_diseases > $catalog_visible_limit) : ?>
					<button class="it-more" type="button" data-more>
						<span><?php esc_html_e('Показать ещё', 'ichilovtop'); ?></span>
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
					</button>
				<?php endif; ?>
				<?php if (! $is_uncategorized) : ?>
					<a class="it-cta" href="<?php echo esc_url($department_url); ?>"><?php esc_html_e('Отделение', 'ichilovtop'); ?></a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</article>
	<?php
};
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

	<section class="it-cat" id="diseases-catalog">
		<div class="it-wrap">
			<div class="it-cat-layout content-layout">
				<div class="it-cat-main">
					<?php while (have_posts()) : the_post(); ?>
						<div class="it-head">
							<div>
								<h2><?php echo esc_html($catalog_title !== '' ? $catalog_title : get_the_title()); ?></h2>
								<?php if ($catalog_lead !== '') : ?>
									<p><?php echo esc_html($catalog_lead); ?></p>
								<?php endif; ?>
							</div>
						</div>

						<?php if (has_post_thumbnail()) : ?>
							<div class="it-cat__thumb">
								<?php the_post_thumbnail('large'); ?>
							</div>
						<?php endif; ?>

						<?php if (trim(get_the_content()) !== '') : ?>
							<div class="it-cat__intro entry-content">
								<?php the_content(); ?>
							</div>
						<?php endif; ?>
					<?php endwhile; ?>

					<?php
					$has_catalog = ! empty($grouped['sections']) || ! empty($grouped['uncategorized']);
					if ($has_catalog) :
						?>
						<div class="it-toolbar" role="search">
							<svg class="it-search-icn" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
							<input id="it-catalog-q" type="search" placeholder="<?php esc_attr_e('Поиск по заболеванию: рак, гастрит, аритмия...', 'ichilovtop'); ?>" autocomplete="off">
							<span class="it-count" id="it-catalog-count"><?php echo esc_html($catalog_count_label); ?></span>
							<div class="it-view" role="tablist" aria-label="<?php esc_attr_e('Вид каталога', 'ichilovtop'); ?>">
								<button type="button" class="is-active" data-view="grid" aria-pressed="true">
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
									<?php esc_html_e('Плитка', 'ichilovtop'); ?>
								</button>
								<button type="button" data-view="list" aria-pressed="false">
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
									<?php esc_html_e('Список', 'ichilovtop'); ?>
								</button>
							</div>
						</div>

						<div class="it-cat-grid" id="it-catalog-grid">
							<?php foreach ($grouped['sections'] as $section) : ?>
								<?php $render_catalog_card($section); ?>
							<?php endforeach; ?>

							<?php if (! empty($grouped['uncategorized'])) : ?>
								<?php $render_catalog_card($grouped['uncategorized'], true); ?>
							<?php endif; ?>

							<div class="it-empty" id="it-catalog-empty"><?php esc_html_e('Ничего не найдено. Попробуйте изменить запрос.', 'ichilovtop'); ?></div>
						</div>
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
	</section>
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

	(function() {
		var root = document.getElementById('diseases-catalog');
		if (! root) {
			return;
		}

		var input = document.getElementById('it-catalog-q');
		var counter = document.getElementById('it-catalog-count');
		var empty = document.getElementById('it-catalog-empty');
		var departments = Array.prototype.slice.call(root.querySelectorAll('.it-dept'));

		function departmentWord(count) {
			var mod10 = count % 10;
			var mod100 = count % 100;
			if (mod10 === 1 && mod100 !== 11) {
				return 'отделение';
			}
			if (mod10 >= 2 && mod10 <= 4 && (mod100 < 10 || mod100 >= 20)) {
				return 'отделения';
			}
			return 'отделений';
		}

		function clearMarks(node) {
			Array.prototype.slice.call(node.querySelectorAll('mark')).forEach(function(mark) {
				var parent = mark.parentNode;
				var text = document.createTextNode(mark.textContent);
				parent.replaceChild(text, mark);
				if (parent.normalize) {
					parent.normalize();
				}
			});
		}

		function highlight(node, query) {
			if (! query) {
				return;
			}
			var escaped = query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
			var rx = new RegExp('(' + escaped + ')', 'ig');
			Array.prototype.slice.call(node.querySelectorAll('.it-list a, h3 a')).forEach(function(link) {
				link.innerHTML = link.textContent.replace(rx, '<mark>$1</mark>');
			});
		}

		function resetMoreButton(department) {
			var list = department.querySelector('.it-list[data-collapsible]');
			var button = department.querySelector('[data-more]');
			if (! list || ! button) {
				return;
			}
			list.classList.add('is-collapsed');
			button.querySelector('span').textContent = 'Показать ещё';
			var svg = button.querySelector('svg');
			if (svg) {
				svg.style.transform = '';
			}
		}

		Array.prototype.slice.call(root.querySelectorAll('[data-more]')).forEach(function(button) {
			button.addEventListener('click', function() {
				var department = button.closest('.it-dept');
				var list = department ? department.querySelector('.it-list') : null;
				if (! list) {
					return;
				}
				var collapsed = list.classList.toggle('is-collapsed');
				button.querySelector('span').textContent = collapsed ? 'Показать ещё' : 'Свернуть';
				var svg = button.querySelector('svg');
				if (svg) {
					svg.style.transform = collapsed ? '' : 'rotate(90deg)';
				}
			});
		});

		Array.prototype.slice.call(root.querySelectorAll('.it-view button')).forEach(function(button) {
			button.addEventListener('click', function() {
				Array.prototype.slice.call(root.querySelectorAll('.it-view button')).forEach(function(item) {
					item.classList.remove('is-active');
					item.setAttribute('aria-pressed', 'false');
				});
				button.classList.add('is-active');
				button.setAttribute('aria-pressed', 'true');
				root.classList.toggle('is-list', button.getAttribute('data-view') === 'list');
			});
		});

		if (input) {
			input.addEventListener('input', function() {
				var query = input.value.trim().toLowerCase();
				var visible = 0;

				departments.forEach(function(department) {
					var departmentText = (department.getAttribute('data-name') || '').toLowerCase();
					var searchText = (department.getAttribute('data-search') || department.textContent || '').toLowerCase();
					var departmentMatch = query && departmentText.indexOf(query) !== -1;
					var hasMatch = ! query || departmentMatch || searchText.indexOf(query) !== -1;

					clearMarks(department);
					department.classList.toggle('is-hidden', ! hasMatch);

					if (! query) {
						Array.prototype.slice.call(department.querySelectorAll('.it-list li')).forEach(function(item) {
							item.style.display = '';
						});
						resetMoreButton(department);
						visible++;
						return;
					}

					if (hasMatch) {
						visible++;
						var list = department.querySelector('.it-list');
						if (list) {
							list.classList.remove('is-collapsed');
						}
						Array.prototype.slice.call(department.querySelectorAll('.it-list li')).forEach(function(item) {
							var itemMatch = departmentMatch || item.textContent.toLowerCase().indexOf(query) !== -1;
							item.style.display = itemMatch ? '' : 'none';
						});
						highlight(department, query);
					}
				});

				if (empty) {
					empty.classList.toggle('is-show', visible === 0);
				}
				if (counter) {
					counter.textContent = visible + ' ' + departmentWord(visible);
				}
			});
		}
	})();
</script>

<?php
get_footer();
