/* global jQuery:false */
/* global LITTLE_BIRDIES_STORAGE:false */
/* global TRX_ADDONS_STORAGE:false */

jQuery(document).on('action.add_googlemap_styles', little_birdies_trx_addons_add_googlemap_styles);
jQuery(document).on('action.init_shortcodes', little_birdies_trx_addons_init);
jQuery(document).on('action.init_hidden_elements', little_birdies_trx_addons_init);

// Add theme specific styles to the Google map
function little_birdies_trx_addons_add_googlemap_styles(e) {
	TRX_ADDONS_STORAGE['googlemap_styles']['dark'] = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":20},{"color":"#13162b"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#13162b"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#5fc6ca"},{"lightness":21}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#cccdd2"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#13162b"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#ff0000"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#13162b"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#13162b"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#13162b"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#13162b"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#f4f9fc"},{"lightness":17}]}];
    TRX_ADDONS_STORAGE['googlemap_styles']['blue'] = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#a2d2ed"},{"visibility":"on"}]}];
}

function little_birdies_trx_addons_init(e, container) {
	"use strict";
	if (arguments.length < 2) var container = jQuery('body');
	if (container===undefined || container.length === undefined || container.length == 0) return;

	container.find('.sc_countdown_item canvas:not(.inited)').addClass('inited').attr('data-color', LITTLE_BIRDIES_STORAGE['alter_link_color']);
}