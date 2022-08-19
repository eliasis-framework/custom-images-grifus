# CHANGELOG

## 2022-08-19

* The repository was archived.

## 1.0.5 - 2018-02-15

* Implemented `PHP Mess Detector` to detect inconsistencies in code styles.

* Implemented `PHP Code Beautifier and Fixer` to fixing errors automatically.

* Implemented `PHP Coding Standards Fixer` to organize PHP code automatically according to WordPress standards.

* Implemented `Codacy` to automates code reviews and monitors code quality over time.

* Implemented `Codecov` to coverage reports.

## 1.0.4 - 2017-09-25

* Gulp was added to the project for task automation.

* Implemented `WordPress PHPCS code standard` from all library PHP files.

## 1.0.3 - 2017-09-09

* Replaced `eliasis-framework/module` to `eliasis-framework/complement` library.

* Deleted `custom-images-grifus/config/module-info.php` file.

## 1.0.2 - 2017-09-03

* The PHP configuration file was replaced by a json file.

* Deleted `custom-images-grifus/custom-images-grifus.php` file.

* Added `custom-images-grifus/custom-images-grifus.jsond` file.

* Added `custom-images-grifus/config/module-info.php` file.

## 1.0.1 - 2017-08-11

* Images attached will now be deleted when a movie is deleted.

* Added a option in the menu to set whether to replace images when adding a new movie.

* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Launcher\Launcher->activation()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Launcher\Launcher->setOptions()` method.

* Deleted `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Image\Image->setImages()` method.

* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Model\Launcher\Launcher->addOptions()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Model\Launcher\Launcher->getOptions()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Model\Launcher\Launcher->deleteOptions()` method.

* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Image\Image->replaceWhenAdd()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Image\Image->deleteAttachedImages()` method.

* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Model\Admin\Image\Image->setReplaceWhenAdd()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Model\Admin\Image\Image->deleteAttachedImages()` method.

* Added `replaceWhenAdd` method in `custom-images-grifus/public/js/custom-images-grifus-admin.js` file.

## 1.0.0 - 2017-06-20

* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Launcher\Launcher` class.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Launcher\Launcher->init()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Launcher\Launcher->uninstallation()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Launcher\Launcher->admin()` method.
ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Launcher\Launcher->setLanguages()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Launcher\Launcher->setImages()` method.

* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Model\Launcher\Launcher` class.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Model\Launcher\Launcher->deletePostMeta()` method.

* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Image\Image` class.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Image\Image->setImages()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Image\Image->replaceOldImages()` method.

* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Model\Admin\Image\Image` class.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Model\Admin\Image\Image->setImages()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Model\Admin\Image\Image->replaceOldImages()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Model\Admin\Image\Image->SetPostsToReview()` method.

* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Page\CustomImages\CustomImages` class.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Page\CustomImages\CustomImages->init()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Page\CustomImages\CustomImages->runAjax()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Page\CustomImages\CustomImages->getImageInstance()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Page\CustomImages\CustomImages->setSubmenu()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Page\CustomImages\CustomImages->addScripts()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Page\CustomImages\CustomImages->addStyles()` method.
* Added `ExtensionsForGrifus\Modules\CustomImagesGrifus\Controller\Admin\Page\CustomImages\CustomImages->render()` method.

* Added `custom-images-grifus/config/add-urls.php` file.
* Added `custom-images-grifus/config/assets.php` file.
* Added `custom-images-grifus/config/menu.php` file.
* Added `custom-images-grifus/config/namespaces.php` file.
* Added `custom-images-grifus/config/pages.php` file.
* Added `custom-images-grifus/config/paths.php` file.
* Added `custom-images-grifus/config/set-hooks.php` file.

* Added `custom-images-grifus/public/css/custom-images-grifus-admin.css` file.

* Added `custom-images-grifus/public/js/custom-images-grifus-admin.js` file.

* Added `custom-images-grifus/public/sass/custom-images-grifus-admin.sass` file.
* Added `custom-images-grifus/public/sass/layout/_custom-images.sass` file.
* Added `custom-images-grifus/public/sass/partials/_custom-images-section.sass` file.
* Added `custom-images-grifus/public/sass/partials/_forms.sass` file.

* Added `custom-images-grifus/resources/banner-1544x500.png` file.
* Added `custom-images-grifus/resources/screenshot-1.png` file.
* Added `custom-images-grifus/resources/screenshot-2.png` file.
* Added `custom-images-grifus/resources/screenshot-3.png` file.
* Added `custom-images-grifus/resources/screenshot-4.png` file.
* Added `custom-images-grifus/resources/screenshot-5.png` file.
* Added `custom-images-grifus/resources/screenshot-6.png` file.
* Added `custom-images-grifus/resources/screenshot-7.png` file.
* Added `custom-images-grifus/resources/screenshot-8.png` file.
* Added `custom-images-grifus/resources/screenshot-9.png` file.
* Added `custom-images-grifus/resources/screenshot-10.png` file.
* Added `custom-images-grifus/resources/screenshot-11.png` file.
* Added `custom-images-grifus/resources/screenshot-12.png` file.
* Added `custom-images-grifus/resources/screenshot-13.png` file.
* Added `custom-images-grifus/resources/screenshot-14.png` file.

* Added `custom-images-grifus/src/template/layout/custom-images.php` file.

* Added `custom-images-grifus/src/template/pages/custom-images.php` file.

* Added `eliasis-framework/eliasis` library.
* Added `composer/installers` library.
* Added `Josantonius/WP_Register` library.
* Added `Josantonius/Hook` library.
* Added `Josantonius/WP_Menu` library.
* Added `Josantonius/WP_Image` library.
