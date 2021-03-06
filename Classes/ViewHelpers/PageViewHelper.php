<?php
namespace T3v\T3vIlluminate\ViewHelpers;

use \T3v\T3vCore\ViewHelpers\AbstractViewHelper;

/**
 * Page View Helper Class
 *
 * @package T3v\T3vIlluminate\ViewHelpers
 */
class PageViewHelper extends AbstractViewHelper {
  /**
   * @var \T3v\T3vIlluminate\Service\PageService
   * @inject
   */
  protected $pageService;

  /**
   * The View Helper render function.
   *
   * @param int $uid The UID of the page
   * @param boolean $languageOverlay If set, the language record (overlay) will be applied, defaults to `true`
   * @param int $sysLanguageUid The optional system language UID, defaults to the current system language UID
   * @return object The page object
   */
  public function render($uid, $languageOverlay = true, $sysLanguageUid = -1) {
    $uid             = intval($uid);
    $languageOverlay = (boolean) $languageOverlay;
    $sysLanguageUid  = intval($sysLanguageUid);

    return $this->pageService->getPageByUid($uid, $languageOverlay, $sysLanguageUid);
  }
}