<?php

/**
 * THEME
 */
add_action('wp_enqueue_scripts', 'theme_enqueue_styles'); // Chargement du thème
function theme_enqueue_styles()
{
	// Enqueue parent style
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('astra-enfant-style', get_stylesheet_directory_uri() . '/css/style.css', array('parent-style'), filemtime(get_stylesheet_directory() . '/css/style.css'));
	wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/scripts/script.js', array('jquery'), false, true);
}




// Get customizer options form parent theme
if (get_stylesheet() !== get_template()) {
	add_filter('pre_update_option_theme_mods_' . get_stylesheet(), function ($value, $old_value) {
		update_option('theme_mods_' . get_template(), $value);
		return $old_value; // prevent update to child theme mods
	}, 10, 2);
	add_filter('pre_option_theme_mods_' . get_stylesheet(), function ($default) {
		return get_option('theme_mods_' . get_template(), $default);
	});
}
