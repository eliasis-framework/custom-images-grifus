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

namespace ExtensionsForGrifus\Modules\CustomImagesGrifus\Model\Launcher;

use Eliasis\Model\Model;
    
/**
 * Module main model.
 *
 * @since 1.0.0
 */
class Launcher extends Model {

    /**
     * Delete post meta by key.
     * 
     * @since 1.0.0
     */
    public function deletePostMeta() {

        delete_post_meta_by_key('custom_images_grifus'); 
    }
}
