<?php
defined('TYPO3_MODE') or die('Access denied.');

call_user_func(function ($extkey) {
  // === TypoScript ===

  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extkey, 'Configuration/TypoScript', 'T3v Illuminate');
}, $_EXTKEY);