<?php
/**
 * Single template for disease CPT.
 *
 * @package IchilovTop
 */

if (! defined('ABSPATH')) {
	exit;
}

get_header();

$post_id  = get_queried_object_id();
$defaults = ichilovtop_default_disease_content();

$banner_title            = ichilovtop_get_field('disease_banner_title', sprintf(__('Лечение %s', 'ichilovtop'), get_the_title()), $post_id);
$banner_title_accent     = ichilovtop_get_field('disease_banner_title_accent', __('в Израиле', 'ichilovtop'), $post_id);
$banner_subtitle         = ichilovtop_get_field('disease_banner_subtitle', __('Современные технологии. Индивидуальный подход. Высокий шанс на выздоровление.', 'ichilovtop'), $post_id);
$banner_stat_prefix      = ichilovtop_get_field('disease_banner_stat_prefix', __('До', 'ichilovtop'), $post_id);
$banner_stat_value       = ichilovtop_get_field('disease_banner_stat_value', '41%', $post_id);
$banner_stat_suffix      = ichilovtop_get_field('disease_banner_stat_suffix', __('пациентов - без операции', 'ichilovtop'), $post_id);
$banner_stat_note        = ichilovtop_get_field('disease_banner_stat_note', __('при раннем выявлении и правильно подобранной терапии', 'ichilovtop'), $post_id);
$banner_treatment_title  = ichilovtop_get_field('disease_banner_treatment_title', __('Комплексное лечение включает:', 'ichilovtop'), $post_id);
$banner_photo_url        = ichilovtop_get_image_url('disease_banner_photo', '', $post_id, 'large');
$banner_photo_alt        = ichilovtop_get_field('disease_banner_photo_alt', get_the_title(), $post_id);
$banner_stat_icon_svg    = ichilovtop_get_field('disease_banner_stat_icon_svg', '', $post_id);
$banner_stat_icon_image  = function_exists('get_field') ? get_field('disease_banner_stat_icon_image', $post_id) : '';
$banner_features         = ichilovtop_get_fixed_items('disease_banner_feature', 4, array('title', 'text', 'icon_svg', 'icon_image'), $defaults['banner_features'], $post_id);
$banner_treatments       = ichilovtop_get_fixed_items('disease_banner_treatment', 4, array('title', 'text', 'icon_svg', 'icon_image'), $defaults['banner_treatments'], $post_id);
$banner_benefits         = ichilovtop_get_fixed_items('disease_banner_benefit', 3, array('title', 'text', 'icon_svg', 'icon_image'), $defaults['banner_benefits'], $post_id);
$banner_feature_icons    = ichilovtop_default_disease_banner_feature_icons();
$banner_treatment_icons  = ichilovtop_default_disease_banner_treatment_icons();
$banner_benefit_icons    = ichilovtop_default_disease_banner_benefit_icons();
$banner_stat_icon_markup = ichilovtop_render_icon_markup($banner_stat_icon_svg, $banner_stat_icon_image, 'thumbnail');

if ($banner_photo_url === '' && has_post_thumbnail($post_id)) {
	$banner_photo_url = (string) get_the_post_thumbnail_url($post_id, 'large');
}

if ($banner_stat_icon_markup === '') {
	$banner_stat_icon_markup = ichilovtop_render_icon_markup(ichilovtop_default_disease_banner_stat_icon());
}

$intro_title       = ichilovtop_get_field('disease_intro_title', __('О заболевании', 'ichilovtop'), $post_id);
$intro_text        = ichilovtop_get_field('disease_intro_text', __('Опишите особенности заболевания, основные симптомы, когда стоит обратиться к врачу и почему важна своевременная диагностика.', 'ichilovtop'), $post_id);
$prices_title      = ichilovtop_get_field('disease_prices_title', __('Стоимость диагностики и лечения', 'ichilovtop'), $post_id);
$prices_text       = ichilovtop_get_field('disease_prices_text', __('Окончательная стоимость зависит от объема диагностики, стадии заболевания и выбранной программы лечения.', 'ichilovtop'), $post_id);
$price_rows        = ichilovtop_get_fixed_items('disease_price', 4, array('service', 'price'), $defaults['price_rows'], $post_id);
$advantages_title  = ichilovtop_get_field('disease_advantages_title', __('Преимущества лечения', 'ichilovtop'), $post_id);
$advantages_text   = ichilovtop_get_field('disease_advantages_text', __('Покажите сильные стороны лечения: опыт врачей, технологии, скорость диагностики и персонализированный подход.', 'ichilovtop'), $post_id);
$advantages        = ichilovtop_get_fixed_items('disease_advantage', 3, array('title', 'text'), $defaults['advantages'], $post_id);
$diagnostics_title = ichilovtop_get_field('disease_diagnostics_title', __('Методы диагностики', 'ichilovtop'), $post_id);
$diagnostics_text  = ichilovtop_get_field('disease_diagnostics_text', __('Опишите основные методы диагностики, которые используются для подтверждения диагноза и оценки состояния пациента.', 'ichilovtop'), $post_id);
$diagnostics       = ichilovtop_get_fixed_items('disease_diagnostic', 3, array('title', 'text'), $defaults['diagnostics'], $post_id);
$treatments_title  = ichilovtop_get_field('disease_treatments_title', __('Методы лечения', 'ichilovtop'), $post_id);
$treatments_text   = ichilovtop_get_field('disease_treatments_text', __('Опишите возможные подходы к лечению: медикаментозные схемы, малоинвазивные процедуры, операции и реабилитацию.', 'ichilovtop'), $post_id);
$treatments        = ichilovtop_get_fixed_items('disease_treatment', 3, array('title', 'text'), $defaults['treatments'], $post_id);
$faq_title         = ichilovtop_get_field('disease_faq_title', __('Частые вопросы', 'ichilovtop'), $post_id);
$faq_text          = ichilovtop_get_field('disease_faq_text', __('Ответьте на вопросы пациентов о сроках диагностики, стоимости и организационных деталях лечения.', 'ichilovtop'), $post_id);
$faq_items         = ichilovtop_get_fixed_items('disease_faq', 3, array('question', 'answer'), $defaults['faq'], $post_id);
?>

<article class="disease-page">
	<section class="section-tight disease-banner-section">
		<div class="container">
			<div class="disease-banner">
				<div class="disease-banner__top">
					<div class="disease-banner__left">
						<?php
				$disease_terms    = get_the_terms($post_id, 'disease_department');
				$eyebrow_label    = __('Заболевания', 'ichilovtop');
				if (! empty($disease_terms) && ! is_wp_error($disease_terms)) {
					$term = $disease_terms[0];
					// Walk up to the top-level ancestor.
					while ($term->parent !== 0) {
						$parent = get_term($term->parent, 'disease_department');
						if (is_wp_error($parent) || ! $parent) {
							break;
						}
						$term = $parent;
					}
					$eyebrow_label = $term->name;
					$eyebrow_url   = get_term_link($term, 'disease_department');
				}
				?>
				<?php if (isset($eyebrow_url) && ! is_wp_error($eyebrow_url)) : ?>
					<a class="eyebrow" href="<?php echo esc_url($eyebrow_url); ?>"><?php echo esc_html($eyebrow_label); ?></a>
				<?php else : ?>
					<span class="eyebrow"><?php echo esc_html($eyebrow_label); ?></span>
				<?php endif; ?>
						<h1 class="disease-banner__title">
							<?php echo esc_html($banner_title); ?>
							<span><?php echo esc_html($banner_title_accent); ?></span>
						</h1>
						<p class="disease-banner__subtitle"><?php echo esc_html($banner_subtitle); ?></p>
						<div class="disease-banner__features">
							<?php foreach ($banner_features as $index => $item) : ?>
								<?php
								$feature_icon_markup = ichilovtop_render_icon_markup($item['icon_svg'] ?? '', $item['icon_image'] ?? '', 'thumbnail');
								if ($feature_icon_markup === '' && isset($banner_feature_icons[ $index ])) {
									$feature_icon_markup = ichilovtop_render_icon_markup($banner_feature_icons[ $index ]);
								}
								?>
								<article class="disease-banner__feature">
									<div class="disease-banner__feature-icon"><?php echo $feature_icon_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
									<h2 class="disease-banner__feature-title"><?php echo esc_html($item['title'] ?? ''); ?></h2>
									<p class="disease-banner__feature-text"><?php echo esc_html($item['text'] ?? ''); ?></p>
								</article>
							<?php endforeach; ?>
						</div>
					</div>
					<?php if ($banner_photo_url !== '') : ?>
						<div class="disease-banner__photo">
							<img src="<?php echo esc_url($banner_photo_url); ?>" alt="<?php echo esc_attr($banner_photo_alt); ?>">
						</div>
					<?php endif; ?>
				</div>
				<div class="disease-banner__middle">
					<div class="disease-banner__stat">
						<div class="disease-banner__stat-icon"><?php echo $banner_stat_icon_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
						<div class="disease-banner__stat-content">
							<h2 class="disease-banner__stat-title">
								<?php echo esc_html($banner_stat_prefix); ?>
								<span class="disease-banner__stat-value"><?php echo esc_html($banner_stat_value); ?></span>
								<?php echo esc_html($banner_stat_suffix); ?>
							</h2>
							<p class="disease-banner__stat-note"><?php echo esc_html($banner_stat_note); ?></p>
						</div>
					</div>
					<div class="disease-banner__treatments">
						<h2 class="disease-banner__treatments-title"><?php echo esc_html($banner_treatment_title); ?></h2>
						<div class="disease-banner__treatments-grid">
							<?php foreach ($banner_treatments as $index => $item) : ?>
								<?php
								$treatment_icon_markup = ichilovtop_render_icon_markup($item['icon_svg'] ?? '', $item['icon_image'] ?? '', 'thumbnail');
								if ($treatment_icon_markup === '' && isset($banner_treatment_icons[ $index ])) {
									$treatment_icon_markup = ichilovtop_render_icon_markup($banner_treatment_icons[ $index ]);
								}
								?>
								<article class="disease-banner__treatment-item">
									<div class="disease-banner__treatment-icon"><?php echo $treatment_icon_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
									<div class="disease-banner__treatment-text">
										<h3 class="disease-banner__treatment-name"><?php echo esc_html($item['title'] ?? ''); ?></h3>
										<p class="disease-banner__treatment-desc"><?php echo esc_html($item['text'] ?? ''); ?></p>
									</div>
								</article>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="disease-banner__bottom">
					<?php foreach ($banner_benefits as $index => $item) : ?>
						<?php
						$benefit_icon_markup = ichilovtop_render_icon_markup($item['icon_svg'] ?? '', $item['icon_image'] ?? '', 'thumbnail');
						if ($benefit_icon_markup === '' && isset($banner_benefit_icons[ $index ])) {
							$benefit_icon_markup = ichilovtop_render_icon_markup($banner_benefit_icons[ $index ]);
						}
						?>
						<article class="disease-banner__bottom-item">
							<div class="disease-banner__bottom-icon"><?php echo $benefit_icon_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
							<div class="disease-banner__bottom-content">
								<h3 class="disease-banner__bottom-title"><?php echo esc_html($item['title'] ?? ''); ?></h3>
								<p class="disease-banner__bottom-text"><?php echo esc_html($item['text'] ?? ''); ?></p>
							</div>
						</article>
					<?php endforeach; ?>
					<a class="disease-banner__cta" href="#contact" data-it-popup-open>
						<span class="disease-banner__cta-main"><?php esc_html_e('Получить консультацию', 'ichilovtop'); ?></span>
						<span class="disease-banner__cta-sub"><?php esc_html_e('Узнайте свой план лечения', 'ichilovtop'); ?></span>
					</a>
				</div>
			</div>
		</div>
	</section>

	<section class="section disease-intro">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title"><?php echo esc_html($intro_title); ?></h2>
			</div>
			<div class="page-content">
				<div class="entry-content">
					<?php echo wp_kses_post(wpautop($intro_text)); ?>
					<?php if (get_the_content()) : ?>
						<?php the_content(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="section section-tight disease-prices">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title"><?php echo esc_html($prices_title); ?></h2>
				<p class="section-description"><?php echo esc_html($prices_text); ?></p>
			</div>
			<div class="price-table-wrap">
				<table class="price-table">
					<thead>
						<tr>
							<th><?php esc_html_e('Услуга', 'ichilovtop'); ?></th>
							<th><?php esc_html_e('Стоимость', 'ichilovtop'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($price_rows as $row) : ?>
							<tr>
								<td><?php echo esc_html($row['service'] ?? ''); ?></td>
								<td><?php echo esc_html($row['price'] ?? ''); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title"><?php echo esc_html($advantages_title); ?></h2>
				<p class="section-description"><?php echo esc_html($advantages_text); ?></p>
			</div>
			<div class="info-grid">
				<?php foreach ($advantages as $item) : ?>
					<article class="info-card">
						<h3><?php echo esc_html($item['title'] ?? ''); ?></h3>
						<p><?php echo esc_html($item['text'] ?? ''); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section section-tight">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title"><?php echo esc_html($diagnostics_title); ?></h2>
				<p class="section-description"><?php echo esc_html($diagnostics_text); ?></p>
			</div>
			<div class="info-grid">
				<?php foreach ($diagnostics as $item) : ?>
					<article class="info-card">
						<h3><?php echo esc_html($item['title'] ?? ''); ?></h3>
						<p><?php echo esc_html($item['text'] ?? ''); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title"><?php echo esc_html($treatments_title); ?></h2>
				<p class="section-description"><?php echo esc_html($treatments_text); ?></p>
			</div>
			<div class="info-grid">
				<?php foreach ($treatments as $item) : ?>
					<article class="info-card">
						<h3><?php echo esc_html($item['title'] ?? ''); ?></h3>
						<p><?php echo esc_html($item['text'] ?? ''); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section section-tight">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title"><?php echo esc_html($faq_title); ?></h2>
				<p class="section-description"><?php echo esc_html($faq_text); ?></p>
			</div>
			<div class="faq-grid">
				<?php foreach ($faq_items as $item) : ?>
					<article class="faq-card">
						<h3 class="faq-card__question"><?php echo esc_html($item['question'] ?? ''); ?></h3>
						<p><?php echo esc_html($item['answer'] ?? ''); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</article>

<?php
get_footer();
