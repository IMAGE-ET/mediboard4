<?php /* $Id: config.php 21520 2013-12-26 13:03:10Z mytto $ */

/**
 * @package Mediboard
 * @subpackage sante400
 * @version $Revision: 21520 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 */

$dPconfig["dPsante400"] = array (
  "nb_rows"     => "5",
  "mark_row"    => "0",
  "cache_hours" => "1",
  "prefix"      => "odbc",
  "dsn"         => "",
  "other_dsn"   => "",
  "user"        => "",
  "pass"        => "",
  "group_id"    => "",
  
  "CSejour"     => array(
    "sibling_hours" => 1,
  ),
  
  "CIncrementer" => array(
    "cluster_count"    => 1,
    "cluster_position" => 0,
  ),
);
