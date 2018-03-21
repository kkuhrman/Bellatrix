<?php
/**
 * @name:       Target.php
 * @author:     Karl Kuhrman
 * @abstract:   Base class for Btrx_Command_TargetInterface implementations.
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
require_once(BTRX_CORE . DIRECTORY_SEPARATOR . 'Stateful.php');
require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_CORE, 'Exception', 'Command.php')));

abstract class Btrx_Command_TargetAbstract 
    extends Btrx_StatefulAbstract
    implements Btrx_Command_TargetInterface
{
    /**
     * @var Btrx_Command_TargetInterface
     */
    private $Superior;
    
    /**
     * 
     * @var Btrx_Command_TargetInterface
     */
    private $Subordinate;
    
    //
    // Implement Btrx_Command_TargetInterface
    // 
    
    /**
     * Subordinate calls this method on superrior in link assuming all goes well.
     * @param Btrx_Command_TargetInterface $Target
     * @throws Btrx_Exception_CommandInterface
     */
    public function setSubordinate(Btrx_Command_TargetInterface $Target) {
        $this->Superior = $Target;   
    }
    
    /**
     * {@inheritDoc}
     * @see Btrx_StatefulAbstract::initialize()
     */
    protected function initialize()
    {
        $this->Superior = NULL;
        $this->Subordinate = NULL;
    }

    /**
     * @return Btrx_Command_TargetInterface
     */
    protected function getSuperior()
    {
        return $this->Superior;
    }

    /**
     * @return Btrx_Command_TargetInterface
     */
    protected function getSubordinate()
    {
        return $this->Subordinate;
    }

    /**
     * @param Btrx_Command_TargetInterface $Superior
     */
    protected function setSuperior($Superior)
    {
        $this->Superior = $Superior;
    }
}

