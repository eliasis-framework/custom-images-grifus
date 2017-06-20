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

use Eliasis\Module\Module;

$css = Module::CustomImagesGrifus()->get('url', 'css');
$js  = Module::CustomImagesGrifus()->get('url', 'js');

return [

    'assets' => [

        'js' => [
            'customImagesGrifusAdmin' => [
                'name'      => 'customImagesGrifusAdmin',
                'url'       => $js . 'custom-images-grifus-admin.js',
                'place'     => 'admin',
                'deps'      => ['jquery'],
                'version'   => '1.0.0',
                'footer'    => true,
                'params'    => [
                    'ajax_url' => admin_url('admin-ajax.php'),
                ],
            ],
        ],

        'css' => [
            'customImagesGrifusAdmin' => [
                'name'      => 'customImagesGrifusAdmin',
                'url'       => $css . 'custom-images-grifus-admin.css',
                'place'     => 'admin',
                'deps'      => [],
                'version'   => '1.0.0',
                'media'     => '',
            ],
        ],
    ],
];
