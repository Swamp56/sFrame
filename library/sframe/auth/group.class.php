<?php

/**
 * sFrame is free software: you can redistribute it
 * and/or modify it under the terms of the GNU Less General Public License
 * as  published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * sFrame is distributed in the hope that it will be
 * useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser
 * General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with sFrame Lightweight Framework.  If not, see
 * <http://www.gnu.org/licenses/>.
 *
 * @author C. Fitzpatrick
 * @package sframe_auth
 * @copyright 2009
 * @license http://www.gnu.org/copyleft/lesser.html  LGPL License 2.1
 * @version 1.0.0
 */

/**
 * This class is used to store permissions by group/usergroup
 * for further use within the sframe_auth_Registry class.
 *
 * @copyright 2010
 * @package sframe_auth
 * @version 1.0.0
 */
class sframe_auth_Group {
    private $_name;
    private $_perms = array();

    /**
     * The constructor takes a $name variable that
     * acts as a form of identification for when
     * there are multiple groups stored within an
     * array and stores it.
     *
     * @access public
     * @param string $name
     * @return void
     */
    public function __construct($name) {
        $this->_name = $name;
    }

    public function addPermission($perm) {
        array_push($this->_perms, $perm);
    }

    public function getName() {
        return $this->_name;
    }

    public function hasPermission($perm) {
        return (array_key_exists($perm));
    }
}

?>
