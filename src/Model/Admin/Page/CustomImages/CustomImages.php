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

namespace ExtensionsForGrifus\Modules\CustomImagesGrifus\Model\Admin\Page\CustomImages;

use Eliasis\Model\Model;

/**
 * Custom Images Grifus page model.
 *
 * @since 1.0.0
 */
class CustomImages extends Model {

    /**
     * Set posts to review.
     * 
     * @since 1.0.0
     *
     * @return void
     */
    public function SetPostsToReview() {

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
}
