<?php

/**
 * THEME
 */
add_action('wp_enqueue_scripts', 'theme_enqueue_styles'); // Chargement du thème
function theme_enqueue_styles()
{
	// Enqueue parent style
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('astra-enfant-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'), filemtime(get_stylesheet_directory() . '/style.css'));
	wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/scripts/script.js', array('jquery'), false, true);
}

// ENREGISTRER LES EMPLACEMENTS DE MENU
function theme_register_menus()
{
	register_nav_menus(
		array(
			'theme_location' => 'Menu principal',
			'header' => 'Entête enfant astra',
		)
	);


	add_theme_support('post-thumbnails'); // Exemple d'ajout de support pour les images à la une
	add_theme_support('custom-logo');
	add_theme_support('menus');
}

// Attachez la fonction à l'action after_setup_theme
add_action('after_setup_theme', 'theme_register_menus');


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

//PHOTOS
