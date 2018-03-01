<?php
/**
 * Custom Images Grifus · Extensions For Grifus
 *
 * @author    Josantonius <hello@josantonius.com>
 * @package   eliasis-framework/custom-images-grifus
 * @copyright 2017 - 2018 (c) Josantonius - Custom Images Grifus
 * @license   GPL-2.0+
 * @link      https://github.com/eliasis-framework/custom-images-grifus.git
 * @since     1.0.0
 */

namespace EFG\Modules\CustomImagesGrifus\Controller\Admin\Page;

use Josantonius\WP_Register\WP_Register;
use Josantonius\WP_Menu\WP_Menu;
use Eliasis\Framework\App;
use Eliasis\Framework\Controller;
use Eliasis\Complement\Type\Module;

/**
 * Handler Custom Images Grifus page.
 */
class CustomImages extends Controller {

	/**
	 * Slug for this administration page.
	 *
	 * @var string $slug
	 */
	public $slug = 'custom-images-grifus';

	/**
	 * Class initializer method.
	 */
	public function init() {

		$this->run_ajax();
	}

	/**
	 * Add submenu for this page.
	 */
	public function set_submenu() {

		WP_Menu::add(
			'submenu',
			Module::CustomImagesGrifus()->getOption(
				'submenu',
				'custom-images-grifus'
			),
			[ $this, 'render' ],
			[ $this, 'add_styles' ],
			[ $this, 'add_scripts' ]
		);
	}

	/**
	 * Load scripts.
	 */
	public function add_scripts() {

		$scripts = [
			'eliasisMaterial',
			'extensionsForGrifusAdmin',
		];

		$js = App::EFG()->getOption( 'assets', 'js' );

		foreach ( $scripts as $script ) {
			WP_Register::add( 'script', $js[ $script ] );
		}

		$js = Module::CustomImagesGrifus()->getOption( 'assets', 'js' );

		$js = $js['customImagesGrifusAdmin'];

		$params = [
			'revised_text' => __(
				'All post have already been reviewed',
				'extensions-for-grifus-images'
			),
			'added_text' => __(
				'Posts were modified',
				'extensions-for-grifus-images'
			),
		];

		$js['params'] = array_merge( $js['params'], $params );

		WP_Register::add( 'script', $js );
	}

	/**
	 * Load styles.
	 */
	public function add_styles() {

		$css = App::EFG()->getOption( 'assets', 'css' );

		WP_Register::add( 'style', $css['extensionsForGrifusAdmin'] );

		$css = Module::CustomImagesGrifus()->getOption( 'assets', 'css' );

		WP_Register::add( 'style', $css['customImagesGrifusAdmin'] );
	}

	/**
	 * Renderizate admin page.
	 */
	public function render() {

		$layout = App::EFG()->getOption( 'path', 'layout' );

		$page = Module::CustomImagesGrifus()->getOption( 'path', 'page' );

		$replace = Module::CustomImagesGrifus()->getOption( 'replace-when-add' );

		$data = [ 'replace-when-add' => $replace ];

		$this->view->renderizate( $layout, 'header' );
		$this->view->renderizate( $page, 'custom-images', $data );
		$this->view->renderizate( $layout, 'footer' );
	}

	/**
	 * Run ajax in panel admin.
	 *
	 * @since 1.0.0
	 */
	public function run_ajax() {

		$image = Module::CustomImagesGrifus()->getControllerInstance( 'Image' );

		add_action( 'wp_ajax_replace_old_images', [ $image, 'replace_old_images' ] );
		add_action( 'wp_ajax_replace_when_add', [ $image, 'replace_when_add' ] );
	}
}
