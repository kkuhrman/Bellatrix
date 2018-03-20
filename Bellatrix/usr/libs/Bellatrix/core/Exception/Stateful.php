<?php
/**
 * @name:       Stateful.php
 * @author:     Karl Kuhrman
 * @abstract:   Default implementation of Btrx_Exception_StatefulInterface.
 *
 * Exceptions thrown by classes implmenting Btrx_StatefulInterface.
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

require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_INCLUDE, 'Exception', 'Stateful.php')));
require_once(BTRX_CORE . DIRECTORY_SEPARATOR . 'Exception.php');

class Btrx_Exception_Stateful 
    extends Btrx_ExceptionAbstract 
    implements Btrx_Exception_StatefulInterface
{
    //
    // Implement Btrx_Exception_Interface
    //
    public static function recover(Exception $Exception) {
        return parent::recover($Exception);
    }
}

