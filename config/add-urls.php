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

use Eliasis\Framework\App;
use Eliasis\Complement\Type\Module;

$url = App::MODULES_URL() . Module::CustomImagesGrifus()->getOption( 'folder' );

return [

	'url' => [

		'css'    => $url . 'public/css/',
		'js'     => $url . 'public/js/',
		'images' => $url . 'public/images/',
	],
];
