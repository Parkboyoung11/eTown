<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage LITTLE_BIRDIES
 * @since LITTLE_BIRDIES 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('little_birdies_storage_get')) {
	function little_birdies_storage_get($var_name, $default='') {
		global $LITTLE_BIRDIES_STORAGE;
		return isset($LITTLE_BIRDIES_STORAGE[$var_name]) ? $LITTLE_BIRDIES_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('little_birdies_storage_set')) {
	function little_birdies_storage_set($var_name, $value) {
		global $LITTLE_BIRDIES_STORAGE;
		$LITTLE_BIRDIES_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('little_birdies_storage_empty')) {
	function little_birdies_storage_empty($var_name, $key='', $key2='') {
		global $LITTLE_BIRDIES_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($LITTLE_BIRDIES_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($LITTLE_BIRDIES_STORAGE[$var_name][$key]);
		else
			return empty($LITTLE_BIRDIES_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('little_birdies_storage_isset')) {
	function little_birdies_storage_isset($var_name, $key='', $key2='') {
		global $LITTLE_BIRDIES_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($LITTLE_BIRDIES_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($LITTLE_BIRDIES_STORAGE[$var_name][$key]);
		else
			return isset($LITTLE_BIRDIES_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('little_birdies_storage_inc')) {
	function little_birdies_storage_inc($var_name, $value=1) {
		global $LITTLE_BIRDIES_STORAGE;
		if (empty($LITTLE_BIRDIES_STORAGE[$var_name])) $LITTLE_BIRDIES_STORAGE[$var_name] = 0;
		$LITTLE_BIRDIES_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('little_birdies_storage_concat')) {
	function little_birdies_storage_concat($var_name, $value) {
		global $LITTLE_BIRDIES_STORAGE;
		if (empty($LITTLE_BIRDIES_STORAGE[$var_name])) $LITTLE_BIRDIES_STORAGE[$var_name] = '';
		$LITTLE_BIRDIES_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('little_birdies_storage_get_array')) {
	function little_birdies_storage_get_array($var_name, $key, $key2='', $default='') {
		global $LITTLE_BIRDIES_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($LITTLE_BIRDIES_STORAGE[$var_name][$key]) ? $LITTLE_BIRDIES_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($LITTLE_BIRDIES_STORAGE[$var_name][$key][$key2]) ? $LITTLE_BIRDIES_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('little_birdies_storage_set_array')) {
	function little_birdies_storage_set_array($var_name, $key, $value) {
		global $LITTLE_BIRDIES_STORAGE;
		if (!isset($LITTLE_BIRDIES_STORAGE[$var_name])) $LITTLE_BIRDIES_STORAGE[$var_name] = array();
		if ($key==='')
			$LITTLE_BIRDIES_STORAGE[$var_name][] = $value;
		else
			$LITTLE_BIRDIES_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('little_birdies_storage_set_array2')) {
	function little_birdies_storage_set_array2($var_name, $key, $key2, $value) {
		global $LITTLE_BIRDIES_STORAGE;
		if (!isset($LITTLE_BIRDIES_STORAGE[$var_name])) $LITTLE_BIRDIES_STORAGE[$var_name] = array();
		if (!isset($LITTLE_BIRDIES_STORAGE[$var_name][$key])) $LITTLE_BIRDIES_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$LITTLE_BIRDIES_STORAGE[$var_name][$key][] = $value;
		else
			$LITTLE_BIRDIES_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('little_birdies_storage_merge_array')) {
	function little_birdies_storage_merge_array($var_name, $key, $value) {
		global $LITTLE_BIRDIES_STORAGE;
		if (!isset($LITTLE_BIRDIES_STORAGE[$var_name])) $LITTLE_BIRDIES_STORAGE[$var_name] = array();
		if ($key==='')
			$LITTLE_BIRDIES_STORAGE[$var_name] = array_merge($LITTLE_BIRDIES_STORAGE[$var_name], $value);
		else
			$LITTLE_BIRDIES_STORAGE[$var_name][$key] = array_merge($LITTLE_BIRDIES_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('little_birdies_storage_set_array_after')) {
	function little_birdies_storage_set_array_after($var_name, $after, $key, $value='') {
		global $LITTLE_BIRDIES_STORAGE;
		if (!isset($LITTLE_BIRDIES_STORAGE[$var_name])) $LITTLE_BIRDIES_STORAGE[$var_name] = array();
		if (is_array($key))
			little_birdies_array_insert_after($LITTLE_BIRDIES_STORAGE[$var_name], $after, $key);
		else
			little_birdies_array_insert_after($LITTLE_BIRDIES_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('little_birdies_storage_set_array_before')) {
	function little_birdies_storage_set_array_before($var_name, $before, $key, $value='') {
		global $LITTLE_BIRDIES_STORAGE;
		if (!isset($LITTLE_BIRDIES_STORAGE[$var_name])) $LITTLE_BIRDIES_STORAGE[$var_name] = array();
		if (is_array($key))
			little_birdies_array_insert_before($LITTLE_BIRDIES_STORAGE[$var_name], $before, $key);
		else
			little_birdies_array_insert_before($LITTLE_BIRDIES_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('little_birdies_storage_push_array')) {
	function little_birdies_storage_push_array($var_name, $key, $value) {
		global $LITTLE_BIRDIES_STORAGE;
		if (!isset($LITTLE_BIRDIES_STORAGE[$var_name])) $LITTLE_BIRDIES_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($LITTLE_BIRDIES_STORAGE[$var_name], $value);
		else {
			if (!isset($LITTLE_BIRDIES_STORAGE[$var_name][$key])) $LITTLE_BIRDIES_STORAGE[$var_name][$key] = array();
			array_push($LITTLE_BIRDIES_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('little_birdies_storage_pop_array')) {
	function little_birdies_storage_pop_array($var_name, $key='', $defa='') {
		global $LITTLE_BIRDIES_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($LITTLE_BIRDIES_STORAGE[$var_name]) && is_array($LITTLE_BIRDIES_STORAGE[$var_name]) && count($LITTLE_BIRDIES_STORAGE[$var_name]) > 0) 
				$rez = array_pop($LITTLE_BIRDIES_STORAGE[$var_name]);
		} else {
			if (isset($LITTLE_BIRDIES_STORAGE[$var_name][$key]) && is_array($LITTLE_BIRDIES_STORAGE[$var_name][$key]) && count($LITTLE_BIRDIES_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($LITTLE_BIRDIES_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('little_birdies_storage_inc_array')) {
	function little_birdies_storage_inc_array($var_name, $key, $value=1) {
		global $LITTLE_BIRDIES_STORAGE;
		if (!isset($LITTLE_BIRDIES_STORAGE[$var_name])) $LITTLE_BIRDIES_STORAGE[$var_name] = array();
		if (empty($LITTLE_BIRDIES_STORAGE[$var_name][$key])) $LITTLE_BIRDIES_STORAGE[$var_name][$key] = 0;
		$LITTLE_BIRDIES_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('little_birdies_storage_concat_array')) {
	function little_birdies_storage_concat_array($var_name, $key, $value) {
		global $LITTLE_BIRDIES_STORAGE;
		if (!isset($LITTLE_BIRDIES_STORAGE[$var_name])) $LITTLE_BIRDIES_STORAGE[$var_name] = array();
		if (empty($LITTLE_BIRDIES_STORAGE[$var_name][$key])) $LITTLE_BIRDIES_STORAGE[$var_name][$key] = '';
		$LITTLE_BIRDIES_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('little_birdies_storage_call_obj_method')) {
	function little_birdies_storage_call_obj_method($var_name, $method, $param=null) {
		global $LITTLE_BIRDIES_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($LITTLE_BIRDIES_STORAGE[$var_name]) ? $LITTLE_BIRDIES_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($LITTLE_BIRDIES_STORAGE[$var_name]) ? $LITTLE_BIRDIES_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('little_birdies_storage_get_obj_property')) {
	function little_birdies_storage_get_obj_property($var_name, $prop, $default='') {
		global $LITTLE_BIRDIES_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($LITTLE_BIRDIES_STORAGE[$var_name]->$prop) ? $LITTLE_BIRDIES_STORAGE[$var_name]->$prop : $default;
	}
}
?>