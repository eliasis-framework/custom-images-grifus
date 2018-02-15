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

namespace EFG\Modules\CustomImagesGrifus\Model;

use Eliasis\Framework\Model;
use Eliasis\Complement\Type\Module;

/**
 * Module main model.
 */
class Launcher extends Model {

	/**
	 * Delete post meta by key.
	 */
	public function delete_post_meta() {

		delete_post_meta_by_key( 'custom_images_grifus' );
	}

	/**
	 * Set database module options.
	 *
	 * @since 1.0.1
	 */
	public function add_options() {

		$slug = Module::CustomImagesGrifus()->getOption( 'slug' );

		if ( ! get_option( $slug . '-replace-when-add' ) ) {
			add_option( $slug . '-replace-when-add', 1 );
		}
	}

	/**
	 * Get database module options.
	 *
	 * @since 1.0.1
	 *
	 * @uses get_option()
	 *
	 * @return array
	 */
	public function get_options() {

		$slug = Module::CustomImagesGrifus()->getOption( 'slug' );

		return [

			'replace-when-add' => get_option( $slug . '-replace-when-add' ),
		];
	}

	/**
	 * Delete database module options.
	 *
	 * @since 1.0.1
	 */
	public function delete_options() {

		$slug = Module::CustomImagesGrifus()->getOption( 'slug' );

		delete_option( $slug . '-replace-when-add', true );
	}
}
