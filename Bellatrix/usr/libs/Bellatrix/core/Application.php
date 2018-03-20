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
        die("Bellatrix is in the initial stage of development.");
    }

    //
    // Implement Btrx_Command_TargetInterface
    //
    public function link(Btrx_Command_TargetInterface $Target) {
        
    }

    public function execute(Btrx_CommandInterface $Command) {
        
    }
}

