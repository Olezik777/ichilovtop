<?php
/**
 * Front page template.
 *
 * @package IchilovTop
 */

if (! defined('ABSPATH')) {
	exit;
}

get_header();

$page_id   = get_queried_object_id();
$defaults  = ichilovtop_default_front_page_content();

$hero_eyebrow              = ichilovtop_get_field('hero_eyebrow', __('Лечение в Израиле без посредников', 'ichilovtop'), $page_id);
$hero_title                = ichilovtop_get_field('hero_title', __('Ichilov Top: диагностика и лечение в ведущем медицинском центре Израиля', 'ichilovtop'), $page_id);
$hero_text                 = ichilovtop_get_field('hero_text', __('Организуем обследование, второе мнение и лечение у профильных специалистов с прозрачной координацией для иностранных пациентов.', 'ichilovtop'), $page_id);
$hero_primary_button_text  = ichilovtop_get_field('hero_primary_button_text', __('Получить план лечения', 'ichilovtop'), $page_id);
$hero_primary_button_link  = ichilovtop_get_field('hero_primary_button_link', '#contact', $page_id);
$hero_secondary_button_text = ichilovtop_get_field('hero_secondary_button_text', __('Узнать стоимость', 'ichilovtop'), $page_id);
$hero_secondary_button_link = ichilovtop_get_field('hero_secondary_button_link', '#price', $page_id);
$hero_contact_title        = ichilovtop_get_field('hero_contact_title', __('Связаться с международным отделом', 'ichilovtop'), $page_id);
$hero_contact_text         = ichilovtop_get_field('hero_contact_text', __('Телефон, WhatsApp и первичный разбор медицинских документов доступны для иностранных пациентов.', 'ichilovtop'), $page_id);
$hero_stats                = ichilovtop_get_fixed_items('hero_stat', 3, array('value', 'label'), $defaults['hero_stats'], $page_id);
$hero_badges               = ichilovtop_get_fixed_items('hero_badge', 3, array('title', 'text'), $defaults['hero_badges'], $page_id);

$advantages_title          = ichilovtop_get_field('advantages_title', __('Почему пациенты выбирают Ichilov Top', 'ichilovtop'), $page_id);
$advantages_text           = ichilovtop_get_field('advantages_text', __('Мы собрали ключевые преимущества медицинского сервиса, ориентированного на результат, скорость и удобство для иностранных пациентов.', 'ichilovtop'), $page_id);
$advantages                = ichilovtop_get_fixed_items('advantage', 4, array('title', 'text'), $defaults['advantages'], $page_id);

$treatments_title          = ichilovtop_get_field('treatments_title', __('Основные направления лечения', 'ichilovtop'), $page_id);
$treatments_text           = ichilovtop_get_field('treatments_text', __('Сфокусировали главные медицинские направления, востребованные у пациентов, обращающихся за лечением в Израиль.', 'ichilovtop'), $page_id);
$treatments_highlight_title = ichilovtop_get_field('treatments_highlight_title', __('Комплексный подход к лечению', 'ichilovtop'), $page_id);
$treatments_highlight_text = ichilovtop_get_field('treatments_highlight_text', __('Для каждого пациента формируется индивидуальный медицинский маршрут: консультации, исследования, хирургия, лекарственная терапия и восстановление.', 'ichilovtop'), $page_id);
$treatments                = ichilovtop_get_fixed_items('treatment', 6, array('title', 'text'), $defaults['treatments'], $page_id);

$diagnostics_title         = ichilovtop_get_field('diagnostics_title', __('Диагностика и второе мнение', 'ichilovtop'), $page_id);
$diagnostics_text          = ichilovtop_get_field('diagnostics_text', __('Быстрая и точная диагностика помогает подтвердить диагноз, выявить риски и подобрать максимально эффективную тактику лечения.', 'ichilovtop'), $page_id);
$diagnostics_sidebar_title = ichilovtop_get_field('diagnostics_sidebar_title', __('Что включает диагностическая программа', 'ichilovtop'), $page_id);
$diagnostics_sidebar_list  = ichilovtop_get_field('diagnostics_sidebar_list', __("Консультации профильных врачей\nЛабораторные и визуализационные исследования\nПересмотр гистологии и снимков\nФинальное заключение и рекомендации", 'ichilovtop'), $page_id);
$diagnostics               = ichilovtop_get_fixed_items('diagnostic', 3, array('title', 'text'), $defaults['diagnostics'], $page_id);

$steps_title               = ichilovtop_get_field('steps_title', __('Как проходит лечение с Ichilov Top', 'ichilovtop'), $page_id);
$steps_text                = ichilovtop_get_field('steps_text', __('Пошаговый маршрут помогает заранее понимать сроки, бюджет и порядок действий.', 'ichilovtop'), $page_id);
$steps                     = ichilovtop_get_fixed_items('step', 5, array('title', 'text'), $defaults['steps'], $page_id);

$price_title               = ichilovtop_get_field('price_title', __('Стоимость и финансовая прозрачность', 'ichilovtop'), $page_id);
$price_text                = ichilovtop_get_field('price_text', __('Итоговая стоимость зависит от диагноза, объема диагностики, необходимости операции и выбранной программы лечения.', 'ichilovtop'), $page_id);
$price_value               = ichilovtop_get_field('price_value', __('Индивидуальный расчет', 'ichilovtop'), $page_id);
$price_note                = ichilovtop_get_field('price_note', __('После изучения документов мы подготавливаем предварительную смету и объясняем, из каких этапов она состоит.', 'ichilovtop'), $page_id);
$price_items               = ichilovtop_get_fixed_items('price_item', 4, array('item'), $defaults['price_items'], $page_id);

$international_title       = ichilovtop_get_field('international_title', __('Сервис для иностранных пациентов', 'ichilovtop'), $page_id);
$international_text        = ichilovtop_get_field('international_text', __('Мы понимаем, что лечение за границей требует не только сильной медицины, но и понятной организации поездки. Поэтому пациент получает не просто медицинский маршрут, а полноценную поддержку.', 'ichilovtop'), $page_id);
$international_sidebar_title = ichilovtop_get_field('international_sidebar_title', __('Что мы берем на себя', 'ichilovtop'), $page_id);
$international_sidebar_text = ichilovtop_get_field('international_sidebar_text', __('Коммуникация с клиникой, запись на приемы, помощь с организацией прибытия и сопровождение на месте.', 'ichilovtop'), $page_id);
$international_benefits    = ichilovtop_get_fixed_items('international_benefit', 3, array('title', 'text'), $defaults['international_benefits'], $page_id);

$faq_title                 = ichilovtop_get_field('faq_title', __('Частые вопросы', 'ichilovtop'), $page_id);
$faq_text                  = ichilovtop_get_field('faq_text', __('Собрали ответы на основные вопросы пациентов, планирующих диагностику или лечение в Израиле.', 'ichilovtop'), $page_id);
$faq_items                 = ichilovtop_get_fixed_items('faq_item', 4, array('question', 'answer'), $defaults['faq'], $page_id);

$cta_title                 = ichilovtop_get_field('cta_title', __('Получите персональный план диагностики или лечения', 'ichilovtop'), $page_id);
$cta_text                  = ichilovtop_get_field('cta_text', __('Отправьте документы, и мы поможем сориентироваться по срокам, врачам, стоимости и организационным вопросам.', 'ichilovtop'), $page_id);
$cta_primary_text          = ichilovtop_get_field('cta_primary_text', __('Отправить запрос', 'ichilovtop'), $page_id);
$cta_primary_link          = ichilovtop_get_field('cta_primary_link', 'mailto:info@ichilovtop.ru', $page_id);
$cta_secondary_text        = ichilovtop_get_field('cta_secondary_text', __('Позвонить', 'ichilovtop'), $page_id);
$cta_secondary_link        = ichilovtop_get_field('cta_secondary_link', 'tel:+97233760391', $page_id);
$contact_phone             = ichilovtop_get_field('contact_phone', '+972-3-376-0391', $page_id);
$contact_email             = ichilovtop_get_field('contact_email', 'info@ichilovtop.ru', $page_id);
$contact_address           = ichilovtop_get_field('contact_address', __("Израиль, Тель-Авив\nул. Вайцман, 14", 'ichilovtop'), $page_id);
$contact_schedule          = ichilovtop_get_field('contact_schedule', __('Ежедневно, 08:00-20:00', 'ichilovtop'), $page_id);

$diagnostics_list_items = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $diagnostics_sidebar_list)));
$contact_address_lines  = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $contact_address)));
?>

<section class="hero">
	<div class="container">
		<div class="hero__wrap">
			<div class="hero__content">
				<span class="eyebrow"><?php echo esc_html($hero_eyebrow); ?></span>
				<h1 class="hero__title"><?php echo esc_html($hero_title); ?></h1>
				<p class="hero__text"><?php echo esc_html($hero_text); ?></p>

				<div class="hero__actions">
					<a class="button" href="<?php echo esc_url($hero_primary_button_link); ?>"><?php echo esc_html($hero_primary_button_text); ?></a>
					<a class="button button-secondary" href="<?php echo esc_url($hero_secondary_button_link); ?>"><?php echo esc_html($hero_secondary_button_text); ?></a>
				</div>

				<div class="hero__stats">
					<?php foreach ($hero_stats as $stat) : ?>
						<div class="hero-stat">
							<strong><?php echo esc_html($stat['value'] ?? ''); ?></strong>
							<span><?php echo esc_html($stat['label'] ?? ''); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<aside class="hero__aside">
				<ul class="hero__badge-list">
					<?php foreach ($hero_badges as $badge) : ?>
						<li>
							<span class="hero__badge-icon">+</span>
							<div>
								<h3><?php echo esc_html($badge['title'] ?? ''); ?></h3>
								<p><?php echo esc_html($badge['text'] ?? ''); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>

				<div class="hero__contact">
					<strong><?php echo esc_html($hero_contact_title); ?></strong>
					<p><?php echo esc_html($hero_contact_text); ?></p>
					<p><a href="<?php echo esc_url('tel:' . preg_replace('/[^0-9+]/', '', $contact_phone)); ?>"><?php echo esc_html($contact_phone); ?></a></p>
					<p><a href="<?php echo esc_url('mailto:' . antispambot($contact_email)); ?>"><?php echo esc_html(antispambot($contact_email)); ?></a></p>
				</div>
			</aside>
		</div>
	</div>
</section>

<section id="advantages" class="section">
	<div class="container">
		<div class="section-header">
			<span class="eyebrow"><?php esc_html_e('Преимущества', 'ichilovtop'); ?></span>
			<h2 class="section-title"><?php echo esc_html($advantages_title); ?></h2>
			<p class="section-description"><?php echo esc_html($advantages_text); ?></p>
		</div>

		<div class="card-grid">
			<?php foreach ($advantages as $index => $item) : ?>
				<article class="card">
					<div class="card__number"><?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></div>
					<h3><?php echo esc_html($item['title'] ?? ''); ?></h3>
					<p><?php echo esc_html($item['text'] ?? ''); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section id="treatments" class="section">
	<div class="container">
		<div class="section-header">
			<span class="eyebrow"><?php esc_html_e('Направления', 'ichilovtop'); ?></span>
			<h2 class="section-title"><?php echo esc_html($treatments_title); ?></h2>
			<p class="section-description"><?php echo esc_html($treatments_text); ?></p>
		</div>

		<div class="treatments-layout">
			<div class="info-grid">
				<?php foreach ($treatments as $item) : ?>
					<article class="info-card">
						<h3><?php echo esc_html($item['title'] ?? ''); ?></h3>
						<p><?php echo esc_html($item['text'] ?? ''); ?></p>
					</article>
				<?php endforeach; ?>
			</div>

			<aside class="highlight-box">
				<span class="eyebrow"><?php esc_html_e('Подход', 'ichilovtop'); ?></span>
				<h3><?php echo esc_html($treatments_highlight_title); ?></h3>
				<p><?php echo esc_html($treatments_highlight_text); ?></p>
			</aside>
		</div>
	</div>
</section>

<section id="diagnostics" class="section">
	<div class="container">
		<div class="diagnostics-layout">
			<div>
				<div class="section-header">
					<span class="eyebrow"><?php esc_html_e('Диагностика', 'ichilovtop'); ?></span>
					<h2 class="section-title"><?php echo esc_html($diagnostics_title); ?></h2>
					<p class="section-description"><?php echo esc_html($diagnostics_text); ?></p>
				</div>

				<div class="stack">
					<?php foreach ($diagnostics as $item) : ?>
						<article class="info-card">
							<h3><?php echo esc_html($item['title'] ?? ''); ?></h3>
							<p><?php echo esc_html($item['text'] ?? ''); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>

			<aside class="sidebar-box">
				<span class="eyebrow"><?php esc_html_e('Программа', 'ichilovtop'); ?></span>
				<h3><?php echo esc_html($diagnostics_sidebar_title); ?></h3>
				<ul class="split-list">
					<?php foreach ($diagnostics_list_items as $list_item) : ?>
						<li><?php echo esc_html($list_item); ?></li>
					<?php endforeach; ?>
				</ul>
			</aside>
		</div>
	</div>
</section>

<section id="steps" class="section section-tight">
	<div class="container">
		<div class="section-header">
			<span class="eyebrow"><?php esc_html_e('Этапы', 'ichilovtop'); ?></span>
			<h2 class="section-title"><?php echo esc_html($steps_title); ?></h2>
			<p class="section-description"><?php echo esc_html($steps_text); ?></p>
		</div>

		<div class="steps-grid">
			<?php foreach ($steps as $index => $item) : ?>
				<article class="step-card">
					<div class="step-card__number"><?php echo esc_html((string) ($index + 1)); ?></div>
					<h3><?php echo esc_html($item['title'] ?? ''); ?></h3>
					<p><?php echo esc_html($item['text'] ?? ''); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section id="price" class="section">
	<div class="container">
		<div class="section-header">
			<span class="eyebrow"><?php esc_html_e('Стоимость', 'ichilovtop'); ?></span>
			<h2 class="section-title"><?php echo esc_html($price_title); ?></h2>
			<p class="section-description"><?php echo esc_html($price_text); ?></p>
		</div>

		<div class="stats-grid">
			<div class="price-card">
				<h3><?php esc_html_e('Предварительная оценка', 'ichilovtop'); ?></h3>
				<div class="price-card__value"><?php echo esc_html($price_value); ?></div>
				<ul>
					<?php foreach ($price_items as $item) : ?>
						<li><?php echo esc_html($item['item'] ?? ''); ?></li>
					<?php endforeach; ?>
				</ul>
				<p class="price-card__note"><?php echo esc_html($price_note); ?></p>
			</div>

			<div class="image-placeholder">
				<span class="image-placeholder__label"><?php esc_html_e('Прозрачный подход', 'ichilovtop'); ?></span>
				<h3><?php esc_html_e('Смета до приезда в клинику', 'ichilovtop'); ?></h3>
				<p><?php esc_html_e('Помогаем заранее понять, какие обследования и процедуры необходимы, сколько времени они займут и как будет организована оплата.', 'ichilovtop'); ?></p>
			</div>

			<div class="contact-card">
				<h3><?php esc_html_e('Нужно уточнить стоимость?', 'ichilovtop'); ?></h3>
				<p><?php esc_html_e('Отправьте выписки и результаты обследований, чтобы получить ориентировочный расчет и рекомендации по следующим шагам.', 'ichilovtop'); ?></p>
				<p><a class="button" href="#contact"><?php esc_html_e('Запросить расчет', 'ichilovtop'); ?></a></p>
			</div>
		</div>
	</div>
</section>

<section id="international" class="section">
	<div class="container">
		<div class="international-layout">
			<div>
				<div class="section-header">
					<span class="eyebrow"><?php esc_html_e('International Patients', 'ichilovtop'); ?></span>
					<h2 class="section-title"><?php echo esc_html($international_title); ?></h2>
					<p class="section-description"><?php echo esc_html($international_text); ?></p>
				</div>

				<div class="stack">
					<?php foreach ($international_benefits as $item) : ?>
						<article class="info-card">
							<h3><?php echo esc_html($item['title'] ?? ''); ?></h3>
							<p><?php echo esc_html($item['text'] ?? ''); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>

			<aside class="highlight-box">
				<span class="eyebrow"><?php esc_html_e('Поддержка', 'ichilovtop'); ?></span>
				<h3><?php echo esc_html($international_sidebar_title); ?></h3>
				<p><?php echo esc_html($international_sidebar_text); ?></p>
			</aside>
		</div>
	</div>
</section>

<section id="faq" class="section section-tight">
	<div class="container">
		<div class="section-header">
			<span class="eyebrow"><?php esc_html_e('FAQ', 'ichilovtop'); ?></span>
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

<section id="contact" class="section cta-section">
	<div class="container">
		<div class="cta-layout">
			<div>
				<span class="eyebrow"><?php esc_html_e('Контакты', 'ichilovtop'); ?></span>
				<h2 class="section-title"><?php echo esc_html($cta_title); ?></h2>
				<p class="section-description"><?php echo esc_html($cta_text); ?></p>

				<div class="cta-actions">
					<a class="button" href="<?php echo esc_url($cta_primary_link); ?>"><?php echo esc_html($cta_primary_text); ?></a>
					<a class="button button-secondary" href="<?php echo esc_url($cta_secondary_link); ?>"><?php echo esc_html($cta_secondary_text); ?></a>
				</div>
			</div>

			<div class="contact-card">
				<div class="contact-list">
					<div>
						<strong><?php esc_html_e('Телефон', 'ichilovtop'); ?></strong>
						<a href="<?php echo esc_url('tel:' . preg_replace('/[^0-9+]/', '', $contact_phone)); ?>"><?php echo esc_html($contact_phone); ?></a>
					</div>
					<div>
						<strong><?php esc_html_e('Email', 'ichilovtop'); ?></strong>
						<a href="<?php echo esc_url('mailto:' . antispambot($contact_email)); ?>"><?php echo esc_html(antispambot($contact_email)); ?></a>
					</div>
					<div>
						<strong><?php esc_html_e('Адрес', 'ichilovtop'); ?></strong>
						<p><?php echo esc_html(implode(', ', $contact_address_lines)); ?></p>
					</div>
					<div>
						<strong><?php esc_html_e('Часы работы', 'ichilovtop'); ?></strong>
						<p><?php echo esc_html($contact_schedule); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
