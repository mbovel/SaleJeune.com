<?php

add_action('ba_header', function() {
    echo '<a id="site_title" href="' . home_url() . '"><span class="char" id="char-S">S</span><span class="char" id="char-a">a</span><span class="char" id="char-l">l</span><span class="char" id="char-e">e</span><span class="char" id="char-J">J</span><span id="char-e2">e</span><span class="char" id="char-u">u</span><span class="char" id="char-n">n</span><span id="char-e3">e</span><small><span class="char" id="char-dot">.</span><span class="char" id="char-c">c</span><span class="char" id="char-o">o</span><span class="char" id="char-m">m</span></small></a>';
});

add_action('ba_footer', function() {
    echo '<p id="copyright">Textes, design et développement : copyright © 2015 <a href="http://matthieu.bovel.net" rel="author">Matthieu Bovel</a>, tous droits réservés.</p>';
});

add_action('wp_enqueue_scripts', function() {
	wp_enqueue_style('roboto', '//fonts.googleapis.com/css?family=Roboto:300,300italic,500,700&subset=latin,latin-ext', [], '1.1', 'all');
    wp_enqueue_style('salejeune', get_stylesheet_uri(), ['normalize', 'base'], '1.0', 'all');
    wp_enqueue_script('modernizr', get_stylesheet_directory_uri() . '/third-party/modernizr.js', [], '2.8.3', true);
});

add_filter('oq_name_css', function($handles) {
    if($handles === 'normalize,base,salejeune')
        return 'style';
    
    return $handles;
}, null);

add_filter('post_class', function($classes) {
	if(get_post_meta(get_the_ID(), 'bg', true) === 'light')
		$classes[] = 'light';
	else
		$classes[] = 'dark';
	
	return $classes;
});

add_filter('body_class', function($classes) {
	if(get_post_meta(get_the_ID(), 'bg', true) === 'light')
		$classes[] = 'light';
	else
		$classes[] = 'dark';
	
	return $classes;
});

add_filter('tiny_mce_before_init', function($init_array) {
	if(get_post_meta(get_the_ID(), 'bg', true) === 'light')
		$init_array['body_class'] = 'light';
	else
		$init_array['body_class'] = 'dark';
	
    return $init_array;
});

if(function_exists("register_field_group")) {
	register_field_group(array (
		'id' => 'acf_fond',
		'title' => 'Fond',
		'fields' => array (
			array (
				'key' => 'field_54d7e1e62fc98',
				'label' => 'Couleur du fond',
				'name' => 'bg',
				'type' => 'select',
				'required' => 1,
				'choices' => array (
					'dark' => 'Foncé',
					'light' => 'Clair',
				),
				'default_value' => 'dark',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

?>