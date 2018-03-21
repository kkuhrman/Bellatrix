<?php
/**
 * @name:       Exception.php
 * @author:     Karl Kuhrman
 * @abstract:   Default implementation of Btrx_ExceptionInterface.
 *
 * Default PHP exception handling.
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

require_once(BTRX_INCLUDE . DIRECTORY_SEPARATOR . 'Exception.php');

class Btrx_Exception implements Btrx_ExceptionInterface
{
    //
    // Implement Btrx_ExceptionInterface
    //
    public static function recover(Exception $Exception) {
        //
        // Get exception data
        //
        $errorFile = str_replace("\\", "\\\\", $Exception->getFile());
        $errorLine = $Exception->getLine();
        $errorMessage = $Exception->getMessage();

        //
        // @todo: Log exception to database.
        //
        
        //
        // @todo: determine recovery status
        //
        
        //
        // If exception condition is unrecoverable notify command target
        //
        return FALSE;
    }
}

