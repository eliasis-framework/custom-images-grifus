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

namespace ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Launcher;

use Eliasis\Module\Module,
    Eliasis\Controller\Controller,
    Eliasis\App\App;
    
/**
 * Module main controller.
 *
 * @since 1.0.0
 */
class Launcher extends Controller {
    
    /**
     * Class initializer method.
     * 
     * @since 1.0.0
     *
     * @return
     */
    public function init() {

        $state = Module::CustomImagesGrifus()->get('state');

        if ($state === 'active' || $state === 'outdated') {

            if (is_admin()) {

                App::id('ExtensionsForGrifus');

                $this->admin();
            } 
        }
    }

    /**
     * Module uninstallation hook. Executed when module is uninstalled.
     * 
     * @since 1.0.0
     */
    public function uninstallation() {

        $this->model->deletePostMeta();
    }

    /**
     * Admin initializer method.
     * 
     * @since 1.0.0
     * 
     * @uses add_action() → hooks a function on to a specific action
     */
    public function admin() {

        add_action('init', [$this, 'setLanguage']);
                
        $namespace = Module::CustomImagesGrifus()->get('namespaces');

        $pages = Module::CustomImagesGrifus()->get('pages');

        App::main()->setMenus($pages, $namespace['admin-page']);

        $this->setImages();
    }

    /**
     * Set plugin textdomain.
     * 
     * @since 1.0.0
     */
    public function setLanguage() {

        $DS = App::DS;

        $pSlug = App::ExtensionsForGrifus()->get('slug');

        $mSlug = Module::CustomImagesGrifus()->get('slug');

        $path = $pSlug . $DS .'modules' .$DS. $mSlug .$DS. 'languages' . $DS;

        load_plugin_textdomain($pSlug . '-images', false, $path);
    }

    /**
     * Save images to the server when post has been added or edited.
     * 
     * @since 1.0.0
     */
    public function setImages() {

        add_action('wp_insert_post', function() {

            App::id('ExtensionsForGrifus');

            if (App::main()->isAfterInsertPost()) {

                $Image = Module::CustomImagesGrifus()->instance('Image');

                $Image->setImages();
            }
        });
    }
}
