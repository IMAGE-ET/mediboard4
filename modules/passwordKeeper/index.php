<?php
/**
 * $Id: index.php 18846 2013-04-18 09:12:33Z kgrisel $
 *
 * @category Password Keeper
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @link     http://www.mediboard.org */

$module = CModule::getInstalled(basename(dirname(__FILE__)));

$module->registerTab('vw_idx_keepers', TAB_EDIT);