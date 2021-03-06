<?php
/**
 * @name:       Agent.php
 * @author:     Karl Kuhrman
 * @abstract:   Declare Btrx_AccessControl_AgentInterface.
 *
 * The access control 'subject'; for example, a user. Intended to follow 
 * interface specified by W3C but does not provide public access to properties
 * (get/set methods provided).
 *
 * @see http://www.w3.org/TR/url/#url
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

interface Btrx_AccessControl_AgentInterface extends Btrx_AccessControl_SubjectInterface
{
}

