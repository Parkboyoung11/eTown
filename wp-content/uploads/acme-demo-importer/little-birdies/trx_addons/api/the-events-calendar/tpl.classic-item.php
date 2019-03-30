<?php
/**
 * The style "default" of the Events
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_events');

if ($args['slider']) {
	?><div class="swiper-slide"><?php
} else if ($args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}
?><a href="<?php echo esc_url(get_permalink()); ?>" class="sc_event_item"><div class="event-image"><?php

    // Featured image
    little_birdies_show_post_featured(
        array(
            'hover' => 'icon',
            'thumb_size' => little_birdies_get_thumb_size('event')
        )
    );
    ?><div class="event-info"><?php
        echo '<h6 class="event-time-header">' . esc_html__('Time:','little-birdies'). '</h6>';
        echo '<span class="event-day">' . tribe_get_start_date(null, true, 'l') . '</span>';
        echo '<span class="event-time">' . tribe_get_start_date(null, true, 'h A') . '</span>';

        echo '<h6 class="event-location-header">' . esc_html__('Location:','little-birdies'). '</h6>';
        echo '<span class="event-location">' . tribe_get_venue() . '</span>';

    ?></div></div><?php

	// Event's date
	$date = tribe_get_start_date(null, true, 'd-m');
	if (empty($date)) $date = get_the_date('d-m');
	$date = explode('-', $date);
	?><span class="sc_event_item_date">
		<span class="sc_event_item_day"><?php echo esc_html($date[0]); ?></span>
		<span class="sc_event_item_month"><?php echo esc_html($date[1]); ?></span>
	</span><?php
	// Event's title
	?><h5 class="sc_event_item_title"><?php the_title(); ?></h5><?php
	// Arrow (button)
	?><span class="sc_event_item_button"></span><?php
?></a><?php

if ($args['slider'] || $args['columns'] > 1) {
	?></div><?php
}

?>