<?php

if(!defined('ABSPATH')) {
	exit;
}

use Elementor\Utils;

/** @var \ElementorModal\Widgets\GT3_Core_Elementor_Widget_TestimonialsLite $widget */

$settings = array(
	'nav'           => 'none',
	'items_per_line' => '1',
	'autoplay'      => true,
	'autoplay_time' => 4000,
	'space'			=> '30px',
	'round_imgs'    => false,
	'image_position'=> 'aside',	
	'item_align'	=> 'left',	
	'image_size'    => array(
		'size' => 60
	),
);

$settings = wp_parse_args($widget->get_settings(), $settings);

$css_class = array(
	'gt3_testimonial',
	'active-carousel',
	'items_per_line-' .intval($settings['items_per_line']),
);

if(!empty($settings['type'])) {
	$css_class[] = esc_attr($settings['type']);
}
if(!empty($settings['item_align'])) {
	$css_class[] = 'text_align-'.esc_attr($settings['item_align']);
}
if(!empty($settings['image_position'])) {
	$css_class[] = 'image_position-'.esc_attr($settings['image_position']);
}
if(!empty($settings['nav'])) {
	$css_class[] = 'nav-'.esc_attr($settings['nav']);
}

$widget->add_render_attribute('wrapper', 'class', $css_class);
$data = array(
	'fade'          => false,
	'autoplay'      => (bool) $settings['autoplay'],
	'items_per_line' => intval($settings['items_per_line']),
	'autoplaySpeed' => intval($settings['autoplay_time']),
	'dots'          => ($settings['nav'] === 'dots') ? true : false,
	'arrows'        => ($settings['nav'] === 'arrows') ? true : false,
	'l10n'          => array(
		'prev' => esc_html__('Prev', 'gt3_themes_core'),
		'next' => esc_html__('Next', 'gt3_themes_core'),
	),
);

$quote_src = plugins_url( '/core/elementor/assets/image/quote.png', GT3_THEMES_CORE_PLUGIN_FILE );
$quote_src = apply_filters( 'gt3_testimonial_quote_src', $quote_src );

$widget->add_render_attribute('wrapper', 'data-quote-src', $quote_src);
$widget->add_render_attribute('wrapper', 'data-settings', wp_json_encode($data));

if(is_array($settings['items']) && count($settings['items'])) {
	?>
	<div <?php $widget->print_render_attribute_string('wrapper') ?>>
		<div class="module_content testimonials_list">
			<div class="testimonials_rotator">
				<?php
				foreach($settings['items'] as $index => $item) {
					$hidden = (intval($index) + 1) > intval($settings['items_per_line']) ? 'display: none;' : '';
					?>
                    <div class="testimonials_item" style="<?php echo esc_attr( $hidden ); ?>">
						<div class="testimonial_item_wrapper">
							<div class="testimonials_content">
								<?php
								$text  = ( ! empty( $item['content'] ) ? '<div class="testimonials-text"><img class="testimonials-text-quote"><div class="testimonials-text-wrapper">'.$item['content'].'</div></div>' : '' );
								$photo = '';
								$title = ( ! empty( $item['tstm_author'] ) ? '<div class="testimonials_title">'.esc_html( $item['tstm_author'] ).'</div>' : '' );
								$title .= ( ! empty( $item['sub_name'] ) ? '<div class="testimonials-sub_name">'.esc_html( $item['sub_name'] ).'</div>' : '' );

								if(!empty($item['image']['id'])) {
									$repeater_key = $widget->get_repeater_key('image', 'items', $index);
									if($settings['round_imgs']) {
										$widget->add_render_attribute($repeater_key, 'class', 'rounded');
									}
									$src = Utils::get_placeholder_image_src();
									if(isset($item['image']['id']) && (bool) $item['image']['id']) {
										$image = wp_get_attachment_image_src($item['image']['id'], 'single-post-thumbnail');
										if($image) {
											if (!empty($settings['image_size']) && is_array($settings['image_size']) && !empty($settings['image_size']['size']) ) {
												$src = aq_resize($image[0], $settings['image_size']['size']*2, $settings['image_size']['size']*2, true, true, true);
											}else{
												$src = $image[0];
											}
										}
									}

									$widget->add_render_attribute($repeater_key, 'src', esc_url($src));
									$widget->add_render_attribute($repeater_key, 'style', 'width:'.esc_attr($settings['image_size']['size']).'px;height:'.esc_attr($settings['image_size']['size']).'px;');
									$photo = '<div class="testimonials_photo"><img '.$widget->get_render_attribute_string($repeater_key).' alt="" /></div>';
								}
								echo $text;
								if ( 
									(!empty($settings['image_position']) && $settings['image_position'] == 'bottom') ||									
									(!empty($settings['image_position']) && $settings['image_position'] == 'aside' && !empty($settings['item_align']) && $settings['item_align'] == 'right')
								) {
									echo '<div class="testimonials_author_wrapper">'.$title.$photo.'</div>';
								}else{
									echo '<div class="testimonials_author_wrapper">'.$photo.$title.'</div>';
								}
								?>
							</div>
						</div>
					</div>
				<?php
				} // end foreach
				?>
			</div>
			<div class="clear"></div>
		</div>
	</div>

<?php
} // end if



