<?php
defined('TYPO3_MODE') or die('Access denied.');

// === Commands ===

if (TYPO3_MODE === 'BE') {
  $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][$_EXTKEY] = \T3v\T3vIlluminate\Command\Page\LanguageOverlayCommandController::class;
}