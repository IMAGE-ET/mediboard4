{{*
 * $Id: inc_revealed.tpl 19050 2013-05-07 12:41:01Z kgrisel $
 *
 * @category Password Keeper
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @link     http://www.mediboard.org*}}

{{if $revealed}}
    <script>
      prompt("Votre mot de passe :", {{$revealed|json|smarty:nodefaults}});
    </script>
{{/if}}