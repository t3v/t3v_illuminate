<?php
namespace T3v\T3vIlluminate\Service;

use \T3v\T3vCore\Service\AbstractService;
use \T3v\T3vCore\Service\LanguageService;

use \T3v\T3vIlluminate\Domain\Model\Page;
use \T3v\T3vIlluminate\Domain\Model\Page\LanguageOverlay;

/**
 * Page Service Class
 *
 * @package T3v\T3vIlluminate\Service
 */
class PageService extends AbstractService {
  /**
   * The language service
   *
   * @var \T3v\T3vCore\Service\LanguageService
   */
  protected $languageService;

  /**
   * The constructor function.
   */
  public function __construct() {
    parent::__construct();

    $this->languageService = $this->objectManager->get('T3v\T3vCore\Service\LanguageService');
  }

  /**
   * Get the current page.
   *
   * @param boolean $languageOverlay If set, the language record (overlay) will be applied, defaults to `true`
   * @param int $sysLanguageUid The optional system language UID, defaults to the current system language UID
   * @return array The row for the current page or empty if no page was found
   */
  public function getCurrentPage($languageOverlay = true, $sysLanguageUid = -1) {
    $uid             = intval($GLOBALS['TSFE']->id);
    $languageOverlay = (boolean) $languageOverlay;
    $sysLanguageUid  = intval($sysLanguageUid);
    $page            = $this->getPage($uid, $languageOverlay, $sysLanguageUid);

    return $page;
  }

  /**
   * Get a page by UID.
   *
   * @param int $uid The UID of the page
   * @param boolean $languageOverlay If set, the language record (overlay) will be applied, defaults to `true`
   * @param int $sysLanguageUid The optional system language UID, defaults to the current system language UID
   * @return array The row for the page or empty if no page was found
   */
  public function getPage($uid, $languageOverlay = true, $sysLanguageUid = -1) {
    $uid             = intval($uid);
    $languageOverlay = (boolean) $languageOverlay;
    $sysLanguageUid  = intval($sysLanguageUid);
    $page            = Page::find($uid);

    if ($page) {
      $page = $page->getAttributes();

      if ($languageOverlay) {
        if ($sysLanguageUid < 0) {
          $sysLanguageUid = $this->languageService->getSysLanguageUid();
        }

        $overlay = LanguageOverlay::where([['pid', '=', $uid], ['sys_language_uid', '=', $sysLanguageUid]])->first();

        if ($overlay) {
          $overlay = $overlay->getAttributes();

          $page = array_merge($page, $overlay);
        }
      }
    }

    return $page;
  }

  /**
   * Alias for `getPage`.
   *
   * @param int $uid The UID of the page
   * @param boolean $languageOverlay If set, the language record (overlay) will be applied, defaults to `true`
   * @param int $sysLanguageUid The optional system language UID, defaults to the current system language UID
   * @return array The row for the page or empty if no page was found
   */
  public function getPageByUid($uid, $languageOverlay = true, $sysLanguageUid = -1) {
    $uid             = intval($uid);
    $languageOverlay = (boolean) $languageOverlay;
    $sysLanguageUid  = intval($sysLanguageUid);

    return $this->getPage($uid, $languageOverlay);
  }
}