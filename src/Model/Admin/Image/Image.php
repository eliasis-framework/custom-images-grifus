<?php
/**
 * Custom Images Grifus · Extensions For Grifus
 * 
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c) 2017
 * @license    GPL-2.0+
 * @link       https://github.com/Josantonius/Custom-Images-Grifus.git
 * @since      1.0.0
 */

namespace ExtensionsForGrifus\Modules\CustomImagesGrifus\Model\Admin\Image;

use Eliasis\Model\Model,
    Josantonius\WP_Image\WP_Image;
    
/**
 * Image controller
 *
 * @since 1.0.0
 */
class Image extends Model {

    /**
     * Find IMDB images, save them and replace them in posts.
     * 
     * @since 1.0.0
     *
     * @param int $postID → post id
     *
     * @return string → posts edited number
     */
    public function setImages($postID) {

        if (!$postID || is_null($postID)) { return 0; }

        update_post_meta($postID, 'custom_images_grifus', 'true');

        $count = 0;

        $tmdb = 'image.tmdb.org';

        $poster = get_post_meta($postID, 'poster_url',  true);

        if (filter_var($poster, FILTER_VALIDATE_URL) && strpos($poster, $tmdb)) {

            $count++;

            $poster = WP_Image::save($poster, $postID, true);
            
            update_post_meta($postID, 'poster_url', $poster);
        }

        $main = get_post_meta($postID, 'fondo_player',  true);

        if (filter_var($main, FILTER_VALIDATE_URL) && strpos($main, $tmdb)) {

            $count++;
            
            $main = WP_Image::save($main, $postID);
            
            update_post_meta($postID, 'fondo_player', $main);
        }

        $images = get_post_meta($postID, 'imagenes',  true);

        $imagesArray = explode("\n", $images);

        $newImages = '';

        foreach ($imagesArray as $image) {

            $image = trim($image);

            if (filter_var($image, FILTER_VALIDATE_URL) && strpos($image,$tmdb)) {

                $count++;
            
                $url = WP_Image::save($image, $postID);
                
                $newImages .= $url . "\n";
            }
        }

        if (!empty($newImages)) {

            update_post_meta($postID, 'imagenes', $newImages);
        }

        return $count;
    }

    /**
     * Search post not edited previously and replace images.
     * 
     * @since 1.0.0
     *
     * @return array
     */
    public function replaceOldImages() {

        global $wpdb;

        $response = [

            'post_id'      => 0,
            'post_title'   => '',
            'images_added' => 0,
        ];

        $postTable = $wpdb->prefix . "posts";

        $postmetaTable = $wpdb->prefix . "postmeta";

        $query = "
            SELECT     ID, post_title
            FROM       $postTable
            INNER JOIN $postmetaTable 
            ON         $postTable.ID = $postmetaTable.post_id
            WHERE      $postTable.post_type = 'post'
            AND        $postTable.post_status = 'publish'
            AND        $postmetaTable.meta_key = 'custom_images_grifus'
            AND        $postmetaTable.meta_value = 'false'
            ORDER BY   $postTable.ID ASC
        "; 

        $post = $wpdb->get_row($query);

        if (!is_null($post) && isset($post->ID) && isset($post->post_title)) {

            $postID = $post->ID;

            $imagesAdded = $this->setImages($post->ID);

            $response = [
            
                'post_id'      => $post->ID,
                'post_title'   => $post->post_title,
                'images_added' => $imagesAdded,
            ];
        }

        return $response;
    }

    /**
     * Set posts to review.
     * 
     * @since 1.0.0
     *
     * @return void
     */
    public function setPostsToReview() {

        $totalPosts = wp_count_posts();

        $totalPosts = isset($totalPosts->publish) ? $totalPosts->publish : 0;

        $posts = get_posts([

            'post_type'   => 'post', 
            'numberposts' => $totalPosts,
            'post_status' => 'publish'
        ]);

        foreach ($posts as $post) {

            if (isset($post->ID)) {

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
     * @param string  $slug  → module slug
     * @param boolean $state → restart when added a movie
     *
     * @return void
     */
    public function setReplaceWhenAdd($slug, $state) {

        update_option($slug . '-replace-when-add', $state);
    }

    /**
     * Delete attached images.
     * 
     * @since 1.0.1
     *
     * @param int $postID → post ID
     *
     * @return int → attachments deleted
     */
    public function deleteAttachedImages($postID) {

        return WP_Image::deleteAttachedImages($postID);
    }
}
