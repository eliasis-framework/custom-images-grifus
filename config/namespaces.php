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

$namespace = App::EFG()->getOption( 'namespaces', 'modules' );

$module = '';

return [

	'namespaces' => [

		'controller' => $namespace . 'CustomImagesGrifus\\Controller\\',
		'admin'      => $namespace . 'CustomImagesGrifus\\Controller\\Admin\\',
		'admin-page' => $namespace . 'CustomImagesGrifus\\Controller\\Admin\\Page\\',
	],
];
