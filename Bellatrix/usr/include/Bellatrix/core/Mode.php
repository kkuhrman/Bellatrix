<?php
/**
 * @name:       Mode.php
 * @author:     Karl Kuhrman
 * @abstract:   Declare Btrx_ModeInterface   
 * 
 * Mode is a link in the command processing chain of responsibility, similar to 
 * OS protection rings, in terms of access control. A Mode either processes a 
 * command or passes it on to the next, appropriate level of responsibility in 
 * the the chain/hierarchy.
 * 
 * The 'root' mode in Bellatrix (akin to OS kernel) is Btrx_Application, which 
 * establishes a CoR according to the following hierarchy:
 * Btrx_Mode_Server - encapsulates server and execution environment variables
 * Btrx_Mode_Session - encapsulates session variables
 * Btrx_Mode_User - establishes user identity and access control privileges
 * Btrx_Mode_Router - processes request and retrieves response
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

require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_INCLUDE, 'Command', 'Target.php')));

interface Btrx_ModeInterface extends Btrx_Command_TargetInterface
{
}

