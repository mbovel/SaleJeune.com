<?php

add_action('ba_header', function() {
    echo '<a id="site_title" href="' . home_url() . '"><span class="char" id="char-S">S</span><span class="char" id="char-a">a</span><span class="char" id="char-l">l</span><span class="char" id="char-e">e</span><span class="char" id="char-J">J</span><span id="char-e2">e</span><span class="char" id="char-u">u</span><span class="char" id="char-n">n</span><span id="char-e3">e</span><small><span class="char" id="char-dot">.</span><span class="char" id="char-c">c</span><span class="char" id="char-o">o</span><span class="char" id="char-m">m</span></small></a>';
});

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('salejeune', get_stylesheet_uri(), array('normalize', 'base'), '1.0', 'all');
});

add_filter('oq_name_css', function($handles) {
    if($handles === 'normalize,base,salejeune')
        return 'style';
    
    return $handles;
}, null);

add_action('after_setup_theme', function() {
    ba_add_theme_support('footer_menu');
});

add_filter('post_class', function($classes) {
	if(get_post_meta(get_the_ID(), 'bg', true) === 'light')
		$classes[] = 'light';
	else
		$classes[] = 'dark';
	
	return $classes;
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