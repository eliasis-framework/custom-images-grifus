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

namespace EFG\Modules\CustomImagesGrifus\Controller;

use Eliasis\Complement\Type\Module;
use Eliasis\Framework\Controller;
use Eliasis\Framework\App;

/**
 * Module main controller.
 */
class Launcher extends Controller {

	/**
	 * Class initializer method.
	 */
	public function init() {

		$state = Module::CustomImagesGrifus()->getOption( 'state' );

		if ( 'active' === $state || 'outdated' === $state ) {

			if ( is_admin() ) {
				App::setCurrentID( 'EFG' );
				$this->admin();
			}
		}
	}

	/**
	 * Module activation hook. Executed when module is activated.
	 *
	 * @since 1.0.1
	 */
	public function activation() {

		$this->model->add_options();
	}

	/**
	 * Module uninstallation hook. Executed when module is uninstalled.
	 */
	public function uninstallation() {

		$this->model->delete_post_meta();
		$this->model->delete_options();
	}

	/**
	 * Admin initializer method.
	 *
	 * @uses add_action() → hooks a function on to a specific action
	 */
	public function admin() {

		$this->set_options();

		add_action( 'init', [ $this, 'set_language' ] );

		$namespace = Module::CustomImagesGrifus()->getOption( 'namespaces' );
		$pages = Module::CustomImagesGrifus()->getOption( 'pages' );
		App::main()->set_menus( $pages, $namespace['admin-page'] );
		$image = Module::CustomImagesGrifus()->getControllerInstance( 'Image' );

		add_action( 'wp_insert_post', [ $image, 'setImages' ], 10, 3 );
		add_action( 'before_delete_post', [ $image, 'deleteAttachedImages' ], 10, 1 );
	}

	/**
	 * Set database module options.
	 *
	 * @since 1.0.1
	 */
	public function set_options() {

		$slug = Module::CustomImagesGrifus()->getOption( 'slug' );
		$options = $this->model->get_options();

		foreach ( $options as $option => $value ) {
			Module::CustomImagesGrifus()->setOption( $option, $value );
		}
	}

	/**
	 * Set plugin textdomain.
	 */
	public function set_language() {

		$plugin_slug = App::EFG()->getOption( 'slug' );
		$module_slug = Module::CustomImagesGrifus()->getOption( 'slug' );
		$path = $plugin_slug . '/modules/' . $module_slug . '/languages/';

		load_plugin_textdomain( $plugin_slug . '-images', false, $path );
	}
}
