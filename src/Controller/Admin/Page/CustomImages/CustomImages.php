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

namespace ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Page\CustomImages;

use Josantonius\WP_Register\WP_Register,
    Josantonius\WP_Menu\WP_Menu,
    Eliasis\App\App,
    Eliasis\Module\Module,
    Eliasis\Controller\Controller;

/**
 * Handler Custom Images Grifus page.
 *
 * @since 1.0.0
 */
class CustomImages extends Controller {

    /**
     * Slug for this administration page.
     *
     * @since 1.0.0
     *
     * @var string $page
     */
    public $slug = 'custom-images-grifus';

    /**
     * Class initializer method.
     *
     * @since 1.0.0
     */
    public function init() {
        
        $this->runAjax();
    }

    /**
     * Add submenu for this page.
     *
     * @since 1.0.0
     */
    public function setSubmenu() {

        WP_Menu::add(
            'submenu', 
            Module::CustomImagesGrifus()->get(
                'submenu', 
                'custom-images-grifus'
            ), 
            [$this, 'render'],
            'addStyles',
            'addScripts'
        );
    }

    /**
     * Load scripts.
     *
     * @since 1.0.0
     */
    public function addScripts() {

        $scripts = [
            'eliasisMaterial',
            'extensionsForGrifusAdmin'
        ];

        $js = App::ExtensionsForGrifus()->get('assets', 'js');

        foreach ($scripts as $script) {

            WP_Register::add('script', $js[$script]);
        }

        $js = Module::CustomImagesGrifus()->get('assets', 'js');

        $js = $js['customImagesGrifusAdmin'];

        $params = [
            'revised_text' => __(
                'All post have already been reviewed', 
                'extensions-for-grifus-images'
            ),
            'added_text' => __(
                'Posts were modified', 
                'extensions-for-grifus-images'
            ),
            'custom_nonce' => wp_create_nonce('customImagesGrifusAdmin')
        ];

        $js['params'] = array_merge($js['params'], $params);

        WP_Register::add('script', $js);
    }

    /**
     * Load styles.
     *
     * @since 1.0.0
     */
    public function addStyles() {

        $css = App::ExtensionsForGrifus()->get('assets', 'css');

        WP_Register::add('style', $css['extensionsForGrifusAdmin']);

        $css = Module::CustomImagesGrifus()->get('assets', 'css');

        WP_Register::add('style',  $css['customImagesGrifusAdmin']);
    }

    /**
     * Renderizate admin page.
     *
     * @since 1.0.0
     */
    public function render() {

        $layout = App::ExtensionsForGrifus()->get('path', 'layout');

        $page = Module::CustomImagesGrifus()->get('path','page');

        $replace = Module::CustomImagesGrifus()->get('replace-when-add');

        $data = ['replace-when-add' => $replace];

        $this->view->renderizate($layout, 'header');
        $this->view->renderizate($page,   'custom-images', $data);
        $this->view->renderizate($layout, 'footer');       
    }

    /**
     * Run ajax in panel admin.
     * 
     * @since 1.0.0
     */
    public function runAjax() {

        $Image = Module::CustomImagesGrifus()->instance('Image');

        add_action('wp_ajax_replaceOldImages', [$Image, 'replaceOldImages']);
        add_action('wp_ajax_replaceWhenAdd',   [$Image, 'replaceWhenAdd']);
    }
}
