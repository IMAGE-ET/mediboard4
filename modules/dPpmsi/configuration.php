<?php
/**
 * $Id: configuration.php 24896 2014-09-19 07:58:03Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPpmsi
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    OXOL, see http://www.mediboard.org/public/OXOL
 * @version    $Revision: 24896 $
 */

CConfiguration::register(
  array(
    "CGroups" => array(
      "dPpmsi" => array(
        "display" => array(
          "see_recept_dossier" => "bool default|0",
        )
      )
    )
  )
);