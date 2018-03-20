<?php
/**
 * @name:       Stateful.php
 * @author:     Karl Kuhrman
 * @abstract:   Base class for implementations of Btrx_StatefulInterface.
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

require_once(BTRX_INCLUDE . DIRECTORY_SEPARATOR . 'Stateful.php');
require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_CORE, 'Exception', 'Stateful.php')));

abstract class Btrx_StatefulAbstract implements Btrx_StatefulInterface
{
    /**
     * 
     * @var Btrx_AccessControl_SubjectInterface
     */
    private $CommandInvoker;
    
    /**
     * @return Btrx_AccessControl_SubjectInterface
     */
    public function getCommandInvoker()
    {
        return $this->CommandInvoker;
    }

    /**
     * @param Btrx_AccessControl_SubjectInterface $CommandInvoker
     */
    public function setCommandInvoker(Btrx_AccessControl_SubjectInterface $CommandInvoker)
    {
        $this->CommandInvoker = $CommandInvoker;
    }

    /**
     * Extends __construct().
     * Sub-classes initialize properties here.
     */
    abstract protected function initialize();
    
    final protected function __construct() {
        $args = func_get_args();
        if (isset($args[0]) && is_a($args[0], 'Btrx_AccessControl_SubjectInterface')) {
            $this->CommandInvoker = $args[0];
        }
        else {
            $this->CommandInvoker = NULL;
        }
        $this->initialize();
    }

    final public function __destruct() {
        $args = func_get_args();
        if (isset($args[0]) && is_a($args[0], 'Btrx_AccessControl_SubjectInterface')) {
            $this->sleep($args[0]);
        }
    }
}

