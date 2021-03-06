<?php /* $Id: do_plageressource_aed.php 8216 2010-03-05 10:16:33Z rhum1 $ */

/**
* @package Mediboard
* @subpackage dPcabinet
* @version $Revision: 8216 $
* @author Romain Ollivier
*/

// Object binding
$obj = new CPlageressource();
$obj->bind($_POST);

$del = CValue::post( 'del', 0 );
$repeat = CValue::post( '_repeat', 1 );
$double = CValue::post( '_double', 0 );

$body_msg = null;
$header = array();
$msgNo = null;

if ($del) {
  $obj->load();

  $deleted = 0;
  $not_deleted = 0;
  $not_found = 0;

  while ($repeat-- > 0) {
    $msg = NULL;
    if ($obj->plageressource_id) {
      if (!$msg = $obj->canDeleteEx()) {	
        if ($msg = $obj->delete()) {
          $not_deleted++;
        } 
        else {
          $msg = "plage supprim�e";
          $deleted++;
        }
      }
      else {
        $not_deleted++;
      } 
    }
    else {
      $not_found++;
      $msg = "Impossible de supprimer, plage non trouv�e";
    }
    
    $body_msg .= "<br />Plage du $obj->date: $msg";
    
    $obj->becomeNext();
  }
  
  if ($deleted    ) $header [] = "$deleted plage(s) supprim�e(s)";
  if ($not_deleted) $header [] = "$not_deleted plage(s) non supprim�e(s)";
  if ($not_found  ) $header [] = "$not_found plage(s) non trouv�e(s)";
  
  $msgNo = $deleted ? UI_MSG_ALERT : UI_MSG_ERROR;

  CValue::setSession("plage_id");
} else {
  $created = 0;
  $updated = 0;
  $not_created = 0;
  $not_updated = 0;

  while ($repeat--  > 0) {
    $msg = null;
    if ($obj->plageressource_id) {
      if ($msg = $obj->store()) {
        $not_updated++;
      } 
      else {
        $msg = "plage mise � jour";
        $updated++;
      }
    }
    else {
      if ($msg = $obj->store()) {
        $not_created++;
      } 
      else {
        $msg = "plage cr��e";
        $created++;
      }
    }
    
    $body_msg .= "<br />Plage du $obj->date: " . $msg;
  
    $obj->becomeNext();
    
    if ($double) {
      $repeat--;
      $obj->becomeNext();
	  }
  }

  if ($created) $header [] = "$created plage(s) cr��e(s)";
  if ($updated) $header [] = "$updated plage(s) mise(s) � jour";
  if ($not_created) $header [] = "$not_created plage(s) non cr��e(s)";
  if ($not_updated) $header [] = "$not_created plage(s) non mise(s) � jour";
  
  $msgNo = ($not_created + $not_updated) ?
    (($not_created + $not_updated) ? UI_MSG_ALERT : UI_MSG_ERROR) :
    UI_MSG_OK;
}

$complete_msg = implode(" - ", $header);
if ($body_msg) {
// Uncomment for more verbose
  $complete_msg .= $body_msg; 
}
CAppUI::setMsg($complete_msg, $msgNo);
CAppUI::redirect("m=$m");
?>