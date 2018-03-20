<?php
/**
 * @name:       Stateful.php
 * @author:     Karl Kuhrman
 * @abstract:   Declare Btrx_StatefulInterface.
 *
 * By design REST architecture is stateless so it is up to the implementer to 
 * somehow maintain state across requests (presumably trhough some form of 
 * serialization). Classes implementing Btrx_StatefulInterface save object state
 * through a call to sleep() and restore object state trhough a call to wakeup().
 * This design does not attempt to replace PHP Serializable interface, which also
 * may be implemented by classes; rather it seeks to combine this concept with the
 * access control features of the Bellatrix core class library.  
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

require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_INCLUDE, 'AccessControl', 'Subject.php')));
require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_INCLUDE, 'Exception', 'Stateful.php')));

interface Btrx_StatefulInterface
{
    /**
     * Save object state.
     * @param Btrx_AccessControl_SubjectInterface $Subject
     * @throws Btrx_Exception_StatefulInterface
     */
    public function sleep(Btrx_AccessControl_SubjectInterface $Subject = NULL);
    
    /**
     * Create a new instance of object or restore cached object to previous state.
     * 
     * Best practice wakeup() will return the object fully initialized and ready 
     * to work. Should anything prevent this, wakeup() should throw an exception 
     * so as to prevent method calls on non objects or objects that are not 
     * properly initialized. Thus, wakeup() should always be called within a 
     * try/catch block and chaining is encouraged. For example:
     * @example
     * try {
     *   MyObject::wakeup()->myMethod();
     * }
     * catch(Btrx_Exception_Stateful $Exception) {
     *   //@todo: log the exception
     * }
     * @example
     * @param Btrx_AccessControl_SubjectInterface $Subject
     * @throws Btrx_Exception_StatefulInterface
     */
    public static function wakeup(Btrx_AccessControl_SubjectInterface $Subject = NULL);
}