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
 * The Dispatcher class is in charge of dynamically
 * instantiating a controller class and then calling
 * the associated method.  This class is setup to allow
 * flexibility in that the programmer is required to
 * set the controller and action themselves.
 * 
 * @copyright 2010
 * @package sframe\mvc
 * @version 1.0.0
 */
class sframe_mvc_Dispatcher {
    /**
     * Holds the name of the controller in the current
     * request.  It has a default of "IndexController".
     * 
     * @var String
     */
    private $_controller = 'IndexController';

    /**
     * Holds the name of the action being called in the
     * controller of the current request.  It has a default
     * of "indexAction".
     * 
     * @var String
     */
    private $_action = 'indexAction';

    /**
     * Holds the location in which the controller files
     * are stored.  Defaults to "../application/controllers",
     * following the standard of the default directory
     * structure.
     * 
     * @var String
     */
    private $_dir = '../application/controllers';

    /**
     * Sets the controller file/name that is used for
     * dispatching the URL.  The class name should
     * be the same as the name of the class.  For example,
     * a file named IndexController.class.php should have
     * a class named IndexController. The default controller
     * is "IndexController".
     *
     * Please note that you do not have to
     * add the name "Controller" into this function.
     *
     * @access public
     * @param string $controller
     * @return void
     */
    public function setController($controller) {
        try {
            if (!empty($controller)) {
                $this->_controller = ucwords($controller) . "Controller";
            } else {
                throw new Exception('Empty controller name provided');
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    /**
     * Sets the method to be called in the dispatcher
     * class.  The name of an action always has the word
     * "Action" with an uppercase first letter at the end.
     * For example, if you wanted to make an action named
     * "view", then the method should be named "viewAction".
     * The default action is "indexAction".
     *
     * Please note that you do not have to add the name
     * "Action" in this function.
     * 
     * @access public
     * @param string $action
     * @return void
     */
    public function setAction($action) {
        try {
            // Make sure the user didn't pass in an empty name
            if (!empty($action)) {
                $this->_action = strtolower($action) . "Action";
            } else {
                throw new Exception('Empty action name provided');
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    /**
     * Sets the directory where the controller class is
     * located.  If the directory is bogus, an exception is
     * thrown.  A default location is set based upon the
     * default application directory structure.
     *
     * @access public
     * @param string $loc
     * @return void
     */
    public function setControllerDir($loc) {
        try {
            // Wouldn't want to pass a bogus directory
            // location
            if (is_dir($loc)) {
                $this->_dir = $loc;
            } else {
                throw new Exception('Invalid controller directory specified');
            }
        } catch (Exception $e) {
           print $e->getMessage();
        }
    }
    
    /**
     * This dispatches the controller and actions specified
     * in the $_controller and $_action variables.  If there
     * is an issue with the directory location, file existence,
     * or ability to call the controller and action, errors
     * are thrown to warn the user.
     *
     * @access public
     * @return void
     */
    public function dispatch() {
        try {
            // We'll double check to make sure the directory exists
            if (is_dir($this->_dir)) {
                $fileName = $this->_dir . '/' . $this->_controller . '.class.php';
                // Make sure the file exists
                if (file_exists($fileName)) {
                    if (!class_exists($this->_controller)) {
                        require_once($this->_dir . '/' . $this->_controller . '.class.php');
                    }
                    
                    // Make sure we can dispatch the controller and action
                    if (is_callable(array($this->_controller, $this->_action))) {
                        // Setup instantiation
                        $cont = new $this->_controller;
                        $act = $this->_action;

                        // Dispatch!
                        $cont->$act();
                    } else {
                        throw new Exception('Unable to dispatch the requested action and controller');
                    }
                } else {
                    throw new Exception('Controller file not found in controller directory');
                }
            } else {
                throw new Exception('Invalid controller directory stored');
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
}


?>
