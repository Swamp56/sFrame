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
 * This is a blank parent controller class that
 * enabled the user to store common variables or
 * functions that can be used across multiple (or
 * all) controllers in a web application.
 * 
 * @copyright 2010
 * @package sframe\mvc
 * @version 1.0.0
 */
class sframe_mvc_Controller {
    public function __construct() {
        $this->var = "val";
    }
}

?>
