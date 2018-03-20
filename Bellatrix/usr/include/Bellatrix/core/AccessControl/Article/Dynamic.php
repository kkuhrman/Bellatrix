<?php
/**
 * @name:       Dynamic.php
 * @author:     Karl Kuhrman
 * @abstract:   Declare Btrx_AccessControl_ArticleDynamicInterface.
 *
 * Classes implementing this interface must have an id which is unique to the
 * scope of the access control article it encapsulates (e.g. session, stream), 
 * which is set at run time. Another way to think of objects implementing this 
 * resource is those which use late name binding. Examples are session, user, 
 * resource, etc.
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

require_once(implode(DIRECTORY_SEPARATOR, array(BTRX_INCLUDE, 'AccessControl', 'Article.php')));

interface Btrx_AccessControl_Article_DynamicInterface extends Btrx_AccessControl_ArticleInterface
{
    /**
     * System unique ID.
     *
     * @return string Subject unique identifier.
     */
    public function getId();
    
    /**
     * Common name, need not be unique.
     *
     * @return string Common name.
     */
    public function getName();
}

