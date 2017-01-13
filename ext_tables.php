<?php
defined('TYPO3_MODE') or die('Access denied.');

$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');

// === Database Service ===

$databaseService = $objectManager->get('T3v\T3vIlluminate\Service\DatabaseService');
$databaseService->setup();

// === TypoScript ===

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'T3v Illuminate');