<?php
namespace T3v\T3vIlluminate\Domain\Model;

use \Illuminate\Database\Eloquent\Model;

/**
 * Abstract Entity Class
 *
 * @package T3v\T3vIlluminate\Domain\Model
 */
abstract class AbstractEntity extends Model {
  const CREATED_AT = 'crdate';
  const UPDATED_AT = 'tstamp';

  /**
   * Overwrites the default table identifier.
   *
   * @var string
   */
  protected $primaryKey = 'uid';
}