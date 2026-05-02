<?php
/**
 * Plugin Name: IchilovTop AI Disease Generator
 * Description: Generates disease ACF content via OpenAI from a reference URL.
 * Version: 1.0.3
 * Author: IchilovTop
 */

if (! defined('ABSPATH')) {
	exit;
}

class IchilovTop_Ai_Disease_Generator {
	const OPTION_GROUP   = 'ichilovtop_ai_disease_generator_options';
	const OPTION_API_KEY = 'ichilovtop_ai_disease_generator_api_key';
	const OPTION_PROMPT  = 'ichilovtop_ai_disease_generator_prompt';
	const OPTION_MODEL   = 'ichilovtop_ai_disease_generator_model';

	const AJAX_ACTION = 'ichilovtop_ai_generate_disease_article';
	const NONCE_KEY   = 'ichilovtop_ai_generate_disease_article_nonce';

	public function __construct() {
		add_action('admin_menu', array($this, 'register_settings_page'));
		add_action('admin_init', array($this, 'register_settings'));
		add_action('add_meta_boxes', array($this, 'register_generator_meta_box'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
		add_action('wp_ajax_' . self::AJAX_ACTION, array($this, 'ajax_generate_article'));
	}

	public function register_settings_page() {
		add_options_page(
			__('AI Disease Generator', 'ichilovtop'),
			__('AI Disease Generator', 'ichilovtop'),
			'manage_options',
			'ichilovtop-ai-disease-generator',
			array($this, 'render_settings_page')
		);
	}

	public function register_settings() {
		register_setting(
			self::OPTION_GROUP,
			self::OPTION_API_KEY,
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => '',
			)
		);

		register_setting(
			self::OPTION_GROUP,
			self::OPTION_MODEL,
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => 'gpt-4.1-mini',
			)
		);

		register_setting(
			self::OPTION_GROUP,
			self::OPTION_PROMPT,
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_textarea_field',
				'default'           => self::get_default_prompt_template(),
			)
		);
	}

	public function render_settings_page() {
		$api_key = (string) get_option(self::OPTION_API_KEY, '');
		$model   = (string) get_option(self::OPTION_MODEL, 'gpt-4.1-mini');
		$prompt  = (string) get_option(self::OPTION_PROMPT, self::get_default_prompt_template());
		?>
		<div class="wrap">
			<h1><?php esc_html_e('AI Disease Generator Settings', 'ichilovtop'); ?></h1>
			<p><?php esc_html_e('Set your OpenAI API key and edit the generation prompt template.', 'ichilovtop'); ?></p>

			<form method="post" action="options.php">
				<?php settings_fields(self::OPTION_GROUP); ?>
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label for="<?php echo esc_attr(self::OPTION_API_KEY); ?>"><?php esc_html_e('OpenAI API Key', 'ichilovtop'); ?></label></th>
						<td>
							<input
								type="password"
								id="<?php echo esc_attr(self::OPTION_API_KEY); ?>"
								name="<?php echo esc_attr(self::OPTION_API_KEY); ?>"
								value="<?php echo esc_attr($api_key); ?>"
								class="regular-text"
								autocomplete="off"
							/>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="<?php echo esc_attr(self::OPTION_MODEL); ?>"><?php esc_html_e('Model', 'ichilovtop'); ?></label></th>
						<td>
							<input
								type="text"
								id="<?php echo esc_attr(self::OPTION_MODEL); ?>"
								name="<?php echo esc_attr(self::OPTION_MODEL); ?>"
								value="<?php echo esc_attr($model); ?>"
								class="regular-text"
							/>
							<p class="description"><?php esc_html_e('Example: gpt-4.1-mini, gpt-4.1, gpt-4o-mini', 'ichilovtop'); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="<?php echo esc_attr(self::OPTION_PROMPT); ?>"><?php esc_html_e('Prompt Template', 'ichilovtop'); ?></label></th>
						<td>
							<textarea
								id="<?php echo esc_attr(self::OPTION_PROMPT); ?>"
								name="<?php echo esc_attr(self::OPTION_PROMPT); ?>"
								rows="16"
								class="large-text code"
							><?php echo esc_textarea($prompt); ?></textarea>
							<p class="description">
								<?php esc_html_e('Available placeholders: {disease_title}, {source_url}, {source_text}', 'ichilovtop'); ?>
							</p>
						</td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}

	public function register_generator_meta_box() {
		add_meta_box(
			'ichilovtop_ai_disease_generator_box',
			__('AI Generator', 'ichilovtop'),
			array($this, 'render_generator_meta_box'),
			'disease',
			'normal',
			'high'
		);
	}

	public function render_generator_meta_box($post) {
		?>
		<p>
			<button type="button" class="button button-primary" id="ichilovtop-generate-disease-ai">
				<?php esc_html_e('Генерировать статью с помощью AI', 'ichilovtop'); ?>
			</button>
		</p>
		<p class="description">
			<?php esc_html_e('Нажмите кнопку, вставьте URL страницы-примера, затем подтвердите генерацию.', 'ichilovtop'); ?>
		</p>
		<?php if ((int) $post->ID <= 0) : ?>
			<p class="description" style="color:#b32d2e;">
				<?php esc_html_e('Сначала сохраните запись как черновик.', 'ichilovtop'); ?>
			</p>
		<?php endif; ?>
		<?php
	}

	public function enqueue_admin_assets() {
		$screen = function_exists('get_current_screen') ? get_current_screen() : null;
		if (! $screen || $screen->base !== 'post' || $screen->post_type !== 'disease') {
			return;
		}

		$post_id = 0;
		if (isset($_GET['post'])) {
			$post_id = (int) $_GET['post'];
		} elseif (isset($_POST['post_ID'])) {
			$post_id = (int) $_POST['post_ID'];
		}

		$handle = 'ichilovtop-ai-disease-generator-admin';
		wp_register_script($handle, '', array('jquery'), '1.0.3', true);
		wp_enqueue_script($handle);

		$config = array(
			'ajaxUrl'            => admin_url('admin-ajax.php'),
			'action'             => self::AJAX_ACTION,
			'nonce'              => wp_create_nonce(self::NONCE_KEY),
			'postId'             => $post_id,
			'settingsUrl'        => admin_url('options-general.php?page=ichilovtop-ai-disease-generator'),
			'i18nButton'         => __('Генерировать статью с помощью AI', 'ichilovtop'),
			'i18nTitle'          => __('Генерация статьи AI', 'ichilovtop'),
			'i18nLabel'          => __('Страница для примера', 'ichilovtop'),
			'i18nPlaceholder'    => __('https://example.com/medical-article', 'ichilovtop'),
			'i18nGenerate'       => __('Сгенерировать', 'ichilovtop'),
			'i18nCancel'         => __('Отмена', 'ichilovtop'),
			'i18nMissingUrl'     => __('Вставьте URL страницы-примера.', 'ichilovtop'),
			'i18nWorking'        => __('Генерация... это может занять до 1 минуты.', 'ichilovtop'),
			'i18nSuccess'        => __('Готово! ACF поля заполнены. Сохраните запись.', 'ichilovtop'),
			'i18nError'          => __('Ошибка генерации. Проверьте URL и попробуйте снова.', 'ichilovtop'),
			'i18nSavePostFirst'  => __('Сначала сохраните запись, затем запустите генерацию.', 'ichilovtop'),
			'i18nAcfBlockHeader' => __('AI Generator', 'ichilovtop'),
		);

		wp_add_inline_script(
			$handle,
			'window.ichilovtopAiDiseaseGenerator = ' . wp_json_encode($config) . ';',
			'before'
		);

		$script_path = plugin_dir_path(__FILE__) . 'assets/js/admin.js';
		if (file_exists($script_path)) {
			$script_content = file_get_contents($script_path);
			if (is_string($script_content) && $script_content !== '') {
				wp_add_inline_script($handle, $script_content, 'after');
			}
		}
	}

	public function ajax_generate_article() {
		check_ajax_referer(self::NONCE_KEY, 'nonce');

		$post_id    = isset($_POST['post_id']) ? (int) $_POST['post_id'] : 0;
		$source_url = isset($_POST['source_url']) ? esc_url_raw(wp_unslash((string) $_POST['source_url'])) : '';

		if ($post_id <= 0 || get_post_type($post_id) !== 'disease') {
			wp_send_json_error(array('message' => __('Неверный post_id.', 'ichilovtop')), 400);
		}

		if (! current_user_can('edit_post', $post_id)) {
			wp_send_json_error(array('message' => __('Недостаточно прав.', 'ichilovtop')), 403);
		}

		if ($source_url === '' || ! wp_http_validate_url($source_url)) {
			wp_send_json_error(array('message' => __('Некорректный URL.', 'ichilovtop')), 400);
		}

		if (! function_exists('update_field')) {
			wp_send_json_error(array('message' => __('ACF не активен. Активируйте Advanced Custom Fields.', 'ichilovtop')), 500);
		}

		$source_response = wp_remote_get(
			$source_url,
			array(
				'timeout' => 30,
				'headers' => array(
					'User-Agent' => 'IchilovTop-AI-Disease-Generator/1.0',
				),
			)
		);

		if (is_wp_error($source_response)) {
			wp_send_json_error(array('message' => $source_response->get_error_message()), 500);
		}

		$source_code = (int) wp_remote_retrieve_response_code($source_response);
		if ($source_code < 200 || $source_code >= 300) {
			wp_send_json_error(array('message' => sprintf(__('Не удалось загрузить страницу. HTTP %d', 'ichilovtop'), $source_code)), 400);
		}

		$source_html = (string) wp_remote_retrieve_body($source_response);
		$source_text = $this->extract_text_from_html($source_html);
		$disease     = (string) get_the_title($post_id);

		$generated = $this->request_openai_json($source_url, $source_text, $disease);
		if (is_wp_error($generated)) {
			wp_send_json_error(array('message' => $generated->get_error_message()), 500);
		}

		$save_result = $this->save_generated_fields($post_id, $generated);
		if (is_wp_error($save_result)) {
			wp_send_json_error(array('message' => $save_result->get_error_message()), 500);
		}

		wp_send_json_success(array('message' => __('Поля ACF успешно обновлены.', 'ichilovtop')));
	}

	private function request_openai_json($source_url, $source_text, $disease_title) {
		$api_key = trim((string) get_option(self::OPTION_API_KEY, ''));
		if ($api_key === '') {
			return new WP_Error('missing_api_key', __('Не задан OpenAI API Key. Откройте настройки плагина.', 'ichilovtop'));
		}

		$model = trim((string) get_option(self::OPTION_MODEL, 'gpt-4.1-mini'));
		if ($model === '') {
			$model = 'gpt-4.1-mini';
		}

		$prompt_template = (string) get_option(self::OPTION_PROMPT, self::get_default_prompt_template());
		$short_text      = function_exists('mb_substr') ? mb_substr($source_text, 0, 18000) : substr($source_text, 0, 18000);

		$user_prompt = strtr(
			$prompt_template,
			array(
				'{disease_title}' => $disease_title,
				'{source_url}'    => $source_url,
				'{source_text}'   => $short_text,
			)
		);

		$payload = array(
			'model' => $model,
			'input' => array(
				array(
					'role'    => 'system',
					'content' => array(
						array(
							'type' => 'input_text',
							'text' => 'Ты формируешь валидный JSON для ACF полей страницы заболевания WordPress.',
						),
					),
				),
				array(
					'role'    => 'user',
					'content' => array(
						array(
							'type' => 'input_text',
							'text' => $user_prompt,
						),
					),
				),
			),
			'text'  => array(
				'format' => array(
					'type'   => 'json_schema',
					'name'   => 'disease_article',
					'strict' => true,
					'schema' => $this->get_response_schema(),
				),
			),
		);

		$response = wp_remote_post(
			'https://api.openai.com/v1/responses',
			array(
				'timeout' => 120,
				'headers' => array(
					'Content-Type'  => 'application/json',
					'Authorization' => 'Bearer ' . $api_key,
				),
				'body'    => wp_json_encode($payload),
			)
		);

		if (is_wp_error($response)) {
			return $response;
		}

		$code = (int) wp_remote_retrieve_response_code($response);
		$body = (string) wp_remote_retrieve_body($response);
		if ($code < 200 || $code >= 300) {
			$error_message = $this->extract_openai_error_message($body);
			return new WP_Error(
				'openai_http_error',
				sprintf(__('OpenAI error HTTP %1$d: %2$s', 'ichilovtop'), $code, $error_message)
			);
		}

		$decoded = json_decode($body, true);
		if (! is_array($decoded)) {
			return new WP_Error('invalid_openai_response', __('Некорректный ответ OpenAI.', 'ichilovtop'));
		}

		$json_text = $this->extract_json_text_from_response($decoded);
		if ($json_text === '') {
			return new WP_Error('empty_openai_output', __('OpenAI вернул пустой результат.', 'ichilovtop'));
		}

		$parsed = json_decode($json_text, true);
		if (! is_array($parsed)) {
			return new WP_Error('invalid_json_output', __('OpenAI вернул невалидный JSON.', 'ichilovtop'));
		}

		return $parsed;
	}

	private function extract_openai_error_message($body) {
		$decoded = json_decode((string) $body, true);

		if (is_array($decoded) && ! empty($decoded['error']['message'])) {
			return sanitize_text_field((string) $decoded['error']['message']);
		}

		$plain = wp_strip_all_tags((string) $body);
		$plain = trim(preg_replace('/\s+/u', ' ', $plain));

		if ($plain === '') {
			return __('Пустой ответ от OpenAI.', 'ichilovtop');
		}

		return sanitize_text_field(substr($plain, 0, 600));
	}

	private function extract_json_text_from_response($response_data) {
		if (! empty($response_data['output_text']) && is_string($response_data['output_text'])) {
			return $response_data['output_text'];
		}

		if (empty($response_data['output']) || ! is_array($response_data['output'])) {
			return '';
		}

		foreach ($response_data['output'] as $output_block) {
			if (empty($output_block['content']) || ! is_array($output_block['content'])) {
				continue;
			}

			foreach ($output_block['content'] as $content_part) {
				if (! empty($content_part['text']) && is_string($content_part['text'])) {
					return $content_part['text'];
				}
			}
		}

		return '';
	}

	private function save_generated_fields($post_id, $result) {
		$simple_fields = array(
			// Banner
			'field_ich_disease_banner_title'           => sanitize_text_field((string) ($result['disease_banner_title'] ?? '')),
			'field_ich_disease_banner_title_accent'    => sanitize_text_field((string) ($result['disease_banner_title_accent'] ?? '')),
			'field_ich_disease_banner_subtitle'        => sanitize_textarea_field((string) ($result['disease_banner_subtitle'] ?? '')),
			'field_ich_disease_banner_photo_alt'       => sanitize_text_field((string) ($result['disease_banner_photo_alt'] ?? '')),
			'field_ich_disease_banner_stat_prefix'     => sanitize_text_field((string) ($result['disease_banner_stat_prefix'] ?? '')),
			'field_ich_disease_banner_stat_value'      => sanitize_text_field((string) ($result['disease_banner_stat_value'] ?? '')),
			'field_ich_disease_banner_stat_suffix'     => sanitize_text_field((string) ($result['disease_banner_stat_suffix'] ?? '')),
			'field_ich_disease_banner_stat_note'       => sanitize_textarea_field((string) ($result['disease_banner_stat_note'] ?? '')),
			'field_ich_disease_banner_treatment_title' => sanitize_text_field((string) ($result['disease_banner_treatment_title'] ?? '')),
			// Other sections
			'field_ich_disease_intro_title'       => sanitize_text_field((string) ($result['disease_intro_title'] ?? '')),
			'field_ich_disease_intro_text'        => sanitize_textarea_field((string) ($result['disease_intro_text'] ?? '')),
			'field_ich_disease_prices_title'      => sanitize_text_field((string) ($result['disease_prices_title'] ?? '')),
			'field_ich_disease_prices_text'       => sanitize_textarea_field((string) ($result['disease_prices_text'] ?? '')),
			'field_ich_disease_advantages_title'  => sanitize_text_field((string) ($result['disease_advantages_title'] ?? '')),
			'field_ich_disease_advantages_text'   => sanitize_textarea_field((string) ($result['disease_advantages_text'] ?? '')),
			'field_ich_disease_diagnostics_title' => sanitize_text_field((string) ($result['disease_diagnostics_title'] ?? '')),
			'field_ich_disease_diagnostics_text'  => sanitize_textarea_field((string) ($result['disease_diagnostics_text'] ?? '')),
			'field_ich_disease_treatments_title'  => sanitize_text_field((string) ($result['disease_treatments_title'] ?? '')),
			'field_ich_disease_treatments_text'   => sanitize_textarea_field((string) ($result['disease_treatments_text'] ?? '')),
			'field_ich_disease_faq_title'         => sanitize_text_field((string) ($result['disease_faq_title'] ?? '')),
			'field_ich_disease_faq_text'          => sanitize_textarea_field((string) ($result['disease_faq_text'] ?? '')),
		);

		foreach ($simple_fields as $field_key => $field_value) {
			update_field($field_key, $field_value, $post_id);
		}

		$price_rows       = $this->normalize_price_rows($result['disease_price_rows'] ?? array());
		$advantages       = $this->normalize_text_items($result['disease_advantages'] ?? array(), 3);
		$diagnostics      = $this->normalize_text_items($result['disease_diagnostics'] ?? array(), 3);
		$treatments       = $this->normalize_text_items($result['disease_treatments'] ?? array(), 3);
		$faq_items        = $this->normalize_faq_items($result['disease_faq'] ?? array());
		$banner_features  = $this->normalize_text_items($result['disease_banner_features'] ?? array(), 4);
		$banner_treatments = $this->normalize_text_items($result['disease_banner_treatments'] ?? array(), 4);
		$banner_benefits  = $this->normalize_text_items($result['disease_banner_benefits'] ?? array(), 3);

		for ($index = 1; $index <= 4; $index++) {
			$item = $price_rows[ $index - 1 ] ?? array('service' => '', 'price' => '');
			update_field('field_ich_disease_price_' . $index . '_service', $item['service'], $post_id);
			update_field('field_ich_disease_price_' . $index . '_price', $item['price'], $post_id);
		}

		for ($index = 1; $index <= 3; $index++) {
			$item = $advantages[ $index - 1 ] ?? array('title' => '', 'text' => '');
			update_field('field_ich_disease_advantage_' . $index . '_title', $item['title'], $post_id);
			update_field('field_ich_disease_advantage_' . $index . '_text', $item['text'], $post_id);
		}

		for ($index = 1; $index <= 3; $index++) {
			$item = $diagnostics[ $index - 1 ] ?? array('title' => '', 'text' => '');
			update_field('field_ich_disease_diagnostic_' . $index . '_title', $item['title'], $post_id);
			update_field('field_ich_disease_diagnostic_' . $index . '_text', $item['text'], $post_id);
		}

		for ($index = 1; $index <= 3; $index++) {
			$item = $treatments[ $index - 1 ] ?? array('title' => '', 'text' => '');
			update_field('field_ich_disease_treatment_' . $index . '_title', $item['title'], $post_id);
			update_field('field_ich_disease_treatment_' . $index . '_text', $item['text'], $post_id);
		}

		for ($index = 1; $index <= 3; $index++) {
			$item = $faq_items[ $index - 1 ] ?? array('question' => '', 'answer' => '');
			update_field('field_ich_disease_faq_' . $index . '_question', $item['question'], $post_id);
			update_field('field_ich_disease_faq_' . $index . '_answer', $item['answer'], $post_id);
		}

		for ($index = 1; $index <= 4; $index++) {
			$item = $banner_features[ $index - 1 ] ?? array('title' => '', 'text' => '');
			update_field('field_ich_disease_banner_feature_' . $index . '_title', $item['title'], $post_id);
			update_field('field_ich_disease_banner_feature_' . $index . '_text', $item['text'], $post_id);
		}

		for ($index = 1; $index <= 4; $index++) {
			$item = $banner_treatments[ $index - 1 ] ?? array('title' => '', 'text' => '');
			update_field('field_ich_disease_banner_treatment_' . $index . '_title', $item['title'], $post_id);
			update_field('field_ich_disease_banner_treatment_' . $index . '_text', $item['text'], $post_id);
		}

		for ($index = 1; $index <= 3; $index++) {
			$item = $banner_benefits[ $index - 1 ] ?? array('title' => '', 'text' => '');
			update_field('field_ich_disease_banner_benefit_' . $index . '_title', $item['title'], $post_id);
			update_field('field_ich_disease_banner_benefit_' . $index . '_text', $item['text'], $post_id);
		}

		return true;
	}

	private function normalize_price_rows($price_rows) {
		$result = array();
		if (! is_array($price_rows)) {
			return $result;
		}

		foreach ($price_rows as $row) {
			if (! is_array($row)) {
				continue;
			}

			$service = sanitize_text_field((string) ($row['service'] ?? ''));
			$price   = sanitize_text_field((string) ($row['price'] ?? ''));

			if ($service === '' && $price === '') {
				continue;
			}

			$result[] = array(
				'service' => $service,
				'price'   => $price,
			);
		}

		return array_slice($result, 0, 4);
	}

	private function normalize_text_items($items, $max_items = 3) {
		$result = array();
		if (! is_array($items)) {
			return $result;
		}

		foreach ($items as $item) {
			if (! is_array($item)) {
				continue;
			}

			$title = sanitize_text_field((string) ($item['title'] ?? ''));
			$text  = sanitize_textarea_field((string) ($item['text'] ?? ''));

			if ($title === '' && $text === '') {
				continue;
			}

			$result[] = array(
				'title' => $title,
				'text'  => $text,
			);
		}

		return array_slice($result, 0, (int) $max_items);
	}

	private function normalize_faq_items($items) {
		$result = array();
		if (! is_array($items)) {
			return $result;
		}

		foreach ($items as $item) {
			if (! is_array($item)) {
				continue;
			}

			$question = sanitize_text_field((string) ($item['question'] ?? ''));
			$answer   = sanitize_textarea_field((string) ($item['answer'] ?? ''));

			if ($question === '' && $answer === '') {
				continue;
			}

			$result[] = array(
				'question' => $question,
				'answer'   => $answer,
			);
		}

		return array_slice($result, 0, 3);
	}

	private function extract_text_from_html($html) {
		$text = wp_strip_all_tags((string) $html, true);
		$text = preg_replace('/\s+/u', ' ', $text);

		return trim((string) $text);
	}

	private function get_response_schema() {
		$text_item_schema = array(
			'type'                 => 'object',
			'additionalProperties' => false,
			'properties'           => array(
				'title' => array('type' => 'string'),
				'text'  => array('type' => 'string'),
			),
			'required'             => array('title', 'text'),
		);

		return array(
			'type'                 => 'object',
			'additionalProperties' => false,
			'properties'           => array(
				// Banner
				'disease_banner_title'           => array('type' => 'string'),
				'disease_banner_title_accent'    => array('type' => 'string'),
				'disease_banner_subtitle'        => array('type' => 'string'),
				'disease_banner_photo_alt'       => array('type' => 'string'),
				'disease_banner_stat_prefix'     => array('type' => 'string'),
				'disease_banner_stat_value'      => array('type' => 'string'),
				'disease_banner_stat_suffix'     => array('type' => 'string'),
				'disease_banner_stat_note'       => array('type' => 'string'),
				'disease_banner_treatment_title' => array('type' => 'string'),
				'disease_banner_features'        => array(
					'type'  => 'array',
					'items' => $text_item_schema,
				),
				'disease_banner_treatments'      => array(
					'type'  => 'array',
					'items' => $text_item_schema,
				),
				'disease_banner_benefits'        => array(
					'type'  => 'array',
					'items' => $text_item_schema,
				),
				// Other sections
				'disease_intro_title'       => array('type' => 'string'),
				'disease_intro_text'        => array('type' => 'string'),
				'disease_prices_title'      => array('type' => 'string'),
				'disease_prices_text'       => array('type' => 'string'),
				'disease_price_rows'        => array(
					'type'  => 'array',
					'items' => array(
						'type'                 => 'object',
						'additionalProperties' => false,
						'properties'           => array(
							'service' => array('type' => 'string'),
							'price'   => array('type' => 'string'),
						),
						'required'             => array('service', 'price'),
					),
				),
				'disease_advantages_title'  => array('type' => 'string'),
				'disease_advantages_text'   => array('type' => 'string'),
				'disease_advantages'        => array(
					'type'  => 'array',
					'items' => $text_item_schema,
				),
				'disease_diagnostics_title' => array('type' => 'string'),
				'disease_diagnostics_text'  => array('type' => 'string'),
				'disease_diagnostics'       => array(
					'type'  => 'array',
					'items' => $text_item_schema,
				),
				'disease_treatments_title'  => array('type' => 'string'),
				'disease_treatments_text'   => array('type' => 'string'),
				'disease_treatments'        => array(
					'type'  => 'array',
					'items' => $text_item_schema,
				),
				'disease_faq_title'         => array('type' => 'string'),
				'disease_faq_text'          => array('type' => 'string'),
				'disease_faq'               => array(
					'type'  => 'array',
					'items' => array(
						'type'                 => 'object',
						'additionalProperties' => false,
						'properties'           => array(
							'question' => array('type' => 'string'),
							'answer'   => array('type' => 'string'),
						),
						'required'             => array('question', 'answer'),
					),
				),
			),
			'required'             => array(
				'disease_banner_title',
				'disease_banner_title_accent',
				'disease_banner_subtitle',
				'disease_banner_photo_alt',
				'disease_banner_stat_prefix',
				'disease_banner_stat_value',
				'disease_banner_stat_suffix',
				'disease_banner_stat_note',
				'disease_banner_treatment_title',
				'disease_banner_features',
				'disease_banner_treatments',
				'disease_banner_benefits',
				'disease_intro_title',
				'disease_intro_text',
				'disease_prices_title',
				'disease_prices_text',
				'disease_price_rows',
				'disease_advantages_title',
				'disease_advantages_text',
				'disease_advantages',
				'disease_diagnostics_title',
				'disease_diagnostics_text',
				'disease_diagnostics',
				'disease_treatments_title',
				'disease_treatments_text',
				'disease_treatments',
				'disease_faq_title',
				'disease_faq_text',
				'disease_faq',
			),
		);
	}

	private static function get_default_prompt_template() {
		return "Ты медицинский редактор для сайта клиники.\n"
			. "Используй только факты из источника.\n"
			. "Источник URL: {source_url}\n"
			. "Тема заболевания: {disease_title}\n\n"
			. "Требования:\n"
			. "- Не копируй формулировки из источника буквально.\n"
			. "- Пиши уникальным, естественным, человекописным русским языком.\n"
			. "- Не добавляй неподтвержденные факты.\n"
			. "- Цены можно брать по образцу из источника, но скорректировать в пределах +/-10%.\n"
			. "- Верни только JSON строго по заданной схеме.\n\n"
			. "Указания по полям баннера:\n"
			. "- disease_banner_title: основной заголовок баннера (краткое название заболевания или процедуры, до 60 символов).\n"
			. "- disease_banner_title_accent: акцентная часть заголовка (слово или фраза, которая выделяется цветом, 1-4 слова).\n"
			. "- disease_banner_subtitle: подзаголовок баннера (1-2 предложения, кратко о лечении в клинике).\n"
			. "- disease_banner_photo_alt: alt-текст для фото врача на баннере (описание фото, 5-10 слов).\n"
			. "- disease_banner_stat_prefix: текст перед статистической цифрой, например «Более» или «Свыше».\n"
			. "- disease_banner_stat_value: числовое значение статистики, например «5000» или «15».\n"
			. "- disease_banner_stat_suffix: единица или продолжение после цифры, например «пациентов» или «лет опыта».\n"
			. "- disease_banner_stat_note: краткое пояснение к статистике (1 предложение).\n"
			. "- disease_banner_treatment_title: заголовок блока «Комплексное лечение» (до 60 символов).\n"
			. "- disease_banner_features: 4 преимущества клиники (title — 3-5 слов, text — 1-2 предложения).\n"
			. "- disease_banner_treatments: 4 метода лечения (title — 3-5 слов, text — 1-2 предложения).\n"
			. "- disease_banner_benefits: 3 ключевых преимущества для пациента (title — 3-5 слов, text — 1-2 предложения).\n\n"
			. "Текст источника:\n"
			. "{source_text}";
	}
}

new IchilovTop_Ai_Disease_Generator();
