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

namespace EFG\Modules\CustomImagesGrifus\Controller\Admin;

use Eliasis\Framework\App;
use Eliasis\Framework\Controller;
use Eliasis\Complement\Type\Module;

/**
 * Image controller
 *
 * @since 1.0.0
 */
class Image extends Controller {

	/**
	 * Save images to the server when post has been added or edited.
	 *
	 * @param int     $post_id → post ID.
	 * @param object  $post    → (WP_Post) post object.
	 * @param boolean $update  → true if update post.
	 */
	public function set_images( $post_id, $post, $update ) {

		App::setCurrentID( 'EFG' );

		if ( Module::CustomImagesGrifus()->getOption( 'replace-when-add' ) ) {
			$is_insert_post = App::main()->is_after_insert_post( $post, $update );
			$is_update_post = App::main()->is_after_update_post( $post, $update );
			if ( $is_insert_post || $is_update_post ) {
				$this->model->set_images( $post_id );
			}
		}
	}

	/**
	 * Search post not edited previously and replace images.
	 */
	public function replace_old_images() {

		$nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';

		if ( ! wp_verify_nonce( $nonce, 'eliasis' ) && ! wp_verify_nonce( $nonce, 'customImagesGrifusAdmin' ) ) {
			die( 'Busted!' );
		}

		$this->model->set_posts_to_review();
		$response = $this->model->replace_old_images();

		echo json_encode( $response );

		die();
	}

	/**
	 * Replace image when added a movie.
	 *
	 * @since 1.0.1
	 */
	public function replace_when_add() {

		$state = isset( $_POST['state'] ) ? $_POST['state'] : null;
		$nonce = isset( $_POST['nonce'] ) ? $_POST['nonce'] : '';

		if ( ! wp_verify_nonce( $nonce, 'eliasis' ) && ! wp_verify_nonce( $nonce, 'customImagesGrifusAdmin' ) ) {
			die( 'Busted!' );
		}

		App::setCurrentID( 'EFG' );
		$slug = Module::CustomImagesGrifus()->getOption( 'slug' );
		$this->model->set_replace_when_add( $slug, $state );
		$response = [ 'replace-when-add' => $state ];

		echo json_encode( $response );

		die();
	}

	/**
	 * Delete attached images.
	 *
	 * @since 1.0.1
	 *
	 * @param int $post_id → post ID.
	 *
	 * @return int → attachments deleted
	 */
	public function delete_attached_images( $post_id ) {

		return $this->model->delete_attached_images( $post_id );
	}
}
