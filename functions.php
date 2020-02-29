<?php

function the_site_title() {
	echo '<a id="site_title" href="' . home_url() . '"><span class="char" id="char-S">S</span><span class="char" id="char-a">a</span><span class="char" id="char-l">l</span><span class="char" id="char-e">e</span><span class="char" id="char-J">J</span><span id="char-e2">e</span><span class="char" id="char-u">u</span><span class="char" id="char-n">n</span><span id="char-e3">e</span><small><span class="char" id="char-dot">.</span><span class="char" id="char-c">c</span><span class="char" id="char-o">o</span><span class="char" id="char-m">m</span></small></a>';
}

add_action( 'after_setup_theme', function() {
	add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption' ] );
	add_theme_support( 'title-tag' );
} );

add_editor_style( 'style.css' );

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,300italic,500,700&subset=latin,latin-ext', [], '1.1', 'all' );
	wp_enqueue_style( 'salejeune', get_stylesheet_uri(), [ 'roboto' ], '1.1', 'all' );
	wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri() . '/third-party/modernizr.js', [], '3.5.0', true );
} );

// See https://wordpress.stackexchange.com/a/211705
add_action( 'wp_footer', function() {
	wp_deregister_script( 'wp-embed' );
} );

add_filter( 'post_class', function( $classes ) {
	if ( get_post_meta( get_the_ID(), 'bg', true ) === 'light' ) {
		$classes[] = 'light';
	} else {
		$classes[] = 'dark';
	}

	return $classes;
} );

add_filter( 'tiny_mce_before_init', function( $init_array ) {
	if ( get_post_meta( get_the_ID(), 'bg', true ) === 'light' ) {
		$init_array['body_class'] = 'light';
	} else {
		$init_array['body_class'] = 'dark';
	}

	return $init_array;
} );

if ( function_exists( "acf_add_local_field_group" ) ) {
	acf_add_local_field_group( [
		'id'         => 'acf_fond',
		'title'      => 'Apparence',
		'fields'     => [
			[
				'key'           => 'field_54d7e1e62fc98',
				'label'         => 'Couleur du fond',
				'name'          => 'bg',
				'type'          => 'select',
				'required'      => 1,
				'choices'       => [
					'dark'  => 'Foncé',
					'light' => 'Clair',
				],
				'default_value' => 'dark',
				'allow_null'    => 0,
				'multiple'      => 0,
			],
			[
				'key'               => 'field_5dbef07a12d9e',
				'label'             => 'Rotation',
				'name'              => 'rotation',
				'type'              => 'range',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => [
					'width' => '',
					'class' => '',
					'id'    => '',
				],
				'default_value'     => 1,
				'min'               => - 2,
				'max'               => 2,
				'step'              => '0.5',
				'prepend'           => '',
				'append'            => '',
			],
		],
		'location'   => [
			[
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'post',
					'order_no' => 0,
					'group_no' => 0,
				],
			],
		],
		'options'    => [
			'position'       => 'side',
			'layout'         => 'default',
			'hide_on_screen' => [],
		],
		'menu_order' => 0,
	] );
}
