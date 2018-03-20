<?php
/**
 * @name:       Command.php
 * @author:     Karl Kuhrman
 * @abstract:   Declare Btrx_Command_TargetInterface.
 *
 * Receives synchronous commands within scope of single script execution.
 * 
 * Implements the Chain of Responsibility (COR) design pattern by linking with 
 * other command target objects.
 *
 * Similar to land/mobile telecommunications links, those in this implementation
 * use forward and reverse link to describe the relationship between superior to 
 * subordinate, and subordinate to superior respectively.
 *
 * The intended work flow of this method is subordinate calls on superior, passing
 * self as parameter. If approved to be next in COR, superior returns reference to
 * itself, which subordinate must save as reverse link. Otherwise, if link is not
 * permitted, an exception is thrown and the whole thing fails.
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

require_once(BTRX_INCLUDE . DIRECTORY_SEPARATOR . 'Command.php');
require_once(BTRX_INCLUDE . DIRECTORY_SEPARATOR . 'Stateful.php');

interface Btrx_Command_TargetInterface 
    extends Btrx_AccessControl_ArticleStaticInterface, Btrx_StatefulInterface
{
    /**
     * Link in the direction superior -> subordinate.
     */
    const BTRX_CMD_LINK_FORWARD = 0x0000;
    
    /**
     * Link in the direction subordinate -> superior.
     */
    const BTRX_CMD_LINK_REVERSE = 0x0001;
    
    /**
     * Execute a command or pass back/forward chain of responsibility. 
     * @param Btrx_CommandInterface $Command
     * @return Btrx_Command_ResultInterface
     * @throws Btrx_Exception_CommandInterface
     */
    public function execute(Btrx_CommandInterface $Command);
    
    /**
     * Allows potential subordinate targets to link to a superior.
     * @param Btrx_Command_TargetInterface $Target
     * @throws Btrx_Exception_CommandInterface
     */
    public function link(Btrx_Command_TargetInterface $Target);
}

