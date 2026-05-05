<?php
/**
 * ACF local field group registration for Ichilov Top.
 *
 * @package IchilovTop
 */

if (! defined('ABSPATH')) {
	exit;
}

// ─────────────────────────────────────────────
// Default content helpers
// ─────────────────────────────────────────────

function ichilovtop_default_front_page_content() {
	return array(
		'hero_stats' => array(
			array(
				'value' => '1250+',
				'label' => __('врачей и специалистов международного уровня', 'ichilovtop'),
			),
			array(
				'value' => '10 000+',
				'label' => __('иностранных пациентов ежегодно', 'ichilovtop'),
			),
			array(
				'value' => '3-5 дней',
				'label' => __('на комплексную диагностику и второе мнение', 'ichilovtop'),
			),
		),
		'hero_badges' => array(
			array(
				'title' => __('Лечение без посредников', 'ichilovtop'),
				'text'  => __('Координация через международный отдел клиники с прозрачной организацией процесса.', 'ichilovtop'),
			),
			array(
				'title' => __('Современная диагностика', 'ichilovtop'),
				'text'  => __('Высокоточные протоколы обследования и персонализированный план лечения.', 'ichilovtop'),
			),
			array(
				'title' => __('Поддержка иностранных пациентов', 'ichilovtop'),
				'text'  => __('Трансфер, перевод, сопровождение и помощь в логистике на всех этапах.', 'ichilovtop'),
			),
		),
		'advantages' => array(
			array(
				'title' => __('Лицензированная клиника', 'ichilovtop'),
				'text'  => __('Международный отдел помогает организовать лечение напрямую и без лишних посредников.', 'ichilovtop'),
			),
			array(
				'title' => __('Новейшее оборудование', 'ichilovtop'),
				'text'  => __('Диагностика и терапия выполняются на современном оборудовании экспертного уровня.', 'ichilovtop'),
			),
			array(
				'title' => __('Поэтапная оплата', 'ichilovtop'),
				'text'  => __('Финансовый план прозрачен: пациент оплачивает только назначенные процедуры.', 'ichilovtop'),
			),
			array(
				'title' => __('Медицинское сопровождение', 'ichilovtop'),
				'text'  => __('Координаторы остаются на связи до, во время и после завершения лечения.', 'ichilovtop'),
			),
		),
		'treatments' => array(
			array(
				'title' => __('Онкология', 'ichilovtop'),
				'text'  => __('Персонализированные схемы терапии, хирургия, радиотерапия и второе мнение экспертов.', 'ichilovtop'),
			),
			array(
				'title' => __('Кардиология и кардиохирургия', 'ichilovtop'),
				'text'  => __('Комплексная диагностика сердца, лечение сложных сердечно-сосудистых заболеваний.', 'ichilovtop'),
			),
			array(
				'title' => __('Нейрохирургия и неврология', 'ichilovtop'),
				'text'  => __('Высокоточная диагностика и малоинвазивные нейрохирургические вмешательства.', 'ichilovtop'),
			),
			array(
				'title' => __('Ортопедия и травматология', 'ichilovtop'),
				'text'  => __('Эндопротезирование, спортивная медицина, восстановление опорно-двигательной системы.', 'ichilovtop'),
			),
			array(
				'title' => __('Гинекология и репродуктивная медицина', 'ichilovtop'),
				'text'  => __('Лечение гинекологических заболеваний и экспертные программы для женщин.', 'ichilovtop'),
			),
			array(
				'title' => __('Педиатрия', 'ichilovtop'),
				'text'  => __('Диагностика и лечение детей в профильных отделениях с международным сопровождением.', 'ichilovtop'),
			),
		),
		'diagnostics' => array(
			array(
				'title' => __('Экспресс-диагностика за 3-5 дней', 'ichilovtop'),
				'text'  => __('Сжатые сроки обследования без потери качества и клинической точности.', 'ichilovtop'),
			),
			array(
				'title' => __('Второе мнение профессора', 'ichilovtop'),
				'text'  => __('Пересмотр диагноза и подтверждение тактики лечения ведущими специалистами.', 'ichilovtop'),
			),
			array(
				'title' => __('Индивидуальный маршрут пациента', 'ichilovtop'),
				'text'  => __('Все исследования и консультации выстраиваются в понятную, заранее согласованную схему.', 'ichilovtop'),
			),
		),
		'steps' => array(
			array(
				'title' => __('Заявка', 'ichilovtop'),
				'text'  => __('Вы отправляете запрос и медицинские документы через сайт или мессенджер.', 'ichilovtop'),
			),
			array(
				'title' => __('Предварительная оценка', 'ichilovtop'),
				'text'  => __('Координатор и профильный специалист изучают случай и предлагают маршрут.', 'ichilovtop'),
			),
			array(
				'title' => __('План и смета', 'ichilovtop'),
				'text'  => __('Вы получаете сроки, ориентировочную стоимость и перечень процедур.', 'ichilovtop'),
			),
			array(
				'title' => __('Приезд в Израиль', 'ichilovtop'),
				'text'  => __('Организуем трансфер, перевод, запись к врачам и бытовое сопровождение.', 'ichilovtop'),
			),
			array(
				'title' => __('Лечение и контроль', 'ichilovtop'),
				'text'  => __('После очных процедур остаемся на связи и помогаем с дальнейшими рекомендациями.', 'ichilovtop'),
			),
		),
		'price_items' => array(
			array(
				'item' => __('Предварительная консультация и разбор документов', 'ichilovtop'),
			),
			array(
				'item' => __('Индивидуальный план диагностики или лечения', 'ichilovtop'),
			),
			array(
				'item' => __('Поддержка международного координатора', 'ichilovtop'),
			),
			array(
				'item' => __('Прозрачная стоимость без скрытых этапов', 'ichilovtop'),
			),
		),
		'international_benefits' => array(
			array(
				'title' => __('Персональный координатор', 'ichilovtop'),
				'text'  => __('Один контактный человек сопровождает пациента от первой заявки до завершения программы.', 'ichilovtop'),
			),
			array(
				'title' => __('Перевод и документы', 'ichilovtop'),
				'text'  => __('Помогаем с переводом заключений, выписок и общением с медицинской командой.', 'ichilovtop'),
			),
			array(
				'title' => __('Логистика поездки', 'ichilovtop'),
				'text'  => __('Поддержка с трансфером, проживанием и организационными вопросами в Израиле.', 'ichilovtop'),
			),
		),
		'faq' => array(
			array(
				'question' => __('Можно ли получить предварительное мнение дистанционно?', 'ichilovtop'),
				'answer'   => __('Да. Вы можете отправить документы онлайн, после чего координатор поможет организовать предварительный разбор случая и предложит дальнейшие шаги.', 'ichilovtop'),
			),
			array(
				'question' => __('Сколько времени занимает диагностика?', 'ichilovtop'),
				'answer'   => __('Во многих программах ключевые обследования можно пройти в течение 3-5 рабочих дней, в зависимости от профиля заболевания.', 'ichilovtop'),
			),
			array(
				'question' => __('Помогаете ли вы с проживанием и трансфером?', 'ichilovtop'),
				'answer'   => __('Да. Международный отдел координирует трансфер, размещение и бытовые вопросы, чтобы пациент сосредоточился на лечении.', 'ichilovtop'),
			),
			array(
				'question' => __('Как формируется стоимость лечения?', 'ichilovtop'),
				'answer'   => __('После оценки документов составляется предварительный план с ориентировочной стоимостью, а оплата проходит поэтапно по мере выполнения услуг.', 'ichilovtop'),
			),
		),
	);
}

function ichilovtop_default_disease_content() {
	return array(
		'banner_features' => array(
			array(
				'title' => __('Индивидуальный подбор лечения', 'ichilovtop'),
				'text'  => __('на основе генетических и молекулярных исследований', 'ichilovtop'),
			),
			array(
				'title' => __('Таргетная и иммунотерапия', 'ichilovtop'),
				'text'  => __('точечное воздействие на опухоль', 'ichilovtop'),
			),
			array(
				'title' => __('Лучевая терапия TrueBeam', 'ichilovtop'),
				'text'  => __('высокая точность, минимум вреда для здоровых тканей', 'ichilovtop'),
			),
			array(
				'title' => __('Современная диагностика', 'ichilovtop'),
				'text'  => __('быстрое и точное определение стадии', 'ichilovtop'),
			),
		),
		'banner_treatments' => array(
			array(
				'title' => __('Хирургические операции', 'ichilovtop'),
				'text'  => __('(лампэктомия / мастэктомия)', 'ichilovtop'),
			),
			array(
				'title' => __('Химиотерапия', 'ichilovtop'),
				'text'  => __('современные препараты', 'ichilovtop'),
			),
			array(
				'title' => __('Гормональная терапия', 'ichilovtop'),
				'text'  => __('для гормонозависимых форм', 'ichilovtop'),
			),
			array(
				'title' => __('Биологические препараты', 'ichilovtop'),
				'text'  => __('таргетная и иммунная терапия', 'ichilovtop'),
			),
		),
		'banner_benefits' => array(
			array(
				'title' => __('Врачи мирового уровня', 'ichilovtop'),
				'text'  => __('опытные онкологи, международные стандарты лечения', 'ichilovtop'),
			),
			array(
				'title' => __('Современные протоколы', 'ichilovtop'),
				'text'  => __('индивидуальный план лечения для каждого пациента', 'ichilovtop'),
			),
			array(
				'title' => __('Стоимость ниже, чем в Европе и США', 'ichilovtop'),
				'text'  => __('высокое качество по разумной цене', 'ichilovtop'),
			),
		),
		'price_rows' => array(
			array(
				'service' => __('Первичная консультация профильного специалиста', 'ichilovtop'),
				'price'   => __('от $450', 'ichilovtop'),
			),
			array(
				'service' => __('Комплексная диагностическая программа', 'ichilovtop'),
				'price'   => __('от $1,500', 'ichilovtop'),
			),
			array(
				'service' => __('Пересмотр анализов и снимков', 'ichilovtop'),
				'price'   => __('от $350', 'ichilovtop'),
			),
			array(
				'service' => __('Повторная консультация с планом лечения', 'ichilovtop'),
				'price'   => __('от $300', 'ichilovtop'),
			),
		),
		'advantages' => array(
			array(
				'title' => __('Профильные специалисты', 'ichilovtop'),
				'text'  => __('Пациент получает маршрут лечения у врачей, которые регулярно работают со сложными случаями данного заболевания.', 'ichilovtop'),
			),
			array(
				'title' => __('Точная диагностика', 'ichilovtop'),
				'text'  => __('Решения принимаются на основе современной визуализации, лабораторных тестов и экспертного пересмотра данных.', 'ichilovtop'),
			),
			array(
				'title' => __('Персонализированный подход', 'ichilovtop'),
				'text'  => __('План лечения формируется индивидуально с учетом стадии заболевания, возраста и сопутствующих факторов.', 'ichilovtop'),
			),
		),
		'diagnostics' => array(
			array(
				'title' => __('Лабораторные исследования', 'ichilovtop'),
				'text'  => __('Расширенные анализы помогают уточнить состояние пациента и подготовить дальнейший план обследования.', 'ichilovtop'),
			),
			array(
				'title' => __('Инструментальная диагностика', 'ichilovtop'),
				'text'  => __('Используются современные методы визуализации и функциональных исследований по показаниям.', 'ichilovtop'),
			),
			array(
				'title' => __('Второе мнение', 'ichilovtop'),
				'text'  => __('Результаты изучаются профильными специалистами для подтверждения диагноза и тактики лечения.', 'ichilovtop'),
			),
		),
		'treatments' => array(
			array(
				'title' => __('Консервативное лечение', 'ichilovtop'),
				'text'  => __('Медикаментозные и поддерживающие схемы подбираются на основе текущего состояния пациента.', 'ichilovtop'),
			),
			array(
				'title' => __('Малоинвазивные методы', 'ichilovtop'),
				'text'  => __('Когда это возможно, используются современные щадящие методики для сокращения периода восстановления.', 'ichilovtop'),
			),
			array(
				'title' => __('Хирургическое лечение', 'ichilovtop'),
				'text'  => __('Оперативные подходы рассматриваются после полной диагностики и оценки рисков.', 'ichilovtop'),
			),
		),
		'faq' => array(
			array(
				'question' => __('Можно ли отправить документы до приезда?', 'ichilovtop'),
				'answer'   => __('Да, предварительный разбор документов помогает заранее составить план обследования и ориентировочную смету.', 'ichilovtop'),
			),
			array(
				'question' => __('Сколько длится диагностика?', 'ichilovtop'),
				'answer'   => __('Срок зависит от конкретного заболевания, но многие программы можно организовать в течение нескольких рабочих дней.', 'ichilovtop'),
			),
			array(
				'question' => __('Можно ли получить план лечения на русском языке?', 'ichilovtop'),
				'answer'   => __('Да, координатор помогает с переводом и объяснением результатов обследований и рекомендаций врачей.', 'ichilovtop'),
			),
		),
	);
}

function ichilovtop_default_disease_banner_stat_icon() {
	return '<svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 8C14 8 9 13 9 20C9 27 14 32 20 32" stroke="white" stroke-width="2.5" stroke-linecap="round"/><path d="M20 32C26 32 31 27 31 20C31 17 30 14 28 12" stroke="white" stroke-width="2.5" stroke-linecap="round"/><path d="M14 20C14 20 16 24 20 24C24 24 26 20 26 20" stroke="white" stroke-width="2" stroke-linecap="round"/><path d="M20 12V8M24 13L26 9" stroke="white" stroke-width="1.5" stroke-linecap="round"/></svg>';
}

function ichilovtop_default_disease_banner_feature_icons() {
	return array(
		'<svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 4C14 4 10 9 10 9C10 9 8 12 8 16C8 24 14 32 20 34C26 32 32 24 32 16C32 12 30 9 30 9C30 9 26 4 20 4Z" stroke="#4A2FA0" stroke-width="2"/><path d="M14 16C14 16 16 19 20 19C24 19 26 16 26 16" stroke="#E91E8C" stroke-width="2" stroke-linecap="round"/><path d="M16 22C16 22 17.5 24 20 24C22.5 24 24 22 24 22" stroke="#E91E8C" stroke-width="2" stroke-linecap="round"/><line x1="20" y1="4" x2="20" y2="34" stroke="#4A2FA0" stroke-width="1.5" stroke-dasharray="2 2"/></svg>',
		'<svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6L34 12V22C34 29 27 35 20 37C13 35 6 29 6 22V12L20 6Z" stroke="#4A2FA0" stroke-width="2"/><circle cx="20" cy="22" r="5" stroke="#E91E8C" stroke-width="2"/><path d="M20 14V17M20 27V30M12 22H15M25 22H28" stroke="#E91E8C" stroke-width="1.5" stroke-linecap="round"/></svg>',
		'<svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="6" y="14" width="28" height="16" rx="3" stroke="#4A2FA0" stroke-width="2"/><rect x="12" y="18" width="16" height="8" rx="2" fill="#ede6fa" stroke="#4A2FA0" stroke-width="1.5"/><path d="M10 14V10M30 14V10" stroke="#4A2FA0" stroke-width="2" stroke-linecap="round"/><path d="M15 10H25" stroke="#E91E8C" stroke-width="2" stroke-linecap="round"/><path d="M20 22L22 24L26 20" stroke="#E91E8C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'<svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="18" cy="18" r="10" stroke="#4A2FA0" stroke-width="2"/><line x1="25" y1="25" x2="34" y2="34" stroke="#E91E8C" stroke-width="2.5" stroke-linecap="round"/><path d="M14 18H22M18 14V22" stroke="#4A2FA0" stroke-width="1.5" stroke-linecap="round"/></svg>',
	);
}

function ichilovtop_default_disease_banner_treatment_icons() {
	return array(
		'<svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 24L24 8" stroke="#E91E8C" stroke-width="2" stroke-linecap="round"/><path d="M18 6L26 14" stroke="#E91E8C" stroke-width="2" stroke-linecap="round"/><path d="M6 18L10 22" stroke="#E91E8C" stroke-width="2" stroke-linecap="round"/><circle cx="24" cy="8" r="3" fill="#E91E8C"/></svg>',
		'<svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="12" y="4" width="8" height="24" rx="4" stroke="#4A2FA0" stroke-width="2"/><path d="M16 12V20" stroke="#4A2FA0" stroke-width="1.5" stroke-linecap="round"/><path d="M12 16H20" stroke="#4A2FA0" stroke-width="1.5" stroke-linecap="round"/></svg>',
		'<svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="16" cy="16" r="6" stroke="#E91E8C" stroke-width="2"/><path d="M10 10L6 6M22 10L26 6M10 22L6 26M22 22L26 26" stroke="#4A2FA0" stroke-width="1.5" stroke-linecap="round"/></svg>',
		'<svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 4L28 10V22C28 27 22 31 16 31C10 31 4 27 4 22V10L16 4Z" stroke="#4A2FA0" stroke-width="2"/><path d="M11 16L14 19L21 13" stroke="#E91E8C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
	);
}

function ichilovtop_default_disease_banner_benefit_icons() {
	return array(
		'<svg viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="14" cy="8" r="4" stroke="white" stroke-width="1.8"/><circle cx="7" cy="10" r="3" stroke="white" stroke-width="1.5"/><circle cx="21" cy="10" r="3" stroke="white" stroke-width="1.5"/><path d="M14 14C10 14 6 16.5 6 20" stroke="white" stroke-width="1.8" stroke-linecap="round"/><path d="M14 14C18 14 22 16.5 22 20" stroke="white" stroke-width="1.8" stroke-linecap="round"/><path d="M4 22C4 18.5 5.5 17 7 16" stroke="white" stroke-width="1.5" stroke-linecap="round"/><path d="M24 22C24 18.5 22.5 17 21 16" stroke="white" stroke-width="1.5" stroke-linecap="round"/></svg>',
		'<svg viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="5" y="4" width="18" height="22" rx="2" stroke="white" stroke-width="1.8"/><path d="M9 10H19M9 14H19M9 18H15" stroke="white" stroke-width="1.5" stroke-linecap="round"/><path d="M16 17L19 20L23 15" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'<svg viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="14" cy="16" r="8" stroke="white" stroke-width="1.8"/><path d="M14 10V8M14 24V22" stroke="white" stroke-width="1.5" stroke-linecap="round"/><path d="M11 13C11 11.9 12.3 11 14 11C15.7 11 17 11.9 17 13C17 14.1 16 14.8 14 15.5C12 16.2 11 17 11 18C11 19 12.3 20 14 20C15.7 20 17 19 17 18" stroke="white" stroke-width="1.5" stroke-linecap="round"/><path d="M10 6L14 4L18 6" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
	);
}

// ─────────────────────────────────────────────
// ACF field builder helper
// ─────────────────────────────────────────────

function ichilovtop_make_item_fields($section_key, $section_label, $count, $field_definitions, $defaults = array()) {
	$fields = array();

	for ($index = 1; $index <= $count; $index++) {
		$fields[] = array(
			'key'       => sprintf('field_ich_%1$s_%2$d_heading', $section_key, $index),
			'label'     => sprintf(__('%1$s %2$d', 'ichilovtop'), $section_label, $index),
			'name'      => '',
			'type'      => 'message',
			'message'   => '',
			'new_lines' => 'wpautop',
			'esc_html'  => 0,
			'wrapper'   => array(
				'width' => '100',
			),
		);

		foreach ($field_definitions as $field_key => $config) {
			$field_config = $config;
			unset($field_config['label']);

			$fields[] = array_merge(
				array(
					'key'           => sprintf('field_ich_%1$s_%2$d_%3$s', $section_key, $index, $field_key),
					'label'         => sprintf(__('%1$s %2$d %3$s', 'ichilovtop'), $section_label, $index, $config['label']),
					'name'          => sprintf('%1$s_%2$d_%3$s', $section_key, $index, $field_key),
					'default_value' => $defaults[ $index - 1 ][ $field_key ] ?? $field_config['default_value'] ?? '',
				),
				$field_config
			);
		}
	}

	return $fields;
}

// ─────────────────────────────────────────────
// Front page ACF field group
// ─────────────────────────────────────────────

function ichilovtop_register_acf_fields() {
	if (! function_exists('acf_add_local_field_group')) {
		return;
	}

	$defaults = ichilovtop_default_front_page_content();

	$fields = array(
		array(
			'key'   => 'field_ich_hero_tab',
			'label' => __('Hero', 'ichilovtop'),
			'type'  => 'tab',
		),
		array(
			'key'           => 'field_ich_hero_eyebrow',
			'label'         => __('Hero Eyebrow', 'ichilovtop'),
			'name'          => 'hero_eyebrow',
			'type'          => 'text',
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_hero_title',
			'label'         => __('Hero Title', 'ichilovtop'),
			'name'          => 'hero_title',
			'type'          => 'text',
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_hero_text',
			'label'         => __('Hero Text', 'ichilovtop'),
			'name'          => 'hero_text',
			'type'          => 'textarea',
			'rows'          => 4,
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_primary_button_text',
			'label'         => __('Primary Button Text', 'ichilovtop'),
			'name'          => 'hero_primary_button_text',
			'type'          => 'text',
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_primary_button_link',
			'label'         => __('Primary Button Link', 'ichilovtop'),
			'name'          => 'hero_primary_button_link',
			'type'          => 'text',
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_secondary_button_text',
			'label'         => __('Secondary Button Text', 'ichilovtop'),
			'name'          => 'hero_secondary_button_text',
			'type'          => 'text',
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_secondary_button_link',
			'label'         => __('Secondary Button Link', 'ichilovtop'),
			'name'          => 'hero_secondary_button_link',
			'type'          => 'text',
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_hero_contact_title',
			'label'         => __('Hero Contact Title', 'ichilovtop'),
			'name'          => 'hero_contact_title',
			'type'          => 'text',
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_hero_contact_text',
			'label'         => __('Hero Contact Text', 'ichilovtop'),
			'name'          => 'hero_contact_text',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => '',
		),
	);

	$fields = array_merge(
		$fields,
		ichilovtop_make_item_fields(
			'hero_stat',
			'Hero Stat',
			3,
			array(
				'value' => array('label' => 'Value', 'type' => 'text'),
				'label' => array('label' => 'Label', 'type' => 'text'),
			),
			$defaults['hero_stats']
		),
		ichilovtop_make_item_fields(
			'hero_badge',
			'Hero Badge',
			3,
			array(
				'title' => array('label' => 'Title', 'type' => 'text'),
				'text'  => array('label' => 'Text', 'type' => 'textarea', 'rows' => 2),
			),
			$defaults['hero_badges']
		),
		array(
			array(
				'key'   => 'field_ich_advantages_tab',
				'label' => __('Advantages', 'ichilovtop'),
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ich_advantages_title',
				'label'         => __('Advantages Title', 'ichilovtop'),
				'name'          => 'advantages_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_advantages_text',
				'label'         => __('Advantages Description', 'ichilovtop'),
				'name'          => 'advantages_text',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => '',
			),
		),
		ichilovtop_make_item_fields(
			'advantage',
			'Advantage',
			4,
			array(
				'title' => array('label' => 'Title', 'type' => 'text'),
				'text'  => array('label' => 'Text', 'type' => 'textarea', 'rows' => 3),
			),
			$defaults['advantages']
		),
		array(
			array(
				'key'   => 'field_ich_treatments_tab',
				'label' => __('Treatments', 'ichilovtop'),
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ich_treatments_title',
				'label'         => __('Treatments Title', 'ichilovtop'),
				'name'          => 'treatments_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_treatments_text',
				'label'         => __('Treatments Description', 'ichilovtop'),
				'name'          => 'treatments_text',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_treatments_highlight_title',
				'label'         => __('Treatments Sidebar Title', 'ichilovtop'),
				'name'          => 'treatments_highlight_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_treatments_highlight_text',
				'label'         => __('Treatments Sidebar Text', 'ichilovtop'),
				'name'          => 'treatments_highlight_text',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => '',
			),
		),
		ichilovtop_make_item_fields(
			'treatment',
			'Treatment',
			6,
			array(
				'title' => array('label' => 'Title', 'type' => 'text'),
				'text'  => array('label' => 'Text', 'type' => 'textarea', 'rows' => 3),
			),
			$defaults['treatments']
		),
		array(
			array(
				'key'   => 'field_ich_diagnostics_tab',
				'label' => __('Diagnostics', 'ichilovtop'),
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ich_diagnostics_title',
				'label'         => __('Diagnostics Title', 'ichilovtop'),
				'name'          => 'diagnostics_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_diagnostics_text',
				'label'         => __('Diagnostics Description', 'ichilovtop'),
				'name'          => 'diagnostics_text',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_diagnostics_sidebar_title',
				'label'         => __('Diagnostics Sidebar Title', 'ichilovtop'),
				'name'          => 'diagnostics_sidebar_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_diagnostics_sidebar_list',
				'label'         => __('Diagnostics Sidebar List', 'ichilovtop'),
				'name'          => 'diagnostics_sidebar_list',
				'type'          => 'textarea',
				'rows'          => 5,
				'default_value' => '',
			),
		),
		ichilovtop_make_item_fields(
			'diagnostic',
			'Diagnostic Item',
			3,
			array(
				'title' => array('label' => 'Title', 'type' => 'text'),
				'text'  => array('label' => 'Text', 'type' => 'textarea', 'rows' => 3),
			),
			$defaults['diagnostics']
		),
		array(
			array(
				'key'   => 'field_ich_steps_tab',
				'label' => __('Steps', 'ichilovtop'),
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ich_steps_title',
				'label'         => __('Steps Title', 'ichilovtop'),
				'name'          => 'steps_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_steps_text',
				'label'         => __('Steps Description', 'ichilovtop'),
				'name'          => 'steps_text',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => '',
			),
		),
		ichilovtop_make_item_fields(
			'step',
			'Step',
			5,
			array(
				'title' => array('label' => 'Title', 'type' => 'text'),
				'text'  => array('label' => 'Text', 'type' => 'textarea', 'rows' => 3),
			),
			$defaults['steps']
		),
		array(
			array(
				'key'   => 'field_ich_price_tab',
				'label' => __('Price', 'ichilovtop'),
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ich_price_title',
				'label'         => __('Price Title', 'ichilovtop'),
				'name'          => 'price_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_price_text',
				'label'         => __('Price Description', 'ichilovtop'),
				'name'          => 'price_text',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_price_value',
				'label'         => __('Price Highlight Value', 'ichilovtop'),
				'name'          => 'price_value',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_price_note',
				'label'         => __('Price Note', 'ichilovtop'),
				'name'          => 'price_note',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => '',
			),
		),
		ichilovtop_make_item_fields(
			'price_item',
			'Price Item',
			4,
			array(
				'item' => array('label' => 'Text', 'type' => 'text'),
			),
			$defaults['price_items']
		),
		array(
			array(
				'key'   => 'field_ich_international_tab',
				'label' => __('International Patients', 'ichilovtop'),
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ich_international_title',
				'label'         => __('International Title', 'ichilovtop'),
				'name'          => 'international_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_international_text',
				'label'         => __('International Description', 'ichilovtop'),
				'name'          => 'international_text',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_international_sidebar_title',
				'label'         => __('International Sidebar Title', 'ichilovtop'),
				'name'          => 'international_sidebar_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_international_sidebar_text',
				'label'         => __('International Sidebar Text', 'ichilovtop'),
				'name'          => 'international_sidebar_text',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => '',
			),
		),
		ichilovtop_make_item_fields(
			'international_benefit',
			'International Benefit',
			3,
			array(
				'title' => array('label' => 'Title', 'type' => 'text'),
				'text'  => array('label' => 'Text', 'type' => 'textarea', 'rows' => 3),
			),
			$defaults['international_benefits']
		),
		array(
			array(
				'key'   => 'field_ich_faq_tab',
				'label' => __('FAQ', 'ichilovtop'),
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ich_faq_title',
				'label'         => __('FAQ Title', 'ichilovtop'),
				'name'          => 'faq_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_faq_text',
				'label'         => __('FAQ Description', 'ichilovtop'),
				'name'          => 'faq_text',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => '',
			),
		),
		ichilovtop_make_item_fields(
			'faq_item',
			'FAQ Item',
			4,
			array(
				'question' => array('label' => 'Question', 'type' => 'text'),
				'answer'   => array('label' => 'Answer', 'type' => 'textarea', 'rows' => 4),
			),
			$defaults['faq']
		),
		array(
			array(
				'key'   => 'field_ich_cta_tab',
				'label' => __('CTA / Contact', 'ichilovtop'),
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ich_cta_title',
				'label'         => __('CTA Title', 'ichilovtop'),
				'name'          => 'cta_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_cta_text',
				'label'         => __('CTA Text', 'ichilovtop'),
				'name'          => 'cta_text',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_cta_primary_text',
				'label'         => __('CTA Primary Button Text', 'ichilovtop'),
				'name'          => 'cta_primary_text',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_cta_primary_link',
				'label'         => __('CTA Primary Button Link', 'ichilovtop'),
				'name'          => 'cta_primary_link',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_cta_secondary_text',
				'label'         => __('CTA Secondary Button Text', 'ichilovtop'),
				'name'          => 'cta_secondary_text',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_cta_secondary_link',
				'label'         => __('CTA Secondary Button Link', 'ichilovtop'),
				'name'          => 'cta_secondary_link',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_contact_phone',
				'label'         => __('Contact Phone', 'ichilovtop'),
				'name'          => 'contact_phone',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_contact_email',
				'label'         => __('Contact Email', 'ichilovtop'),
				'name'          => 'contact_email',
				'type'          => 'email',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_contact_address',
				'label'         => __('Contact Address', 'ichilovtop'),
				'name'          => 'contact_address',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_contact_schedule',
				'label'         => __('Contact Schedule', 'ichilovtop'),
				'name'          => 'contact_schedule',
				'type'          => 'text',
				'default_value' => '',
			),
		)
	);

	acf_add_local_field_group(
		array(
			'key'      => 'group_ichilovtop_front_page',
			'title'    => __('Ichilov Top Front Page', 'ichilovtop'),
			'fields'   => $fields,
			'location' => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
		)
	);
}
add_action('acf/init', 'ichilovtop_register_acf_fields');

// ─────────────────────────────────────────────
// Disease ACF field group
// ─────────────────────────────────────────────

function ichilovtop_register_disease_acf_fields() {
	if (! function_exists('acf_add_local_field_group')) {
		return;
	}

	$defaults = ichilovtop_default_disease_content();

	// ── Таб: Баннер (основные поля) ───────────────────────────────────────
	$fields = array(
		array(
			'key'   => 'field_ich_disease_banner_tab',
			'label' => __('Баннер', 'ichilovtop'),
			'type'  => 'tab',
		),
		array(
			'key'           => 'field_ich_disease_banner_title',
			'label'         => __('Заголовок баннера (основной)', 'ichilovtop'),
			'name'          => 'disease_banner_title',
			'type'          => 'text',
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_disease_banner_title_accent',
			'label'         => __('Заголовок баннера (акцент)', 'ichilovtop'),
			'name'          => 'disease_banner_title_accent',
			'type'          => 'text',
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_disease_banner_subtitle',
			'label'         => __('Подзаголовок баннера', 'ichilovtop'),
			'name'          => 'disease_banner_subtitle',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_disease_banner_photo',
			'label'         => __('Фото врача (баннер)', 'ichilovtop'),
			'name'          => 'disease_banner_photo',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_ich_disease_banner_photo_alt',
			'label'         => __('Alt для фото баннера', 'ichilovtop'),
			'name'          => 'disease_banner_photo_alt',
			'type'          => 'text',
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_disease_banner_stat_prefix',
			'label'         => __('Статистика: префикс', 'ichilovtop'),
			'name'          => 'disease_banner_stat_prefix',
			'type'          => 'text',
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_disease_banner_stat_value',
			'label'         => __('Статистика: значение', 'ichilovtop'),
			'name'          => 'disease_banner_stat_value',
			'type'          => 'text',
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_disease_banner_stat_suffix',
			'label'         => __('Статистика: продолжение', 'ichilovtop'),
			'name'          => 'disease_banner_stat_suffix',
			'type'          => 'text',
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_disease_banner_stat_note',
			'label'         => __('Статистика: пояснение', 'ichilovtop'),
			'name'          => 'disease_banner_stat_note',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_disease_banner_stat_icon_svg',
			'label'         => __('Статистика: SVG иконки (приоритет)', 'ichilovtop'),
			'name'          => 'disease_banner_stat_icon_svg',
			'type'          => 'textarea',
			'rows'          => 6,
			'default_value' => '',
		),
		array(
			'key'           => 'field_ich_disease_banner_stat_icon_image',
			'label'         => __('Статистика: иконка изображением', 'ichilovtop'),
			'name'          => 'disease_banner_stat_icon_image',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'thumbnail',
			'library'       => 'all',
		),
		array(
			'key'           => 'field_ich_disease_banner_treatment_title',
			'label'         => __('Заголовок блока "Комплексное лечение"', 'ichilovtop'),
			'name'          => 'disease_banner_treatment_title',
			'type'          => 'text',
			'default_value' => '',
		),
	);

	// ── Верхние преимущества, лечение и нижняя плашка — всё в табе «Баннер» ─
	$fields = array_merge(
		$fields,
		ichilovtop_make_item_fields(
			'disease_banner_feature',
			'Banner Feature',
			4,
			array(
				'title'      => array('label' => 'Title', 'type' => 'text'),
				'text'       => array('label' => 'Text', 'type' => 'textarea', 'rows' => 3),
				'icon_svg'   => array('label' => 'SVG Code', 'type' => 'textarea', 'rows' => 6),
				'icon_image' => array('label' => 'Image Icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all'),
			),
			$defaults['banner_features']
		),
		ichilovtop_make_item_fields(
			'disease_banner_treatment',
			'Banner Treatment',
			4,
			array(
				'title'      => array('label' => 'Title', 'type' => 'text'),
				'text'       => array('label' => 'Text', 'type' => 'textarea', 'rows' => 3),
				'icon_svg'   => array('label' => 'SVG Code', 'type' => 'textarea', 'rows' => 6),
				'icon_image' => array('label' => 'Image Icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all'),
			),
			$defaults['banner_treatments']
		),
		ichilovtop_make_item_fields(
			'disease_banner_benefit',
			'Banner Benefit',
			3,
			array(
				'title'      => array('label' => 'Title', 'type' => 'text'),
				'text'       => array('label' => 'Text', 'type' => 'textarea', 'rows' => 3),
				'icon_svg'   => array('label' => 'SVG Code', 'type' => 'textarea', 'rows' => 6),
				'icon_image' => array('label' => 'Image Icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all'),
			),
			$defaults['banner_benefits']
		),
		// ── Таб: Вводный текст ────────────────────────────────────────────
		array(
			array(
				'key'   => 'field_ich_disease_intro_tab',
				'label' => __('Вводный текст', 'ichilovtop'),
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ich_disease_intro_title',
				'label'         => __('Заголовок вводного блока', 'ichilovtop'),
				'name'          => 'disease_intro_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_disease_intro_text',
				'label'         => __('Вводный текст', 'ichilovtop'),
				'name'          => 'disease_intro_text',
				'type'          => 'textarea',
				'rows'          => 6,
				'default_value' => '',
			),
		),
		// ── Таб: Таблица цен ──────────────────────────────────────────────
		array(
			array(
				'key'   => 'field_ich_disease_prices_tab',
				'label' => __('Таблица цен', 'ichilovtop'),
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ich_disease_prices_title',
				'label'         => __('Заголовок блока цен', 'ichilovtop'),
				'name'          => 'disease_prices_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_disease_prices_text',
				'label'         => __('Описание блока цен', 'ichilovtop'),
				'name'          => 'disease_prices_text',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => '',
			),
		),
		ichilovtop_make_item_fields(
			'disease_price',
			'Price Row',
			4,
			array(
				'service' => array('label' => 'Service', 'type' => 'text'),
				'price'   => array('label' => 'Price', 'type' => 'text'),
			),
			$defaults['price_rows']
		),
		// ── Таб: Преимущества лечения ─────────────────────────────────────
		array(
			array(
				'key'   => 'field_ich_disease_advantages_tab',
				'label' => __('Преимущества лечения', 'ichilovtop'),
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ich_disease_advantages_title',
				'label'         => __('Заголовок блока преимуществ', 'ichilovtop'),
				'name'          => 'disease_advantages_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_disease_advantages_text',
				'label'         => __('Описание блока преимуществ', 'ichilovtop'),
				'name'          => 'disease_advantages_text',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => '',
			),
		),
		ichilovtop_make_item_fields(
			'disease_advantage',
			'Advantage',
			3,
			array(
				'title' => array('label' => 'Title', 'type' => 'text'),
				'text'  => array('label' => 'Text', 'type' => 'textarea', 'rows' => 3),
			),
			$defaults['advantages']
		),
		// ── Таб: Методы диагностики ───────────────────────────────────────
		array(
			array(
				'key'   => 'field_ich_disease_diagnostics_tab',
				'label' => __('Методы диагностики', 'ichilovtop'),
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ich_disease_diagnostics_title',
				'label'         => __('Заголовок блока диагностики', 'ichilovtop'),
				'name'          => 'disease_diagnostics_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_disease_diagnostics_text',
				'label'         => __('Описание блока диагностики', 'ichilovtop'),
				'name'          => 'disease_diagnostics_text',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => '',
			),
		),
		ichilovtop_make_item_fields(
			'disease_diagnostic',
			'Diagnostic Method',
			3,
			array(
				'title' => array('label' => 'Title', 'type' => 'text'),
				'text'  => array('label' => 'Text', 'type' => 'textarea', 'rows' => 3),
			),
			$defaults['diagnostics']
		),
		// ── Таб: Методы лечения ───────────────────────────────────────────
		array(
			array(
				'key'   => 'field_ich_disease_treatments_tab',
				'label' => __('Методы лечения', 'ichilovtop'),
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ich_disease_treatments_title',
				'label'         => __('Заголовок блока лечения', 'ichilovtop'),
				'name'          => 'disease_treatments_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_disease_treatments_text',
				'label'         => __('Описание блока лечения', 'ichilovtop'),
				'name'          => 'disease_treatments_text',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => '',
			),
		),
		ichilovtop_make_item_fields(
			'disease_treatment',
			'Treatment Method',
			3,
			array(
				'title' => array('label' => 'Title', 'type' => 'text'),
				'text'  => array('label' => 'Text', 'type' => 'textarea', 'rows' => 3),
			),
			$defaults['treatments']
		),
		// ── Таб: FAQ ──────────────────────────────────────────────────────
		array(
			array(
				'key'   => 'field_ich_disease_faq_tab',
				'label' => __('FAQ', 'ichilovtop'),
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_ich_disease_faq_title',
				'label'         => __('Заголовок блока FAQ', 'ichilovtop'),
				'name'          => 'disease_faq_title',
				'type'          => 'text',
				'default_value' => '',
			),
			array(
				'key'           => 'field_ich_disease_faq_text',
				'label'         => __('Описание блока FAQ', 'ichilovtop'),
				'name'          => 'disease_faq_text',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => '',
			),
		),
		ichilovtop_make_item_fields(
			'disease_faq',
			'FAQ Item',
			3,
			array(
				'question' => array('label' => 'Question', 'type' => 'text'),
				'answer'   => array('label' => 'Answer', 'type' => 'textarea', 'rows' => 4),
			),
			$defaults['faq']
		)
	);

	acf_add_local_field_group(
		array(
			'key'      => 'group_ichilovtop_disease',
			'title'    => __('Disease Content', 'ichilovtop'),
			'fields'   => $fields,
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'disease',
					),
				),
			),
		)
	);
}
add_action('acf/init', 'ichilovtop_register_disease_acf_fields');

/**
 * ACF fields for the diseases index page (slug `diseases` and/or template page-diseases.php).
 */
function ichilovtop_register_diseases_index_page_acf_fields() {
	if (! function_exists('acf_add_local_field_group')) {
		return;
	}

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

	acf_add_local_field_group(
		array(
			'key'    => 'group_ichilovtop_diseases_index',
			'title'  => __('Страница «Заболевания» (каталог)', 'ichilovtop'),
			'fields' => array_merge(
				array(
					array(
						'key'   => 'field_ich_diseases_index_hero_tab',
						'label' => __('Баннер', 'ichilovtop'),
						'type'  => 'tab',
					),
					array(
						'key'           => 'field_ich_diseases_index_hero_badge',
						'label'         => __('Бейдж баннера', 'ichilovtop'),
						'name'          => 'diseases_index_hero_badge',
						'type'          => 'text',
						'default_value' => __('Каталог заболеваний', 'ichilovtop'),
					),
					array(
						'key'           => 'field_ich_diseases_index_hero_title',
						'label'         => __('Заголовок баннера', 'ichilovtop'),
						'name'          => 'diseases_index_hero_title',
						'type'          => 'text',
						'default_value' => __('Лечение заболеваний в Израиле', 'ichilovtop'),
					),
					array(
						'key'           => 'field_ich_diseases_index_hero_title_accent',
						'label'         => __('Акцент заголовка баннера', 'ichilovtop'),
						'name'          => 'diseases_index_hero_title_accent',
						'type'          => 'text',
						'default_value' => __('с ведущими специалистами Ихилов', 'ichilovtop'),
					),
					array(
						'key'           => 'field_ich_diseases_index_hero_lede',
						'label'         => __('Описание баннера', 'ichilovtop'),
						'name'          => 'diseases_index_hero_lede',
						'type'          => 'textarea',
						'rows'          => 3,
						'default_value' => __('Найдите нужное заболевание, направление лечения или получите предварительную консультацию по вашему диагнозу.', 'ichilovtop'),
					),
					array(
						'key'           => 'field_ich_diseases_index_hero_search_placeholder',
						'label'         => __('Placeholder поиска', 'ichilovtop'),
						'name'          => 'diseases_index_hero_search_placeholder',
						'type'          => 'text',
						'default_value' => __('Например: рак молочной железы, аритмия, грыжа диска...', 'ichilovtop'),
					),
					array(
						'key'           => 'field_ich_diseases_index_hero_search_button',
						'label'         => __('Текст кнопки поиска', 'ichilovtop'),
						'name'          => 'diseases_index_hero_search_button',
						'type'          => 'text',
						'default_value' => __('Найти', 'ichilovtop'),
					),
				),
				ichilovtop_make_item_fields(
					'diseases_index_hero_trust',
					'Пункт доверия',
					4,
					array(
						'value' => array('label' => 'Значение', 'type' => 'text'),
						'label' => array('label' => 'Подпись', 'type' => 'text'),
					),
					$hero_trust_defaults
				),
				array(
					array(
						'key'           => 'field_ich_diseases_index_hero_hint',
						'label'         => __('Подсказка под карточками', 'ichilovtop'),
						'name'          => 'diseases_index_hero_hint',
						'type'          => 'text',
						'default_value' => __('Выберите направление — или воспользуйтесь поиском', 'ichilovtop'),
					),
					array(
						'key'   => 'field_ich_diseases_index_catalog_tab',
						'label' => __('Каталог', 'ichilovtop'),
						'type'  => 'tab',
					),
					array(
						'key'           => 'field_ich_diseases_index_catalog_title',
						'label'         => __('Заголовок блока каталога', 'ichilovtop'),
						'instructions'  => __('Если пусто — используется стандартный заголовок.', 'ichilovtop'),
						'name'          => 'diseases_index_catalog_title',
						'type'          => 'text',
						'default_value' => '',
					),
					array(
						'key'           => 'field_ich_diseases_index_catalog_lead',
						'label'         => __('Текст над списком заболеваний', 'ichilovtop'),
						'instructions'  => __('Краткое вступление между контентом страницы и каталогом.', 'ichilovtop'),
						'name'          => 'diseases_index_catalog_lead',
						'type'          => 'textarea',
						'rows'          => 3,
						'default_value' => '',
					),
					array(
						'key'           => 'field_ich_diseases_index_uncategorized_title',
						'label'         => __('Заголовок для заболеваний без рубрики', 'ichilovtop'),
						'instructions'  => __('Показывается, если есть записи без отделения.', 'ichilovtop'),
						'name'          => 'diseases_index_uncategorized_title',
						'type'          => 'text',
						'default_value' => '',
					),
				)
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_slug',
						'operator' => '==',
						'value'    => 'diseases',
					),
				),
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-diseases.php',
					),
				),
			),
		)
	);
}
add_action('acf/init', 'ichilovtop_register_diseases_index_page_acf_fields');

/**
 * ACF fields for disease departments.
 */
function ichilovtop_register_disease_department_acf_fields() {
	if (! function_exists('acf_add_local_field_group')) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'    => 'group_ichilovtop_disease_department',
			'title'  => __('Отделение заболевания', 'ichilovtop'),
			'fields' => array(
				array(
					'key'           => 'field_ich_disease_department_icon',
					'label'         => __('SVG иконка', 'ichilovtop'),
					'instructions'  => __('Выберите одну SVG иконку из папки темы assets/icons.', 'ichilovtop'),
					'name'          => 'disease_department_icon',
					'type'          => 'select',
					'choices'       => ichilovtop_get_theme_svg_icon_choices(),
					'return_format' => 'value',
					'allow_null'    => 1,
					'ui'            => 1,
					'default_value' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'taxonomy',
						'operator' => '==',
						'value'    => 'disease_department',
					),
				),
			),
		)
	);
}
add_action('acf/init', 'ichilovtop_register_disease_department_acf_fields');
