<?php

/**
 * $Id: CUserAuthenticationSuccess.class.php 23150 2014-05-14 07:20:38Z phenxdesign $
 *  
 * @category Classes
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 23150 $
 * @link     http://www.mediboard.org
 */
 
/**
 * User authentication success exception
 */
class CUserAuthenticationSuccess extends CMbException {
  /** @var int User ID to authenticate */
  public $user_id;

  /** @var string Authentication method */
  public $auth_method;

  /** @var bool Restrict to only one script */
  public $restricted = true;
}
