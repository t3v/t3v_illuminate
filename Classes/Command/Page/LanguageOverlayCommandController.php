<?php
namespace T3v\T3vIlluminate\Command\Page;

use \TYPO3\CMS\Core\Database\QueryGenerator;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

use \T3v\T3vIlluminate\Domain\Model\Page\LanguageOverlay;
use \T3v\T3vIlluminate\Service\DatabaseService;

/**
 * Language Overlay Command Controller Class
 *
 * @package T3v\T3vIlluminate\Command\Page
 */
class LanguageOverlayCommandController extends CommandController {
  /**
   * The query generator
   *
   * @var \TYPO3\CMS\Core\Database\QueryGenerator
   * @inject
   */
  protected $queryGenerator;

  /**
   * The database service
   *
   * @var \T3v\T3vIlluminate\Service\DatabaseService
   * @inject
   */
  protected $databaseService;

  /**
   * The list command.
   *
   * @param int $sysLanguageUid The system language UID to search for
   * @param int $pid The optional PID of the page to search from, defaults to `1`
   * @param int $recursion The optional recursion, defaults to `99`
   * @param string $exclude The optional UIDs of pages to exclude as string, seperated by `,`, empty by default
   * @return void
   */
  public function listCommand($sysLanguageUid, $pid = 1, $recursion = 99, $exclude = '') {
    $this->beforeCommand();

    $sysLanguageUid = intval($sysLanguageUid);
    $pid            = intval($pid);
    $recursion      = intval($recursion);
    $exclude        = GeneralUtility::intExplode(',', $exclude, true);
    $pagesTreeList  = $this->queryGenerator->getTreeList($pid, $recursion, 0, 1);
    $pageUids       = GeneralUtility::intExplode(',', $pagesTreeList, true);
    $pageUids       = array_diff($pageUids, $exclude);

    foreach ($pageUids as $pageUid) {
      $languageOverlay = LanguageOverlay::where([['pid', '=', $pageUid], ['sys_language_uid', '=', $sysLanguageUid]])->first();

      if ($languageOverlay) {
        $uid    = $languageOverlay->uid;
        $title  = $languageOverlay->title;
        $hidden = $languageOverlay->hidden ? 'true' : 'false';

        $this->log("{$title} ({$uid}) [{$hidden}]");
      }
    }
  }

  /**
   * The hide command.
   *
   * @param int $sysLanguageUid The system language UID to hide
   * @param int $pid The optional PID of the page to search from, defaults to `1`
   * @param int $recursion The optional recursion, defaults to `99`
   * @param string $exclude The optional UIDs of pages to exclude as string, seperated by `,`, empty by default
   * @return void
   */
  public function hideCommand($sysLanguageUid, $pid = 1, $recursion = 99, $exclude = '') {
    $this->beforeCommand();

    $sysLanguageUid = intval($sysLanguageUid);
    $pid            = intval($pid);
    $recursion      = intval($recursion);
    $exclude        = GeneralUtility::intExplode(',', $exclude, true);
    $pagesTreeList  = $this->queryGenerator->getTreeList($pid, $recursion, 0, 1);
    $pageUids       = GeneralUtility::intExplode(',', $pagesTreeList, true);
    $pageUids       = array_diff($pageUids, $exclude);

    foreach ($pageUids as $pageUid) {
      $languageOverlay = LanguageOverlay::where([['pid', '=', $pageUid], ['sys_language_uid', '=', $sysLanguageUid]])->first();

      if ($languageOverlay) {
        $hidden = $languageOverlay->hidden;

        if (!$hidden) {
          $uid    = $languageOverlay->uid;
          $title  = $languageOverlay->title;

          $this->log("Hiding {$title} ({$uid})");

          $languageOverlay->hidden = true;
          $languageOverlay->save();
        }
      }
    }
  }

  /**
   * The unhide command.
   *
   * @param int $sysLanguageUid The system language UID to unhide
   * @param int $pid The optional PID of the page to search from, defaults to `1`
   * @param int $recursion The optional recursion, defaults to `99`
   * @param string $exclude The optional UIDs of pages to exclude as string, seperated by `,`, empty by default
   * @return void
   */
  public function unhideCommand($sysLanguageUid, $pid = 1, $recursion = 99, $exclude = '') {
    $this->beforeCommand();

    $sysLanguageUid = intval($sysLanguageUid);
    $pid            = intval($pid);
    $recursion      = intval($recursion);
    $exclude        = GeneralUtility::intExplode(',', $exclude, true);
    $pagesTreeList  = $this->queryGenerator->getTreeList($pid, $recursion, 0, 1);
    $pageUids       = GeneralUtility::intExplode(',', $pagesTreeList, true);
    $pageUids       = array_diff($pageUids, $exclude);

    foreach ($pageUids as $pageUid) {
      $languageOverlay = LanguageOverlay::where([['pid', '=', $pageUid], ['sys_language_uid', '=', $sysLanguageUid]])->first();

      if ($languageOverlay) {
        $hidden = $languageOverlay->hidden;

        if ($hidden) {
          $uid    = $languageOverlay->uid;
          $title  = $languageOverlay->title;

          $this->log("Unhiding {$title} ({$uid})");

          $languageOverlay->hidden = false;
          $languageOverlay->save();
        }
      }
    }
  }

  /**
   * Helper function which gets execute before a command.
   *
   * @return void
   */
  private function beforeCommand() {
    $this->databaseService->setup();
  }

  /**
   * Helper function for logging.
   *
   * @param string $message The message
   * @return void
   */
  private function log($message) {
    if ($message) {
      echo("{$message}\n");
    }
  }
}