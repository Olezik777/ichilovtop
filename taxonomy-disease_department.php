<?php
/**
 * Taxonomy archive template for disease departments.
 *
 * @package IchilovTop
 */

if (! defined('ABSPATH')) {
	exit;
}

get_header();

$term = get_queried_object();
if (! ($term instanceof WP_Term)) {
	get_footer();
	return;
}

$parent_term = $term;
if ((int) $term->parent > 0) {
	$maybe_parent = get_term((int) $term->parent, 'disease_department');
	if ($maybe_parent instanceof WP_Term && ! is_wp_error($maybe_parent)) {
		$parent_term = $maybe_parent;
	}
}

$grouped = ichilovtop_group_diseases_by_department();
$section = null;
foreach ($grouped['sections'] as $candidate) {
	if ((int) $candidate['parent']->term_id === (int) $parent_term->term_id) {
		$section = $candidate;
		break;
	}
}

$catalog_blocks = array();
if ($section) {
	foreach ($section['blocks'] as $block) {
		if ((int) $term->parent > 0) {
			if (! empty($block['child']) && (int) $block['child']->term_id === (int) $term->term_id) {
				$catalog_blocks[] = array(
					'term'  => $block['child'],
					'title' => $block['child']->name,
					'posts' => $block['posts'],
				);
			}
			continue;
		}

		if (! empty($block['child']) && $block['child'] instanceof WP_Term) {
			$catalog_blocks[] = array(
				'term'  => $block['child'],
				'title' => $block['child']->name,
				'posts' => $block['posts'],
			);
			continue;
		}

		$catalog_blocks[] = array(
			'term'  => $term,
			'title' => __('Заболевания отделения', 'ichilovtop'),
			'posts' => $block['posts'],
		);
	}
}

if (empty($catalog_blocks)) {
	$fallback_query = new WP_Query(
		array(
			'post_type'              => 'disease',
			'post_status'            => 'publish',
			'posts_per_page'         => -1,
			'orderby'                => 'title',
			'order'                  => 'ASC',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => true,
			'tax_query'              => array(
				array(
					'taxonomy'         => 'disease_department',
					'field'            => 'term_id',
					'terms'            => (int) $term->term_id,
					'include_children' => true,
				),
			),
		)
	);

	if (! empty($fallback_query->posts)) {
		$catalog_blocks[] = array(
			'term'  => $term,
			'title' => $term->name,
			'posts' => $fallback_query->posts,
		);
	}
}

$total_diseases = 0;
foreach ($catalog_blocks as $block) {
	$total_diseases += count($block['posts']);
}

$hero_badge              = (int) $term->parent > 0 ? $parent_term->name : __('Отделение', 'ichilovtop');
$hero_title              = sprintf(__('Лечение заболеваний: %s', 'ichilovtop'), $term->name);
$hero_title_accent       = __('в клинике Ихилов', 'ichilovtop');
$hero_lede               = trim(wp_strip_all_tags(term_description($term, 'disease_department')));
$hero_search_placeholder = sprintf(__('Поиск по заболеванию в разделе %s...', 'ichilovtop'), $term->name);
$hero_icon               = ichilovtop_get_disease_department_icon_markup($term);
$hero_icon               = $hero_icon !== '' ? $hero_icon : ichilovtop_render_icon_markup('<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 21s7-4.4 7-10.5A7 7 0 0 0 5 10.5C5 16.6 12 21 12 21z"/><path d="M9 10h6"/><path d="M12 7v6"/></svg>');
$visible_limit           = 12;
$hero_image              = function_exists('get_field') ? get_field('disease_department_hero_image', $term) : null;
if (($hero_image === null || $hero_image === false || $hero_image === '') && function_exists('get_field')) {
	$hero_image = get_field('disease_department_hero_image', $term->taxonomy . '_' . $term->term_id);
}
if (($hero_image === null || $hero_image === false || $hero_image === '') && (int) $term->parent > 0 && function_exists('get_field')) {
	$hero_image = get_field('disease_department_hero_image', $parent_term);
	if ($hero_image === null || $hero_image === false || $hero_image === '') {
		$hero_image = get_field('disease_department_hero_image', $parent_term->taxonomy . '_' . $parent_term->term_id);
	}
}
$hero_image_url = ichilovtop_get_media_url($hero_image, 'large');
$hero_image_alt = $term->name;
if (is_array($hero_image) && ! empty($hero_image['alt'])) {
	$hero_image_alt = $hero_image['alt'];
}

$hero_cards = array();
foreach ($catalog_blocks as $block_index => $block) {
	$card_id = 'disease-term-block-' . ($block_index + 1);
	if (! empty($block['term']) && $block['term'] instanceof WP_Term) {
		$card_id = ichilovtop_disease_department_section_id($block['term']);
	}
	$hero_cards[] = array(
		'id'    => $card_id,
		'title' => $block['title'],
		'count' => count($block['posts']),
		'term'  => $block['term'] ?? null,
	);
}

$nav_items = $hero_cards;

$render_catalog_block = static function ($block, $index) use ($term, $hero_icon, $visible_limit) {
	$block_term  = ! empty($block['term']) && $block['term'] instanceof WP_Term ? $block['term'] : $term;
	$section_id  = ichilovtop_disease_department_section_id($block_term);
	$block_icon  = ichilovtop_get_disease_department_icon_markup($block_term);
	$block_icon  = $block_icon !== '' ? $block_icon : $hero_icon;
	$block_url   = get_term_link($block_term);
	$block_url   = is_wp_error($block_url) ? '#' . $section_id : $block_url;
	$block_desc  = trim((string) $block_term->description);
	$block_posts = $block['posts'];
	$search_text = array($block['title'], $block_desc);

	foreach ($block_posts as $d_post) {
		$search_text[] = get_the_title($d_post);
	}
	?>
	<article
		class="it-dept diseases-index__department"
		id="<?php echo esc_attr($section_id); ?>"
		data-name="<?php echo esc_attr($block['title']); ?>"
		data-search="<?php echo esc_attr(implode(' ', array_filter($search_text))); ?>"
	>
		<div class="it-dept-top">
			<span class="it-icn" aria-hidden="true">
				<?php echo $block_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</span>
			<div class="it-dept-title">
				<h3><a href="<?php echo esc_url($block_url); ?>"><?php echo esc_html($block['title']); ?></a></h3>
				<div class="it-meta">
					<span class="it-pill"><?php echo esc_html(ichilovtop_format_disease_count(count($block_posts))); ?></span>
					<?php if ($block_desc !== '') : ?>
						<span><?php echo esc_html($block_desc); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<ul class="it-list<?php echo count($block_posts) > $visible_limit ? ' is-collapsed' : ''; ?>"<?php echo count($block_posts) > $visible_limit ? ' data-collapsible="true"' : ''; ?>>
			<?php foreach ($block_posts as $item_index => $d_post) : ?>
				<li<?php echo $item_index >= $visible_limit ? ' class="it-hide"' : ''; ?>>
					<a href="<?php echo esc_url(get_permalink($d_post)); ?>"><?php echo esc_html(get_the_title($d_post)); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php if (count($block_posts) > $visible_limit) : ?>
			<div class="it-foot">
				<button class="it-more" type="button" data-more>
					<span><?php esc_html_e('Показать ещё', 'ichilovtop'); ?></span>
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
				</button>
			</div>
		<?php endif; ?>
	</article>
	<?php
};
?>

<div class="diseases-index disease-taxonomy<?php echo $hero_image_url === '' ? ' disease-taxonomy--no-image' : ''; ?>">
	<section class="it-hero">
		<div class="it-hero__bg" aria-hidden="true"></div>

		<div class="it-hero__inner">
			<div class="it-hero__left">
				<span class="it-hero__badge"><?php echo esc_html($hero_badge); ?></span>

				<h1 class="it-hero__title">
					<?php echo esc_html($hero_title); ?>
					<span class="it-hero__title-accent"><?php echo esc_html($hero_title_accent); ?></span>
				</h1>

				<?php if ($hero_lede !== '') : ?>
					<p class="it-hero__lede"><?php echo nl2br(esc_html($hero_lede)); ?></p>
				<?php else : ?>
					<p class="it-hero__lede"><?php echo esc_html__('Подберите заболевание в нужном направлении и отправьте заявку, чтобы получить предварительный план диагностики или лечения.', 'ichilovtop'); ?></p>
				<?php endif; ?>

				<form class="it-hero__search" onsubmit="return false;" role="search">
					<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>
					</svg>
					<input id="it-search" type="text" placeholder="<?php echo esc_attr($hero_search_placeholder); ?>" autocomplete="off" />
					<button type="submit" class="it-btn it-btn--primary"><?php esc_html_e('Найти', 'ichilovtop'); ?></button>
				</form>

				<ul class="it-hero__trust">
					<li>
						<span class="it-trust__icon"><?php echo $hero_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<div>
							<b><?php echo esc_html(ichilovtop_format_disease_count($total_diseases)); ?></b>
							<small><?php esc_html_e('в этом разделе', 'ichilovtop'); ?></small>
						</div>
					</li>
					<li>
						<span class="it-trust__icon">
							<?php echo ichilovtop_render_icon_markup('<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'); ?>
						</span>
						<div>
							<b><?php esc_html_e('24/7', 'ichilovtop'); ?></b>
							<small><?php esc_html_e('сопровождение пациента', 'ichilovtop'); ?></small>
						</div>
					</li>
					<li>
						<span class="it-trust__icon">
							<?php echo ichilovtop_render_icon_markup('<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>'); ?>
						</span>
						<div>
							<b><?php esc_html_e('72 ч', 'ichilovtop'); ?></b>
							<small><?php esc_html_e('организация диагностики', 'ichilovtop'); ?></small>
						</div>
					</li>
					<li>
						<span class="it-trust__icon">
							<?php echo ichilovtop_render_icon_markup('<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 1 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>'); ?>
						</span>
						<div>
							<b><?php esc_html_e('Tel Aviv', 'ichilovtop'); ?></b>
							<small><?php esc_html_e('Sourasky · JCI', 'ichilovtop'); ?></small>
						</div>
					</li>
				</ul>
			</div>

			<?php if ($hero_image_url !== '') : ?>
				<div class="it-hero__right disease-taxonomy__hero-media">
					<img src="<?php echo esc_url($hero_image_url); ?>" alt="<?php echo esc_attr($hero_image_alt); ?>" loading="eager" decoding="async">
				</div>
			<?php endif; ?>
		</div>
	</section>

	<section class="it-cat" id="diseases-catalog">
		<div class="it-wrap">
			<div class="it-cat-layout content-layout">
				<div class="it-cat-main">
					<div class="it-head">
						<div>
							<h2><?php echo esc_html(sprintf(__('Заболевания в разделе «%s»', 'ichilovtop'), $term->name)); ?></h2>
							<p><?php esc_html_e('Используйте поиск по названию заболевания или выберите нужное направление лечения.', 'ichilovtop'); ?></p>
						</div>
					</div>

					<?php if (! empty($catalog_blocks)) : ?>
						<div class="it-toolbar" role="search">
							<svg class="it-search-icn" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
							<input id="it-catalog-q" type="search" placeholder="<?php esc_attr_e('Поиск по заболеванию: рак, гастрит, аритмия...', 'ichilovtop'); ?>" autocomplete="off">
							<span class="it-count" id="it-catalog-count"><?php echo esc_html(ichilovtop_format_disease_count($total_diseases)); ?></span>
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
							<?php foreach ($catalog_blocks as $block_index => $block) : ?>
								<?php $render_catalog_block($block, $block_index); ?>
							<?php endforeach; ?>

							<div class="it-empty" id="it-catalog-empty"><?php esc_html_e('Ничего не найдено. Попробуйте изменить запрос.', 'ichilovtop'); ?></div>
						</div>
					<?php else : ?>
						<div class="it-empty is-show"><?php esc_html_e('В этом разделе пока нет опубликованных заболеваний.', 'ichilovtop'); ?></div>
					<?php endif; ?>
				</div>

				<aside class="sidebar-box sidebar-box--diseases-nav">
					<h3 class="diseases-index__nav-heading"><?php esc_html_e('Консультация', 'ichilovtop'); ?></h3>
					<p><?php esc_html_e('Оставьте заявку, и координатор поможет подобрать врача и программу диагностики.', 'ichilovtop'); ?></p>
					<a class="button" href="#contact" data-it-popup-open><?php esc_html_e('Получить консультацию', 'ichilovtop'); ?></a>

					<?php if (! empty($nav_items)) : ?>
						<nav class="diseases-index__nav" aria-label="<?php esc_attr_e('Навигация по заболеваниям раздела', 'ichilovtop'); ?>" data-diseases-nav>
							<ul class="diseases-index__nav-list">
								<?php foreach ($nav_items as $item) : ?>
									<li>
										<a class="diseases-index__nav-link" href="#<?php echo esc_attr($item['id']); ?>">
											<?php echo esc_html($item['title']); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</nav>
					<?php endif; ?>
				</aside>
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

		if (input) {
			input.addEventListener('input', function() {
				var query = input.value.trim().toLowerCase();
				cards.forEach(function(card) {
					var title = card.querySelector('.it-card__title').textContent.toLowerCase();
					var match = ! query || title.indexOf(query) !== -1;
					card.classList.toggle('is-dim', ! match);
					card.classList.toggle('is-hit', !! query && match);
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

		function diseaseWord(count) {
			var mod10 = count % 10;
			var mod100 = count % 100;
			if (mod10 === 1 && mod100 !== 11) {
				return 'заболевание';
			}
			if (mod10 >= 2 && mod10 <= 4 && (mod100 < 12 || mod100 > 14)) {
				return 'заболевания';
			}
			return 'заболеваний';
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
				var visibleDiseases = 0;
				var visibleSections = 0;

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
							visibleDiseases++;
						});
						resetMoreButton(department);
						visibleSections++;
						return;
					}

					if (hasMatch) {
						visibleSections++;
						var list = department.querySelector('.it-list');
						if (list) {
							list.classList.remove('is-collapsed');
						}
						Array.prototype.slice.call(department.querySelectorAll('.it-list li')).forEach(function(item) {
							var itemMatch = departmentMatch || item.textContent.toLowerCase().indexOf(query) !== -1;
							item.style.display = itemMatch ? '' : 'none';
							if (itemMatch) {
								visibleDiseases++;
							}
						});
						highlight(department, query);
					}
				});

				if (empty) {
					empty.classList.toggle('is-show', visibleSections === 0);
				}
				if (counter) {
					counter.textContent = visibleDiseases + ' ' + diseaseWord(visibleDiseases);
				}
			});
		}
	})();
</script>

<?php
get_footer();
