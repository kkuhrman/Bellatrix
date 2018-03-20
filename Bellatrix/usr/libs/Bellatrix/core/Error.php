<?php
/**
 * @name:       Error.php
 * @author:     Karl Kuhrman
 * @abstract:   Default implemenation of Btrx_ErrorInterface.
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

require_once(BTRX_INCLUDE . DIRECTORY_SEPARATOR . 'Error.php');

class Btrx_Error implements Btrx_ErrorInterface
{
    //
    // Implement Btrx_ErrorInterface
    //
    public function recover($errno, $errstr, $errfile = NULL, $errline = NULL, $errcontext = NULL) {
        //
        // This boolean flag indicates whether error condition is recoverable
        //
        $recovered = (($errno == E_ERROR) || ($errno == E_USER_ERROR));
        
        //
        // Unpack error data
        //
        
        //
        // Log error information
        //
        
        //
        // Notify if error condition is recoverable
        //
        return $recovered;
    }
}

