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

use Eliasis\View\View;

$data = View::get();
?>

<form enctype="multipart/form-data" id="custom-images-grifus-form" method="post" action="">
   <div class="mdl-cell mdl-cell--8-col mdl-cell--12-col-tablet mdl-cell--8-col-desktop mdl-grid mdl-grid--no-spacing-off">
      <div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-desktop jst-card">
         <div class="mdl-card__title mdl-card--expand mdl-color--blue-200">
            <h2 class="mdl-card__title-text jst-card-title">
               <?= __('Custom Images', 'extensions-for-grifus-images') ?>
            </h2>
            <div id="spinner-grifus" class="mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active"></div>
         </div>
         <div class="jst-card-subtitle mdl-card__supporting-text mdl-color-text--grey-600">
            <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-images">
              <input type="checkbox" id="checkbox-images" class="mdl-checkbox__input" <?= ($data['replace-when-add']) ? 'checked' : '' ?>>
              <span class="mdl-checkbox__label"><?= __('Replace images when adding a new movie', 'extensions-for-grifus-images') ?></span>
            </label><br /><br />
            <div class="mdl-card__actions mdl-card--border"></div>
            <?= __('Replace all current images', 'extensions-for-grifus-images') ?>
            <div id="tt4" class="icon material-icons info-icon">info_outline</div>
            <div class="mdl-tooltip mdl-tooltip--large" for="tt4">
            <?= __('This will replace all external IMDB images and saves them to your WordPress site', 'extensions-for-grifus-images') ?>
            </div>
            <div id="custom-section" class="mdl-list__item">
               <div class="custom-fields">
                  <div id="process" class="custom-fields">
                     <div id="film-title">
                        <div id="film-title-badge" class="material-icons g-icons movie-icon mdl-badge mdl-badge--overlap" data-badge="0">movie_filter</div>
                        <span class="actual-title grifus-span"><?= __('Reviewing posts...', 'extensions-for-grifus-images') ?></span><br />
                     </div>
                     <div id="film-images">
                        <div id="film-images-badge" class="material-icons g-icons picture-icon mdl-badge mdl-badge--overlap" data-badge="0">panorama</div>
                        <span class="grifus-span"><?= __('Images were replaced', 'extensions-for-grifus-images') ?></span><br />
                     </div>
                  </div>
                  <div class="replace-button">
                     <button id="replace-grifus-images" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                        <?= __('Replace all', 'extensions-for-grifus-images') ?>
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
