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

namespace ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Image;

use Eliasis\Controller\Controller;
    
/**
 * Image controller
 *
 * @since 1.0.0
 */
class Image extends Controller {

    /**
     * Find IMDB images, save them and replace them in posts.
     * 
     * @since 1.0.0
     *
     * @param int $postID → post id
     *
     * @return string → posts edited number.
     */
    public function setImages($postID = 0) {

        return $this->model->setImages($postID);
    }

    /**
     * Search post not edited previously and replace images.
     * 
     * @since 1.0.0
     *
     * @return json
     */
    public function replaceOldImages() {

        $nonce = isset($_POST['custom_nonce']) ? $_POST['custom_nonce'] : '';

        if (!wp_verify_nonce($nonce, 'customImagesGrifusAdmin')) {
            
            die('Busted!');
        }

        $this->model->setPostsToReview();

        $response = $this->model->replaceOldImages();

        echo json_encode($response);

        die();
    }
}
