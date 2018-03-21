<?php
/**
 * @name:       Application.php
 * @author:     Karl Kuhrman
 * @abstract:   Main point of entry into Bellatrix web application.
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

require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_CORE, 'Command', 'Target.php')));
require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_CORE, 'Exception', 'Command.php')));
require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_CORE, 'Message', 'Response.php')));

class Btrx_Application 
    extends Btrx_Command_TargetAbstract
{
    /**
     * 
     * @var string Access control UUID.
     */
    const UUID = '130cfa8e-2c8f-11e8-9560-e0699576cabe';
    
    /**
     * 
     * @var string Common name.
     */
    const NAME = 'Btrx_Application';
    
    /**
     * 
     * @var Btrx_Application Instance of concrete singleton.
     */
    private static $App;
    
    /**
     * 
     * @var Btrx_Message_ResponseInterface
     */
    private $Response;
    
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
        //
        // Flush output buffer.
        //
        ob_end_flush();
    }
    
    public static function wakeup(Btrx_AccessControl_SubjectInterface $Subject = NULL) {
        if (!isset(self::$App))
        {
            //
            // Create singleton
            //
            self::$App = new Btrx_Application();
                        
            // @todo:
            // try {
            //   Btrx_Mode_Server::wakeup(NULL)->link(self::$App);
            //   if successful subordinate mode will call parent::setSubordinate(self)
            // }
            // catch (Btrx_Exception) {...}
            
            //
            // ...
            //
            
            //
            // @todo: JUNK This should be last step for web app. Router mode should return response.
            //
            self::$App->Response = new Btrx_Message_Response();
            
        }
        return self::$App;
    }

    //
    // Implement Btrx_Command_TargetInterface
    //
    public function link(Btrx_Command_TargetInterface $Target) {
        $msg = sprintf("%s must be root in chain of responsibility. Cannot link to %s",
            __CLASS__, self::getDataTypeName($Target));
        throw new Btrx_Exception_Command($msg);
    }

    public function execute(Btrx_CommandInterface $Command) {
        
    }
    
    //
    // @todo: extract interface from these
    //
    /**
     * @return Btrx_Message_ResponseInterface
     */
    public function getResponse() {
        return self::$App->Response;
    }
    
    //
    // Helper functions
    //

    //
    // Given a variable, return name of primitive type or class name if object..
    //
    public static function getDataTypeName($variable = NULL) {
        
        $typeName = 'null';
        
        if (isset($variable)) {
            $typeName = @gettype($variable);
            if ($typeName === 'object') {
                $typeName = @get_class($variable);
            }
        }
        return $typeName;
    }
    
    //
    // Inherited functions
    //
    
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
        // Turn on output buffering.
        //
        ob_start();
    }
}

