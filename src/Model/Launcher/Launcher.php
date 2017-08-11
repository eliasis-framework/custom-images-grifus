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

use Eliasis\Model\Model,
	Eliasis\Module\Module;
    
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

    /**
     * Set database module options.
     * 
     * @since 1.0.1
     *
     * @return void
     */
    public function addOptions() {
        
        $slug = Module::CustomImagesGrifus()->get('slug');

        if (!get_option($slug . '-replace-when-add')) {

            add_option($slug . '-replace-when-add', 1);
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
    public function getOptions() {

        $slug = Module::CustomImagesGrifus()->get('slug');

        return [

            'replace-when-add' => get_option($slug . '-replace-when-add')
        ];
    }

    /**
     * Delete database module options.
     * 
     * @since 1.0.1
     *
     * @return void
     */
    public function deleteOptions() {

        $slug = Module::CustomImagesGrifus()->get('slug');

        delete_option($slug . '-replace-when-add', true);
    }
}
