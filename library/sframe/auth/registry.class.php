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
 * @package sframe_mvc
 * @copyright 2009
 * @license http://www.gnu.org/copyleft/lesser.html  LGPL License 2.1
 * @version 1.0.0
 */

/**
 * This class stores instances of authentication groups
 * and then checks to see if a specified permission exists
 * within a certain group.  It uses a Singleton Pattern so
 * that univeral access is allowed throughout the application.
 *
 * @copyright 2010
 * @package sframe_auth
 * @version 1.0.0
 */
class sframe_auth_Registry {
    /**
     * Stores an intance of the class for the
     * implementation of the singleton pattern
     *
     * @var sframe_auth_Registry
     */
    private static $_instance;

    /**
     * Stores all of the groups that are added to
     * the class
     *
     * @var sframe_auth_Group
     */
    private $_groups = array();

    /**
     * The constructor method is made private to
     * disallow direct instantiation.  This is
     * due to an implementation of the Singleton
     * Pattern, which allows univeral usage of a
     * single instance.
     *
     * @access private
     * @return void
     */
    private function __construct() { }

    /**
     * This method sets the singleton variable ($_instance)
     * so that we can access other non-static members of
     * the class.
     *
     * @access public
     * @return sframe_auth_Registry
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new sframe_auth_Registry;
        }

        return self::$_instance;
    }

    /**
     * This adds groups from the sframe_auth_Group class
     * by storing them in an array indexed by the name
     * of the group being added.
     *
     * @access public
     * @param sframe_auth_Group $group
     * @return void
     */
    public function addGroup(sframe_auth_Group &$group) {
        try {
            // Check to make sure no group names are duplicate so we don't overwrite
            // any array keys
            if (!array_key_exists($group->getName())) {
                $this->_groups[$group->getName()] = $group;
            } else {
                throw new Exception("The group being added has a duplicate name");
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    /**
     * Checks to see if the given permission exists
     * by using the hasPermission method of the provided
     * group class.  Returns bool on whether it exists
     * or not.
     *
     * @access public
     * @param string $perm
     * @param string $group
     * @return bool
     */
    public function hasAuth($perm, $group) {
        try {
            // Make sure the group exists so we don't call a non-existent method
            if (array_key_exists($group)) {
                return ($this->_groups[$group]->hasPermission($perm));
            } else {
                throw new Exception("Invalid group name provided");
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
}
?>
