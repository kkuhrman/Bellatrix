<?php
/**
 * @name:       Command.php
 * @author:     Karl Kuhrman
 * @abstract:   Declare Btrx_CommandInterface.
 *
 * Encapsulates synchronous interaction between two objects within scope of 
 * single script execution.
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

require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_INCLUDE, 'AccessControl', 'Article', 'Static.php')));
require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_INCLUDE, 'AccessControl', 'Subject.php')));
require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_INCLUDE, 'Command', 'Result.php')));
require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_INCLUDE, 'Exception', 'Command.php')));

interface Btrx_CommandInterface extends Btrx_AccessControl_ArticleStaticInterface {
    /**
     * Command should be dispatched UP the chain of responsibility.
     */
    const BTRX_CMD_INVOKE_UP = 0x0000;
    
    /**
     * Command should be dispatched DOWN the chain of responsibility.
     */
    const BTRX_CMD_INVOKE_DOWN = 0x0001;
    
    /**
     * Command should be dispatched both UP and DOWN the chain of responsibility.
     */
    const BTRX_CMD_INVOKE_BOTH = 0x0010;
    
    /**
     * @return integer One of the command invocation constants above.
     */
    public static function getDirection();
    
    /**
     * @return mixed List of arguments.
     */
    public function getArguments();
    
    /**
     * Return reference to subject (user, role, etc) which invoked command.
     * @return Btrx_AccessControl_SubjectInterface
     */
     public function getInvoker();
    
     /**
      * Invoke the command and return response from target.
      * @param Btrx_AccessControl_SubjectInterface $Invoker
      * @param mixed $Arguments
      * @return Btrx_Command_ResultInterface
      * @throws Btrx_Exception_CommandInterface
      */
     public function invoke(Btrx_AccessControl_SubjectInterface $Invoker, $Arguments = NULL);
}