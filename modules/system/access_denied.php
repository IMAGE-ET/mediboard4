<?php
/**
 * $Id: access_denied.php 27297 2015-02-24 16:47:39Z mytto $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 27297 $
 */

$context = CValue::get("context");

echo <<<HTML
<div class="small-info">
Vous n'êtes pas autorisé à accéder <label title="$context">à cette information</label> !
</div>
HTML;


