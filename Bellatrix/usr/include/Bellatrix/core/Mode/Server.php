<?php
/**
 * @name:       Mode.php
 * @author:     Karl Kuhrman
 * @abstract:   Declare Btrx_Mode_ServerInterface
 *
 * Encapsulates server and execution environment variables.
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

require_once(BTRX_INCLUDE . DIRECTORY_SEPARATOR . 'Mode.php');
require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_INCLUDE, 'AccessControl', 'Agent.php')));

interface Btrx_Mode_ServerInterface extends Btrx_ModeInterface
{
    /**
     * Returns assigned value of given environment variable.
     *
     * @param string $name Name of requested environment variable.
     * @param Btrx_AccessControl_AgentInterface $Agent Agent seeking access.
     *
     * @return mixed Assigned value of given variable or NULL.
     * @throw AblePolecat_Mode_Exception If environment is not initialized.
     */
    public static function getEnvironmentVariable($name, Btrx_AccessControl_AgentInterface $Agent = NULL);
    
    /**
     * Assign value of given environment variable.
     *
     * @param string $name Name of requested environment variable.
     * @param mixed $value Value of variable.
     * @param Btrx_AccessControl_AgentInterface $Agent Agent seeking access.
     *
     * @return bool TRUE if variable is set, otherwise FALSE.
     * @throw AblePolecat_Mode_Exception If environment is not initialized.
     */
    public static function setEnvironmentVariable($name, $value, Btrx_AccessControl_AgentInterface $Agent = NULL);
}

