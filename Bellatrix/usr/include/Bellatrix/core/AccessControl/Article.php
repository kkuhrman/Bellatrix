<?php
/**
 * @name:       Article.php
 * @author:     Karl Kuhrman
 * @abstract:   Encapsulates access control system reference type data.
 *
 * Similar to 'the' (definite), 'a'/'an' (indefinite) in English grammar.
 * Used to  indicate the type of reference (general, specific, etc) being 
 * made by the Subject, Object, Constraint etc. in an access control system.
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

interface Btrx_AccessControl_ArticleInterface
{
    /**
     * Article has application (global) scope.
     */
    const BTRX_SCOPE_APPLICATION = 0x0000;
    
    /**
     * Article has session scope.
     */
    const BTRX_SCOPE_SESSION = 0x0001;
    
    /**
     * Article has stream (e.g. TCP socket) scope.
     */
    const BTRX_SCOPE_STREAM = 0x0010;
    
    /**
     * Article has datagram (e.g. IP packet) scope.
     */
    const BTRX_SCOPE_DATAGRAM = 0x0100;
    
    /**
     * @return integer One of scope constants defined above.
     */
    public static function getScope();
}