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

$namespace = Module::CustomImagesGrifus()->getOption( 'namespaces', 'controller' );

return [

	'hooks' => [

		[ 'launch-modules', [ $namespace . 'Launcher', 'init' ], 8, 0 ],
	],
];
