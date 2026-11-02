<?php
/**
 * Plugin Name:       Interest Rate Decision Widgets
 * Plugin URI:        https://interestratedecision.com/widget/
 * Description:       Central bank widgets from InterestRateDecision.com: rate cut odds, a decision countdown, the calendar, every bank's rate, rate differentials and a rate cut calculator. No cookies.
 * Version:           1.0.0
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author:            InterestRateDecision.com
 * Author URI:        https://interestratedecision.com/
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       interest-rate-decision-widgets
 */

if (!defined('ABSPATH')) {
	exit;
}

define('IRDW_ORIGIN', 'https://interestratedecision.com');

function irdw_types() {
	return array('odds', 'countdown', 'next', 'rates', 'differential', 'calculator');
}
function irdw_banks() {
	return array('fed', 'ecb', 'boe', 'boj', 'boc', 'rba', 'rbnz', 'snb', 'norges', 'riksbank');
}

/** The widget's markup: the same code the widget studio gives, with its plain link. */
function irdw_markup($atts) {
	$a = shortcode_atts(array(
		'type'   => 'odds',
		'bank'   => '',
		'banks'  => '',
		'n'      => '',
		'pair'   => '',
		'theme'  => '',
		'accent' => '',
		'odds'   => '',
		'spark'  => '',
		'border' => '',
	), $atts, 'ird_widget');

	$type = in_array($a['type'], irdw_types(), true) ? $a['type'] : 'odds';
	$data = array('widget' => $type);
	if (in_array($a['bank'], irdw_banks(), true)) {
		$data['bank'] = $a['bank'];
	}
	if ($a['banks'] !== '') {
		$list = array_values(array_intersect(array_map('trim', explode(',', strtolower($a['banks']))), irdw_banks()));
		if ($list) {
			$data['banks'] = implode(',', $list);
		}
	}
	if (ctype_digit((string) $a['n'])) {
		$data['n'] = (string) max(1, min(20, (int) $a['n']));
	}
	if (preg_match('/^[A-Za-z]{6}$/', $a['pair'])) {
		$data['pair'] = strtoupper($a['pair']);
	}
	if (in_array($a['theme'], array('light', 'dark', 'auto'), true)) {
		$data['theme'] = $a['theme'];
	}
	$accent = ltrim((string) $a['accent'], '#');
	if (preg_match('/^[0-9a-fA-F]{6}$/', $accent)) {
		$data['accent'] = strtolower($accent);
	}
	if ($a['odds'] === '1') {
		$data['odds'] = '1';
	}
	if ($a['spark'] === '0') {
		$data['spark'] = '0';
	}
	if ($a['border'] === '0') {
		$data['border'] = '0';
	}

	wp_enqueue_script('irdw-embed');
	$attrs = '';
	foreach ($data as $k => $v) {
		$attrs .= ' data-' . $k . '="' . esc_attr($v) . '"';
	}
	return '<div class="ird-widget"' . $attrs . '><a href="' . esc_url(IRDW_ORIGIN . '/') . '">InterestRateDecision.com</a></div>';
}

add_action('wp_enqueue_scripts', function () {
	wp_register_script('irdw-embed', IRDW_ORIGIN . '/embed.js', array(), null, true);
});

// The script loads without holding up the page.
add_filter('script_loader_tag', function ($tag, $handle) {
	return $handle === 'irdw-embed' ? str_replace(' src=', ' async src=', $tag) : $tag;
}, 10, 2);

/*
 * [ird_widget type="odds" bank="fed"]
 * type: odds, countdown, next, rates, differential, calculator
 * bank, banks="fed,ecb", n, pair="EURUSD", theme="light|dark|auto", accent="3d5afe", odds="1", spark="0", border="0"
 */
add_shortcode('ird_widget', 'irdw_markup');

/** The same widgets for a sidebar or footer. */
class IRDW_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'irdw_widget',
			__('Interest Rate Decision', 'interest-rate-decision-widgets'),
			array('description' => __('Rate odds, a countdown, the calendar, rates, differentials or the calculator.', 'interest-rate-decision-widgets'))
		);
	}

	public function widget($args, $instance) {
		echo $args['before_widget'];
		if (!empty($instance['title'])) {
			echo $args['before_title'] . esc_html(apply_filters('widget_title', $instance['title'])) . $args['after_title'];
		}
		echo irdw_markup($instance);
		echo $args['after_widget'];
	}

	public function form($instance) {
		$fields = array(
			'title' => __('Title (optional)', 'interest-rate-decision-widgets'),
			'type'  => __('Widget: odds, countdown, next, rates, differential or calculator', 'interest-rate-decision-widgets'),
			'bank'  => __('Bank: fed, ecb, boe, boj, boc, rba, rbnz, snb, norges or riksbank', 'interest-rate-decision-widgets'),
			'pair'  => __('Pair, for the differential (EURUSD)', 'interest-rate-decision-widgets'),
			'theme' => __('Theme: light, dark or auto', 'interest-rate-decision-widgets'),
		);
		foreach ($fields as $key => $label) {
			$value = isset($instance[$key]) ? $instance[$key] : ($key === 'type' ? 'odds' : '');
			printf(
				'<p><label for="%1$s">%2$s</label><input class="widefat" id="%1$s" name="%3$s" type="text" value="%4$s"></p>',
				esc_attr($this->get_field_id($key)),
				esc_html($label),
				esc_attr($this->get_field_name($key)),
				esc_attr($value)
			);
		}
	}

	public function update($new_instance, $old_instance) {
		$out = array();
		foreach (array('title', 'type', 'bank', 'pair', 'theme') as $k) {
			$out[$k] = isset($new_instance[$k]) ? sanitize_text_field($new_instance[$k]) : '';
		}
		return $out;
	}
}

add_action('widgets_init', function () {
	register_widget('IRDW_Widget');
});
