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

namespace EFG\Modules\CustomImagesGrifus\Model\Admin;

use Eliasis\Framework\Model;
use Josantonius\WP_Image\WP_Image;

/**
 * Image controller
 */
class Image extends Model {

	/**
	 * Find IMDB images, save them and replace them in posts.
	 *
	 * @param int $post_id → post id.
	 *
	 * @return string → posts edited number
	 */
	public function set_images( $post_id ) {

		if ( ! $post_id || is_null( $post_id ) ) {
			return 0; }

		update_post_meta( $post_id, 'custom_images_grifus', 'true' );

		$count = 0;
		$tmdb = 'image.tmdb.org';
		$poster = get_post_meta( $post_id, 'poster_url', true );

		if ( filter_var( $poster, FILTER_VALIDATE_URL ) && strpos( $poster, $tmdb ) ) {
			$count++;
			$poster = WP_Image::save( $poster, $post_id, true );
			update_post_meta( $post_id, 'poster_url', $poster );
		}

		$main = get_post_meta( $post_id, 'fondo_player', true );

		if ( filter_var( $main, FILTER_VALIDATE_URL ) && strpos( $main, $tmdb ) ) {
			$count++;
			$main = WP_Image::save( $main, $post_id );
			update_post_meta( $post_id, 'fondo_player', $main );
		}

		$images = get_post_meta( $post_id, 'imagenes', true );
		$images_array = explode( "\n", $images );
		$new_images = '';

		foreach ( $images_array as $image ) {
			$image = trim( $image );
			if ( filter_var( $image, FILTER_VALIDATE_URL ) && strpos( $image, $tmdb ) ) {
				$count++;
				$url = WP_Image::save( $image, $post_id );
				$new_images .= $url . "\n";
			}
		}

		if ( ! empty( $new_images ) ) {
			update_post_meta( $post_id, 'imagenes', $new_images );
		}

		return $count;
	}

	/**
	 * Search post not edited previously and replace images.
	 *
	 * @return array
	 */
	public function replace_old_images() {

		global $wpdb;

		$response = [
			'post_id'      => 0,
			'post_title'   => '',
			'images_added' => 0,
		];

		$post_table = $wpdb->prefix . 'posts';

		$postmeta_table = $wpdb->prefix . 'postmeta';

		$query = "
            SELECT     ID, post_title
            FROM       $post_table
            INNER JOIN $postmeta_table 
            ON         $post_table.ID = $postmeta_table.post_id
            WHERE      $post_table.post_type = 'post'
            AND        $post_table.post_status = 'publish'
            AND        $postmeta_table.meta_key = 'custom_images_grifus'
            AND        $postmeta_table.meta_value = 'false'
            ORDER BY   $post_table.ID ASC
        ";

		$post = $wpdb->get_row( $query );

		if ( ! is_null( $post ) && isset( $post->ID ) && isset( $post->post_title ) ) {
			$post_id = $post->ID;
			$images_added = $this->set_images( $post->ID );
			$response = [
				'post_id'      => $post->ID,
				'post_title'   => $post->post_title,
				'images_added' => $images_added,
			];
		}

		return $response;
	}

	/**
	 * Set posts to review.
	 */
	public function set_posts_to_review() {

		$total_posts = wp_count_posts();
		$total_posts = isset( $total_posts->publish ) ? $total_posts->publish : 0;

		$posts = get_posts(
			[
				'post_type'   => 'post',
				'numberposts' => $total_posts,
				'post_status' => 'publish',
			]
		);

		foreach ( $posts as $post ) {
			if ( isset( $post->ID ) ) {
				add_post_meta(
					$post->ID,
					'custom_images_grifus',
					'false',
					true
				);
			}
		}
	}

	/**
	 * Set state for replace images when added a movie.
	 *
	 * @since 1.0.1
	 *
	 * @param string  $slug  → module slug.
	 * @param boolean $state → restart when added a movie.
	 */
	public function set_replace_when_add( $slug, $state ) {

		update_option( $slug . '-replace-when-add', $state );
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

		return WP_Image::delete_attached_images( $post_id );
	}
}
