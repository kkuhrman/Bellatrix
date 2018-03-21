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

require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_INCLUDE, 'Mode', 'Server.php')));
require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_CORE, 'Command', 'Target.php')));
require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_CORE, 'Error', 'Mode.php')));

class Btrx_Mode_Server 
extends Btrx_Command_TargetAbstract
    implements Btrx_Mode_ServerInterface
{
    /**
     *
     * @var string Access control UUID.
     */
    const UUID = '99e03c27-2d24-11e8-9560-e0699576cabe';
    
    /**
     *
     * @var string Common name.
     */
    const NAME = 'Btrx_Mode_Server';
    
    /**
     * 
     * @var Btrx_Mode_Server concrete instance of singleton.
     */
    private static $Server;
    
    //
    // Implement Btrx_AccessControl_ArticleInterface
    //
    public static function getScope() {
        return Btrx_AccessControl_ArticleInterface::BTRX_SCOPE_APPLICATION;
    }
    
    //
    // Implement Btrx_AccessControl_ArticleStaticInterface
    //
    public static function getId() {
        return self::UUID;
    }
    
    public static function getName() {
        return self::NAME;
    }
    
    //
    // Implement Btrx_StatefulInterface
    //
    public function sleep(Btrx_AccessControl_SubjectInterface $Subject = NULL) {
        
    }

    public static function wakeup(Btrx_AccessControl_SubjectInterface $Subject = NULL) {
        if (!isset(self::$Server))
        {
            self::$Server = new Btrx_Mode_Server();
        }
        return self::$Server;
    }

    //
    // Implement Btrx_Command_TargetInterface
    //
    public function link(Btrx_Command_TargetInterface $Target) {
        if (isset($Target) && is_a($Target, 'Btrx_Application'))
        {
            $this->setSuperior($Target);
            $Target->setSubordinate($this);
            return $this;
        }
        $msg = sprintf("%s is not permitted to link to %s",
            self::getDataTypeName($Target), __CLASS__);
        throw new Btrx_Exception_Command($msg);
    }

    public function execute(Btrx_CommandInterface $Command) {
        
    }

    //
    // Implement Btrx_Mode_ServerInterface
    //
    public static function getEnvironmentVariable($name, Btrx_AccessControl_AgentInterface $Agent = NULL) {
        
    }
    
    public static function setEnvironmentVariable($name, $value, Btrx_AccessControl_AgentInterface $Agent = NULL) {
        
    }
    
    /**
     * {@inheritDoc}
     * @see Btrx_StatefulAbstract::initialize()
     */
    protected function initialize()
    {
        //
        // Btrx_Command_TargetAbstract::initialize()
        //
        parent::initialize();
        
        //
        // Initialize error and exception handling
        //
        set_error_handler(array('Btrx_Error', 'recover'));
        set_exception_handler(array('Btrx_Exception', 'recover'));
    }
}

