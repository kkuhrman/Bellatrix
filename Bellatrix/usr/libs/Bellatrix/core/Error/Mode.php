<?php
/**
 * @name:       Mode.php
 * @author:     Karl Kuhrman
 * @abstract:   Default implementation of Btrx_Error_ModeInterface.
 *
 * Default PHP error handling.
 *
 * @copyright:	Copyright (C) 2018 Kuhrman Technology Solutions LLC
 * @license:	GPLv3+: GNU GPL version 3
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_INCLUDE, 'Error', 'Mode.php')));
require_once(BTRX_CORE . DIRECTORY_SEPARATOR . 'Error.php');

class Btrx_Error_Mode
    extends Btrx_Error
    implements Btrx_Error_ModeInterface
{
    //
    // Implement Btrx_ErrorInterface
    //
    public static function recover($errno, $errstr, $errfile = NULL, $errline = NULL, $errcontext = NULL) {
        //
        // Get error information
        //
        $msg = sprintf("Error in Bellatrix. %d %s", $errno, $errstr);
        $type = 'STATUS';
        switch($errno) {
            default:
                break;
            case E_USER_ERROR:
            case E_ERROR:
                $type = 'ERROR';
                break;
            case E_USER_WARNING:
                $type = 'WARNING';
                break;
        }
        $errorFile = str_replace("\\", "\\\\", $errfile);
        $errorLine = $errline;
        $errorMessage = $msg;
        
        /**
         * @todo: log error to database if connected.
         */
        
        /**
         * @todo: A more legant way to display error information.
         */
        print('<p>' .
            $msg .
            '<ul><li>' .
            $errfile .
            '</li><li>' .
            $errline .
            '</li></ul></p>'
            );
        
        return parent::recover($errno, $errstr, $errfile, $errline);
    }
}

