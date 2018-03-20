<?php
/**
 * @name:       Command.php
 * @author:     Karl Kuhrman
 * @abstract:   Declare Btrx_Command_ResultInterface.
 *
 * Encapsulates success/failure status of command execution and return result.
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

interface Btrx_Command_ResultInterface
{
    /**
     * Invocation of command resulted in no error condition.
     */
    const BTRX_CMD_INVOKE_SUCCESS = 0x0000;
    
    /**
     * Invocation of command resulted in error condition.
     */
    const BTRX_CMD_INVOKE_ERROR = 0x0001;
    
    /**
     * @return integer One of the invocation result codes above.
     */
    public function getResult();
    
    /**
     * @return mixed Return result data.
     */
    public function getValue();
}

