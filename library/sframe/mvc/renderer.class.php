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
 * This class is used in the controller to call the view
 * portion of the MVC paradigm.  It also allows the user
 * to set variables and use them in the view files.
 *
 * @copyright 2010
 * @package sframe\mvc
 * @version 1.0.0
 */
class sframe_mvc_Render {
    private $_registry;
    private $_location;
    private $_templates;

    public function add($file) {
        $loc = $this->_location . '/' . $file;

        try {
            if (file_exists($loc)) {
                array_push($this->_templates, $file);
            } else {
                throw new Exception("The location of the view provided does not exist");
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function assign($var, $val) {
        try {
            if (!isset($this->_registry[$var])) {
                $this->_registry[$var] = $val;
            } else {
                throw new Exception("Variable $var is already set");
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function render() {
        
    }

    public function setViewLocation($loc) {
        try {
            if (is_dir($loc)) {
                $this->_location = $loc;
            } else {
                throw new Exception("Directory provided does not exist");
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
}
?>
