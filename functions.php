<?php
/**
 * Theme functions for Ichilov Top.
 *
 * @package IchilovTop
 */

if (! defined('ABSPATH')) {
	exit;
}

function ichilovtop_theme_setup() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));

	register_nav_menus(
		array(
			'primary' => __('Primary Menu', 'ichilovtop'),
			'footer'  => __('Footer Menu', 'ichilovtop'),
		)
	);
}
add_action('after_setup_theme', 'ichilovtop_theme_setup');

function ichilovtop_enqueue_assets() {
	$style_path = get_stylesheet_directory() . '/style.css';
	$version    = wp_get_theme()->get('Version');
	if (is_readable($style_path)) {
		$version .= '.' . (string) filemtime($style_path);
	}

	wp_enqueue_style(
		'ichilovtop-style',
		get_stylesheet_uri(),
		array(),
		$version
	);
}
add_action('wp_enqueue_scripts', 'ichilovtop_enqueue_assets');

function ichilovtop_register_post_types() {
	register_post_type(
		'disease',
		array(
			'labels' => array(
				'name'               => __('Заболевания', 'ichilovtop'),
				'singular_name'      => __('Заболевание', 'ichilovtop'),
				'add_new'            => __('Добавить заболевание', 'ichilovtop'),
				'add_new_item'       => __('Добавить новое заболевание', 'ichilovtop'),
				'edit_item'          => __('Редактировать заболевание', 'ichilovtop'),
				'new_item'           => __('Новое заболевание', 'ichilovtop'),
				'view_item'          => __('Смотреть заболевание', 'ichilovtop'),
				'search_items'       => __('Искать заболевания', 'ichilovtop'),
				'not_found'          => __('Заболевания не найдены', 'ichilovtop'),
				'not_found_in_trash' => __('В корзине заболеваний не найдено', 'ichilovtop'),
				'menu_name'          => __('Заболевания', 'ichilovtop'),
			),
			'public'             => true,
			'has_archive'        => false,
			'menu_icon'          => 'dashicons-heart',
			'show_in_rest'       => false,
			'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
			'taxonomies'         => array('disease_department'),
			'rewrite'            => array('slug' => 'diseases', 'with_front' => false),
		)
	);

	register_taxonomy(
		'disease_department',
		array('disease'),
		array(
			'labels'            => array(
				'name'              => __('Отделения', 'ichilovtop'),
				'singular_name'     => __('Отделение', 'ichilovtop'),
				'search_items'      => __('Искать отделения', 'ichilovtop'),
				'all_items'         => __('Все отделения', 'ichilovtop'),
				'edit_item'         => __('Редактировать отделение', 'ichilovtop'),
				'update_item'       => __('Обновить отделение', 'ichilovtop'),
				'add_new_item'      => __('Добавить отделение', 'ichilovtop'),
				'new_item_name'     => __('Название отделения', 'ichilovtop'),
				'menu_name'         => __('Отделения', 'ichilovtop'),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => false,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'departments', 'with_front' => false),
		)
	);
}
add_action('init', 'ichilovtop_register_post_types');

/**
 * Group published diseases by hierarchical taxonomy disease_department.
 * Uses the first assigned term per post (same idea as single-disease banner).
 *
 * @return array{sections: array<int, array{parent: WP_Term, blocks: array<int, array{child: ?WP_Term, posts: WP_Post[]}>}>, uncategorized: WP_Post[]}
 */
function ichilovtop_group_diseases_by_department() {
	$query = new WP_Query(
		array(
			'post_type'              => 'disease',
			'post_status'            => 'publish',
			'posts_per_page'         => -1,
			'orderby'                => 'title',
			'order'                  => 'ASC',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => true,
		)
	);

	$uncategorized = array();
	$raw           = array();

	foreach ($query->posts as $post) {
		$terms = get_the_terms($post, 'disease_department');
		if (empty($terms) || is_wp_error($terms)) {
			$uncategorized[] = $post;
			continue;
		}
		$terms = array_values($terms);
		$term  = $terms[0];
		if ((int) $term->parent > 0) {
			$parent_id = (int) $term->parent;
			$child_id  = (int) $term->term_id;
		} else {
			$parent_id = (int) $term->term_id;
			$child_id  = 0;
		}
		if (! isset($raw[ $parent_id ])) {
			$raw[ $parent_id ] = array();
		}
		if (! isset($raw[ $parent_id ][ $child_id ])) {
			$raw[ $parent_id ][ $child_id ] = array();
		}
		$raw[ $parent_id ][ $child_id ][] = $post;
	}

	$parent_terms = get_terms(
		array(
			'taxonomy'   => 'disease_department',
			'parent'     => 0,
			'hide_empty' => false,
			'orderby'    => 'name',
			'order'      => 'ASC',
		)
	);

	$sections = array();
	if (! is_wp_error($parent_terms) && ! empty($parent_terms)) {
		foreach ($parent_terms as $parent) {
			$pid = (int) $parent->term_id;
			if (empty($raw[ $pid ])) {
				continue;
			}
			$child_posts = $raw[ $pid ];
			$blocks      = array();
			if (! empty($child_posts[0])) {
				$blocks[] = array(
					'child' => null,
					'posts' => $child_posts[0],
				);
			}
			$other_ids = array_keys($child_posts);
			$other_ids = array_values(
				array_filter(
					$other_ids,
					static function ($id) {
						return (int) $id !== 0;
					}
				)
			);
			usort(
				$other_ids,
				static function ($a, $b) {
					$ta = get_term((int) $a, 'disease_department');
					$tb = get_term((int) $b, 'disease_department');
					if (is_wp_error($ta) || ! $ta) {
						return 1;
					}
					if (is_wp_error($tb) || ! $tb) {
						return -1;
					}
					return strcasecmp($ta->name, $tb->name);
				}
			);
			foreach ($other_ids as $cid) {
				$ct = get_term((int) $cid, 'disease_department');
				if (is_wp_error($ct) || ! $ct) {
					continue;
				}
				$blocks[] = array(
					'child' => $ct,
					'posts' => $child_posts[ $cid ],
				);
			}
			$sections[] = array(
				'parent' => $parent,
				'blocks' => $blocks,
			);
		}
	}

	return array(
		'sections'      => $sections,
		'uncategorized' => $uncategorized,
	);
}

add_filter('use_block_editor_for_post', '__return_false', 100);
add_filter('use_block_editor_for_post_type', '__return_false', 100);
add_filter('gutenberg_can_edit_post', '__return_false', 100);
add_filter('gutenberg_can_edit_post_type', '__return_false', 100);

function ichilovtop_disable_block_widgets() {
	remove_theme_support('widgets-block-editor');
}
add_action('after_setup_theme', 'ichilovtop_disable_block_widgets');

function ichilovtop_get_field($field_name, $default = '', $post_id = false) {
	if (function_exists('get_field')) {
		$value = get_field($field_name, $post_id);

		if ($value !== null && $value !== false && $value !== '') {
			return $value;
		}
	}

	return $default;
}

function ichilovtop_get_image_url($field_name, $default = '', $post_id = false, $size = 'large') {
	$image = function_exists('get_field') ? get_field($field_name, $post_id) : null;

	if (is_array($image)) {
		if (! empty($image['sizes'][$size])) {
			return $image['sizes'][$size];
		}

		if (! empty($image['url'])) {
			return $image['url'];
		}
	}

	if (is_numeric($image)) {
		$url = wp_get_attachment_image_url((int) $image, $size);
		if ($url) {
			return $url;
		}
	}

	if (is_string($image) && $image !== '') {
		return $image;
	}

	return $default;
}

function ichilovtop_get_media_url($media, $size = 'large') {
	if (is_array($media)) {
		if (! empty($media['sizes'][ $size ])) {
			return $media['sizes'][ $size ];
		}

		if (! empty($media['url'])) {
			return $media['url'];
		}

		if (! empty($media['ID'])) {
			$media = $media['ID'];
		}
	}

	if (is_numeric($media)) {
		$url = wp_get_attachment_image_url((int) $media, $size);
		if ($url) {
			return $url;
		}
	}

	if (is_string($media) && $media !== '') {
		return $media;
	}

	return '';
}

function ichilovtop_allowed_svg_tags() {
	return array(
		'svg'          => array(
			'xmlns'       => true,
			'viewbox'     => true,
			'viewBox'     => true,
			'fill'        => true,
			'stroke'      => true,
			'stroke-width'=> true,
			'class'       => true,
			'width'       => true,
			'height'      => true,
			'aria-hidden' => true,
			'role'        => true,
			'focusable'   => true,
		),
		'g'            => array(
			'fill'             => true,
			'stroke'           => true,
			'stroke-width'     => true,
			'stroke-linecap'   => true,
			'stroke-linejoin'  => true,
			'stroke-dasharray' => true,
			'transform'        => true,
			'opacity'          => true,
		),
		'path'         => array(
			'd'                => true,
			'fill'             => true,
			'stroke'           => true,
			'stroke-width'     => true,
			'stroke-linecap'   => true,
			'stroke-linejoin'  => true,
			'stroke-dasharray' => true,
			'transform'        => true,
			'opacity'          => true,
		),
		'line'         => array(
			'x1'               => true,
			'y1'               => true,
			'x2'               => true,
			'y2'               => true,
			'stroke'           => true,
			'stroke-width'     => true,
			'stroke-linecap'   => true,
			'stroke-linejoin'  => true,
			'stroke-dasharray' => true,
			'opacity'          => true,
		),
		'rect'         => array(
			'x'            => true,
			'y'            => true,
			'width'        => true,
			'height'       => true,
			'rx'           => true,
			'ry'           => true,
			'fill'         => true,
			'stroke'       => true,
			'stroke-width' => true,
			'opacity'      => true,
			'transform'    => true,
		),
		'circle'       => array(
			'cx'           => true,
			'cy'           => true,
			'r'            => true,
			'fill'         => true,
			'stroke'       => true,
			'stroke-width' => true,
			'opacity'      => true,
			'transform'    => true,
		),
		'ellipse'      => array(
			'cx'           => true,
			'cy'           => true,
			'rx'           => true,
			'ry'           => true,
			'fill'         => true,
			'stroke'       => true,
			'stroke-width' => true,
			'opacity'      => true,
			'transform'    => true,
		),
		'polygon'      => array(
			'points'       => true,
			'fill'         => true,
			'stroke'       => true,
			'stroke-width' => true,
			'opacity'      => true,
		),
		'polyline'     => array(
			'points'          => true,
			'fill'            => true,
			'stroke'          => true,
			'stroke-width'    => true,
			'stroke-linecap'  => true,
			'stroke-linejoin' => true,
			'opacity'         => true,
		),
		'title'        => array(),
		'desc'         => array(),
		'defs'         => array(),
		'clippath'     => array('id' => true),
		'clipPath'     => array('id' => true),
		'lineargradient' => array(
			'id'                => true,
			'x1'                => true,
			'y1'                => true,
			'x2'                => true,
			'y2'                => true,
			'gradientunits'     => true,
			'gradientUnits'     => true,
			'gradienttransform' => true,
		),
		'linearGradient' => array(
			'id'                => true,
			'x1'                => true,
			'y1'                => true,
			'x2'                => true,
			'y2'                => true,
			'gradientUnits'     => true,
			'gradientTransform' => true,
		),
		'stop'         => array(
			'offset'       => true,
			'stop-color'   => true,
			'stop-opacity' => true,
		),
	);
}

function ichilovtop_render_icon_markup($svg_markup = '', $media = '', $size = 'thumbnail') {
	$svg_markup = is_string($svg_markup) ? trim($svg_markup) : '';

	if ($svg_markup !== '') {
		return wp_kses($svg_markup, ichilovtop_allowed_svg_tags());
	}

	$media_url = ichilovtop_get_media_url($media, $size);
	if ($media_url === '') {
		return '';
	}

	return sprintf('<img src="%1$s" alt="" loading="lazy" decoding="async">', esc_url($media_url));
}

function ichilovtop_get_fixed_items($prefix, $count, $sub_fields, $default = array(), $post_id = false) {
	$items = array();

	for ($index = 1; $index <= $count; $index++) {
		$item    = array();
		$has_any = false;

		foreach ($sub_fields as $sub_field) {
			$field_name = sprintf('%1$s_%2$d_%3$s', $prefix, $index, $sub_field);
			$value      = function_exists('get_field') ? get_field($field_name, $post_id) : null;

			if ($value !== null && $value !== false && $value !== '') {
				$item[ $sub_field ] = $value;
				$has_any            = true;
			} elseif (isset($default[ $index - 1 ][ $sub_field ])) {
				$item[ $sub_field ] = $default[ $index - 1 ][ $sub_field ];
			} else {
				$item[ $sub_field ] = '';
			}
		}

		if ($has_any || array_filter($item)) {
			$items[] = $item;
		}
	}

	return ! empty($items) ? $items : $default;
}

require_once get_template_directory() . '/inc/acf-fields.php';
