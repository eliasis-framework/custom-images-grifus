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

use Eliasis\Complement\Type\Module;

$css = Module::CustomImagesGrifus()->getOption( 'url', 'css' );
$js  = Module::CustomImagesGrifus()->getOption( 'url', 'js' );

return [

	'assets' => [

		'js' => [
			'customImagesGrifusAdmin' => [
				'name'      => 'customImagesGrifusAdmin',
				'url'       => $js . 'custom-images-grifus-admin.min.js',
				'place'     => 'admin',
				'deps'      => [ 'jquery' ],
				'version'   => '1.0.0',
				'footer'    => true,
				'params'    => [
					'ajax_url' => admin_url( 'admin-ajax.php' ),
				],
			],
		],

		'css' => [
			'customImagesGrifusAdmin' => [
				'name'      => 'customImagesGrifusAdmin',
				'url'       => $css . 'custom-images-grifus-admin.min.css',
				'place'     => 'admin',
				'deps'      => [],
				'version'   => '1.0.0',
				'media'     => '',
			],
		],
	],
];
