<?php
/**
 * Custom Images Grifus · Extensions For Grifus
 *
 * @author    Josantonius <hello@josantonius.com>
 * @package   Josantonius/Custom-Images-Grifus
 * @copyright 2017 - 2018 (c) Josantonius - Custom Images Grifus
 * @license   GPL-2.0+
 * @link      https://github.com/Josantonius/Custom-Images-Grifus.git
 * @since     1.0.0
 */

return [

	'submenu' => [
		'custom-images-grifus' => [
			'parent'     => 'extensions-for-grifus',
			'title'      => __( 'Custom Images', 'extensions-for-grifus-images' ),
			'name'       => __( 'Custom Images', 'extensions-for-grifus-images' ),
			'capability' => 'manage_options',
			'slug'       => 'extensions-for-grifus-images',
			'function'   => '',
		],
	],
];
