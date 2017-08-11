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

use Eliasis\App\App,
    Eliasis\Module\Module,
    Eliasis\Controller\Controller;
    
/**
 * Image controller
 *
 * @since 1.0.0
 */
class Image extends Controller {

    /**
     * Save images to the server when post has been added or edited.
     * 
     * @since 1.0.0
     *
     * @param int $postID     → post ID
     * @param object $post    → (WP_Post) post object
     * @param boolean $update → true if update post
     *
     * @return void
     */
    public function setImages($postID, $post, $update) {

        App::id('ExtensionsForGrifus');

        if (Module::CustomImagesGrifus()->get('replace-when-add')) { 

            $isInsertPost = App::main()->isAfterInsertPost($post, $update);
            $isUpdatePost = App::main()->isAfterUpdatePost($post, $update);

            if ($isInsertPost || $isUpdatePost) {

                $this->model->setImages($postID);
            }
        }
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

    /**
     * Replace image when added a movie.
     * 
     * @since 1.0.1
     *
     * @return void
     */
    public function replaceWhenAdd() {

        $state = isset($_POST['state']) ? $_POST['state'] : null;

        $nonce = wp_verify_nonce(

            isset($_POST['custom_nonce']) ? $_POST['custom_nonce'] : false, 
            'customImagesGrifusAdmin'
        );

        if (!$nonce || is_null($state)) { die; }

        App::id('ExtensionsForGrifus');

        $slug = Module::CustomImagesGrifus()->get('slug');

        $this->model->setReplaceWhenAdd($slug, $state);

        $response = ['replace-when-add' => $state];

        echo json_encode($response);

        die();
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

        return $this->model->deleteAttachedImages($postID);
    }
}
