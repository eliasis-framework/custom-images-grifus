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
     * @return void
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
     * Module activation hook. Executed when module is activated.
     * 
     * @since 1.0.1
     *
     * @return void
     */
    public function activation() {

        $this->model->addOptions();
    }

    /**
     * Module uninstallation hook. Executed when module is uninstalled.
     * 
     * @since 1.0.0
     *
     * @return void
     */
    public function uninstallation() {
        
        $this->model->deletePostMeta();

        $this->model->deleteOptions();
    }

    /**
     * Admin initializer method.
     * 
     * @since 1.0.0
     * 
     * @uses add_action() → hooks a function on to a specific action
     *
     * @return void
     */
    public function admin() {

        $this->setOptions();

        add_action('init', [$this, 'setLanguage']);
                
        $namespace = Module::CustomImagesGrifus()->get('namespaces');

        $pages = Module::CustomImagesGrifus()->get('pages');

        App::main()->setMenus($pages, $namespace['admin-page']);
        
        $Image = Module::CustomImagesGrifus()->instance('Image');

        add_action('wp_insert_post', [$Image, 'setImages'], 10, 3);

        add_action('before_delete_post', [$Image,'deleteAttachedImages'], 10, 1);
    }

    /**
     * Set database module options.
     *
     * @since 1.0.1
     *
     * @return void
     */
    public function setOptions() {

        $slug = Module::CustomImagesGrifus()->get('slug');

        $options = $this->model->getOptions();

        foreach ($options as $option => $value) {
            
            Module::CustomImagesGrifus()->set($option, $value);
        }
    }

    /**
     * Set plugin textdomain.
     * 
     * @since 1.0.0
     *
     * @return void
     */
    public function setLanguage() {

        $DS = App::DS;

        $pSlug = App::ExtensionsForGrifus()->get('slug');

        $mSlug = Module::CustomImagesGrifus()->get('slug');

        $path = $pSlug . $DS .'modules' .$DS. $mSlug .$DS. 'languages' . $DS;

        load_plugin_textdomain($pSlug . '-images', false, $path);
    }
}
