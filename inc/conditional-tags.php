<?php
/**
 * Custom conditional tags for this theme.
 *
 * @package Shoppette
 */


/**
 * Is EDD activated?
 *
 * @return bool
 */
function shoppette_edd_is_activated() {
	return class_exists( 'Easy_Digital_Downloads' );
}