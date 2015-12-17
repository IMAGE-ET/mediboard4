<?php
/**
 * Global system version
 *
 * @package    Mediboard
 * @subpackage includes
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Id: version.php 28832 2015-07-03 07:19:14Z flaviencrochard $
 */

$version = array (
  // Manual numbering
  "major" => 0,
  "minor" => 5,
  "patch" => 0,

  // Automated numbering (should be incremented at each commit)
  "build" => 335,
);

$version["string"] = implode(".", $version);
$version["version"] = "{$version['major']}.{$version['minor']}.{$version['patch']}";
