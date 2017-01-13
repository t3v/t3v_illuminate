<?php
namespace T3v\T3vIlluminate\Service;

use \Illuminate\Database\Capsule\Manager as Capsule;

use \T3v\T3vCore\Service\AbstractService;

/**
 * Database Service Class
 *
 * @package T3v\T3vIlluminate\Service
 */
class DatabaseService extends AbstractService {
  /**
   * Setup the database / Eloquent ORM.
   */
  public static function setup() {
    // First, create a new `Capsule` manager instance. Capsule aims to make configuring the library for usage outside of
    // the Laravel framework as easy as possible.
    $capsule = new Capsule();

    // Add connection to Capsule.
    $capsule->addConnection(self::getDefaultConnection());

    // Make this Capsule instance available globally via static methods.
    $capsule->setAsGlobal();

    // Setup the Eloquent ORM.
    $capsule->bootEloquent();
  }

  /**
   * Returns the default connection.
   *
   * @param string $charset The optional charset, defaults to `utf8`
   * @param string $collation The optional collation, defaults to `utf8_general_ci`
   * @param string $prefix The optional prefix, empty by default
   * @return array The default connection.
   */
  protected static function getDefaultConnection($charset = 'utf8', $collation = 'utf8_general_ci', $prefix = '') {
    $connection = [
      'driver'    => 'mysql',
      'host'      => $GLOBALS['TYPO3_CONF_VARS']['DB']['password'],
      'username'  => $GLOBALS['TYPO3_CONF_VARS']['DB']['username'],
      'password'  => $GLOBALS['TYPO3_CONF_VARS']['DB']['password'],
      'database'  => $GLOBALS['TYPO3_CONF_VARS']['DB']['database'],
      'charset'   => $charset,
      'collation' => $collation,
      'prefix'    => $prefix
    ];

    return $connection;
  }
}