<?php
/**
 * $Id: preferences.php 26572 2014-12-24 11:27:14Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 26572 $
 */

// Préférences par Module
CPreferences::$modules["common"] = array (
  "LOCALE",
  "UISTYLE",
  "MenuPosition",
  "DEFMODULE",
  "touchscreen",
  "accessibility_dyslexic",
  "tooltipAppearenceTimeout",
  "showLastUpdate",
  "useEditAutocompleteUsers",
  "directory_to_watch",
  "debug_yoplet",
  "autocompleteDelay",
  "showCounterTip",
  "textareaToolbarPosition",
  "sessionLifetime",
  "planning_resize",
  "planning_dragndrop",
  "planning_hour_division",
  "notes_anonymous",
  "navigationHistoryLength",

  //mobile
  "MobileUI",
  "MobileDefaultModuleView",
  "useMobileSwipe",
  "MobileDefaultTheme"
);
  
CPreferences::$modules["system"] = array (
  "INFOSYSTEM",
  "showTemplateSpans",
  "moduleFavicon",
);