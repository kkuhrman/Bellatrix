<?php
/**
 * @name:       config.php
 * @author:     Karl Kuhrman
 * @abstract:   Default project settings for Bellatrix web application.
 * 
 * DO NOT MODIFY THIS FILE.
 * Changes effecting entire project should be made to 
 * [project]\etc\Bellatrix\conf\config.php
 * Changes effecting local environment should be made to 
 * [project]\usr\etc\Bellatrix\conf\config.php
 *
 * This file will terminate further execution of scripts and output a simple
 * error message on any condition, which violates Bellatrix configuration 
 * rules.
 * 
 * @copyright:	Copyright (C) 2017 Kuhrman Technology Solutions LLC
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

global $BTRX_CONFIGURATION;
$BTRX_CONFIGURATION = array(
    'error' => array(),
    'warning' => array(),
    'status' => array(),
);

/**
 * Document root is the parent directory of this file (index.php).
 */
if (!defined('BTRX_DOCROOT')) {
    $BTRX_DOCROOT = __DIR__;
    define('BTRX_DOCROOT', $BTRX_DOCROOT);
}

/**
 * Root directory of the entire Bellatrix core project.
 */
if (!defined('BTRX_ROOT')) {
    $BTRX_ROOT = dirname(dirname(dirname(__DIR__)));
    define('BTRX_ROOT', $BTRX_ROOT);
}

/**
 * Master project configuration files directory.
 * Best practices require every Bellatrix project to include a set of master
 * project configuration files in this directory. Users should not modify these
 * files, rather copy them to ./usr/etc and make changes to the copies insetad.
 */
if (!defined('BTRX_ETC')) {
    $BTRX_ETC = BTRX_ROOT . DIRECTORY_SEPARATOR . 'etc';
    define('BTRX_ETC', $BTRX_ETC);
    $BTRX_MASTER_PROJECT_CONF_FILE_PATH = implode(
        DIRECTORY_SEPARATOR,
        array(
            BTRX_ETC,
            'Bellatrix',
            'conf',
            'project.xml'
        )
        );
    if (!file_exists($BTRX_MASTER_PROJECT_CONF_FILE_PATH)) {
        $msg = sprintf("File is not accessible: %s.", $BTRX_MASTER_PROJECT_CONF_FILE_PATH);
        $BTRX_CONFIGURATION['error']['Master project configuration file'] = $msg;
    }
    if (is_writable($BTRX_MASTER_PROJECT_CONF_FILE_PATH)) {
        $msg = sprintf("Bellatrix project configuration violation. Master project configuration file is writeable. Unset write privileges on file (%s).",
            $BTRX_MASTER_PROJECT_CONF_FILE_PATH
            );
        $BTRX_CONFIGURATION['warning']['Master project configuration file'] = $msg;
    }
}

/**
 * Secondary directory hierarchy may contain the following sub-directories:
 * ./etc - project configuration files modified for local environment
 * ./mod - Bellatrix modules
 * ./lib - class libraries, which are not packaged as Bellatrix modules
 * ./share - documentation, examples, SQL, utility scripts etc.
 * ./src - project source files
 */
if (!defined('BTRX_USR')) {
    global $BTRX_USR;
    !isset($BTRX_USR) ? $BTRX_USR = BTRX_ROOT  . DIRECTORY_SEPARATOR . 'usr' : NULL;
    define('BTRX_USR', $BTRX_USR);
    $BTRX_LOCAL_PROJECT_CONF_FILE_PATH_PARTS = array(
        BTRX_USR,
        'etc',
        'Bellatrix',
        'conf',
        'project.xml'
    );
    $BTRX_LOCAL_PROJECT_CONF_FILE_PATH = implode(DIRECTORY_SEPARATOR, $BTRX_LOCAL_PROJECT_CONF_FILE_PATH_PARTS);
    if (!file_exists($BTRX_LOCAL_PROJECT_CONF_FILE_PATH)) {
        //
        // Local project configuration file must either be manually copied to this location
        // or the parent directory must be writeable.
        //
        $msg = sprintf("File is not accessible: %s.", $BTRX_LOCAL_PROJECT_CONF_FILE_PATH);
        $BTRX_CONFIGURATION['warning']['Local project configuration file'] = $msg;
        
        //
        // At this point, since local project configuration file has not been located,
        // Bellatrix assumes project configuration has not been completed. This is the
        // time to check system requirements starting with PHP version.
        //
        $php_version = phpversion();
        $php_version_parts = explode('.', $php_version);
        if (isset($php_version_parts[0]) && isset($php_version_parts[1]) && 5 === intval($php_version_parts[0])) {
            switch (intval($php_version_parts[1])) {
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                    break;
                default:
                    $msg = sprintf("PHP version must be 5.2.x or higher. Local PHP version is %s.", $php_version);
                    $BTRX_CONFIGURATION['error']['PHP Version'] = $msg;
                    break;
            }
        }
        
        //
        // Since local project configuration file is not present, Bellatrix assumes
        // conventional set up with install tool. Make sure target folder for
        // local project configuration tool is writeable.
        //
        $pathHierarchyDepth = count($BTRX_LOCAL_PROJECT_CONF_FILE_PATH_PARTS);
        for ($upLevels = 0; $upLevels < $pathHierarchyDepth; $upLevels++) {
            array_pop($BTRX_LOCAL_PROJECT_CONF_FILE_PATH_PARTS);
            $checkPath = implode(DIRECTORY_SEPARATOR, $BTRX_LOCAL_PROJECT_CONF_FILE_PATH_PARTS);
            if ($checkPath == '') {
                $msg = sprintf("Parent directory must be writeable or file must be manually copied: %s.", $BTRX_LOCAL_PROJECT_CONF_FILE_PATH);
                $BTRX_CONFIGURATION['error']['Local project configuration file'] = $msg;
            }
            else {
                if (is_writable($checkPath)) {
                    break;
                }
            }
        }
    }
}

/**
 * Variable files directory hierarchy may contain the following sub-directories:
 * ./www/htdocs - web application document root (put Javascript, assets, etc. here).
 * ./log - Bellatrix default logs directory
 */
if (!defined('BTRX_VAR')) {
    global $BTRX_VAR;
    !isset($$BTRX_VAR) ? $BTRX_VAR = BTRX_ROOT . DIRECTORY_SEPARATOR . 'var' : NULL;
    define('BTRX_VAR', $BTRX_VAR);
    $BTRX_LOG_FILE_PATH_PARTS = array(
        BTRX_VAR,
        'log'
    );
    $BTRX_LOG_FILE_PATH = implode(DIRECTORY_SEPARATOR, $BTRX_LOG_FILE_PATH_PARTS);
    if (!file_exists($BTRX_LOG_FILE_PATH)) {
        //
        // Log file directory must be writeable.
        // @todo: turn off log file generation.
        //
        $msg = sprintf("File is not accessible: %s.", $BTRX_LOG_FILE_PATH);
        $BTRX_CONFIGURATION['warning']['Log files'] = $msg;
        $pathHierarchyDepth = count($BTRX_LOG_FILE_PATH_PARTS);
        for ($upLevels = 0; $upLevels < $pathHierarchyDepth; $upLevels++) {
            array_pop($BTRX_LOG_FILE_PATH_PARTS);
            $checkPath = implode(DIRECTORY_SEPARATOR, $BTRX_LOG_FILE_PATH_PARTS);
            if ($checkPath == '') {
                $msg = sprintf("Log file directory must be writeable: %s.", $BTRX_LOG_FILE_PATH);
                $BTRX_CONFIGURATION['error']['Log files'] = $msg;
            }
            else {
                if (is_writable($checkPath)) {
                    break;
                }
            }
        }
    }
}

/**
 * Project-specific path settings, including location of Bellatrix core
 * class library, should be defined in ./etc/Bellatrix/conf/config.php if they
 * are platform independent. Changes for local environment should be made in a
 * copy of this file at ./usr/etc/Bellatrix/conf/config.php. Bellatrix will
 * always go with the latter file, if it exists; otherwise, it will use the
 * master (former).
 */
$localPathConf = implode(DIRECTORY_SEPARATOR, array(BTRX_USR, 'etc', 'Bellatrix', 'conf', 'config.php'));
if (file_exists($localPathConf)) {
    include_once($localPathConf);
}
else {
    $masterPathConf = implode(DIRECTORY_SEPARATOR, array(BTRX_ETC, 'Bellatrix', 'conf', 'config.php'));
    if (file_exists($masterPathConf)) {
        include_once($masterPathConf);
    }
    else {
        /**
         * This is the root directory containing all the interface implementations and
         * extension class source files.
         */
        if (!defined('BTRX_SRC')) {
            global $BTRX_SRC;
            !isset($BTRX_SRC) ? $BTRX_SRC = BTRX_USR  . DIRECTORY_SEPARATOR . 'src' : NULL;
            define('BTRX_SRC', $BTRX_SRC);
        }
        
        /**
         * Location of Bellatrix core class library.
         * Override this definition if you intend to locate the core class library
         * anywhere other than BTRX_ROOT/core.
         *
         * Best practice is to clone Bellatrix (and other class libraries) in
         * ./project/usr/libs/
         */
        if (!defined('BTRX_CORE')) {
            global $BTRX_CORE;
            !isset($BTRX_CORE) ? $BTRX_CORE = implode(DIRECTORY_SEPARATOR, array(BTRX_USR, 'libs', 'Bellatrix', 'core')) : NULL;
            define('BTRX_CORE', $BTRX_CORE);
        }
    }
}

/**
 * This is the white list of IP addresses, which may access install, update and
 * other Bellatrix utilities.
 */
if (!defined('BTRX_ADMIN_IP')) {
    global $BTRX_ADMIN_IP;
    $BTRX_ADMIN_IP = array('127.0.0.1' => TRUE);
}

/**
 * If a valid path is given for this global, the boot log feature is enabled.
 * Otherwise, calls to Btrx_Mode_Server::logBootMessage() will be ignored.
 */
if (!defined('BTRX_BOOT_LOG')) {
    global $BTRX_BOOT_LOG;
    $BTRX_BOOT_LOG = FALSE;
    define('BTRX_BOOT_LOG', $BTRX_BOOT_LOG);
}

/**
 * Lastly, check location of Bellatrix core class library.
 */
if (!defined('BTRX_CORE')) {
    $msg = sprintf("Location of core class library is not defined.");
    $BTRX_CONFIGURATION['error']['Bellatrix core class library'] = $msg;
}
else {
    if (!file_exists(BTRX_CORE)) {
        $msg = sprintf("Core class library is not accessible: %s.", BTRX_CORE);
        $BTRX_CONFIGURATION['error']['Bellatrix core class library'] = $msg;
    }
}

/**
 * @todo: a more elegant default error response output.
 */
if (count($BTRX_CONFIGURATION['error'])) {
    foreach($BTRX_CONFIGURATION['error'] as $criteria => $condition) {
        echo "<h1>Bellatrix project configuration error</h1>";
        echo "<h2>$criteria</h2>";
        echo "<p>$condition</p>";
        exit(1);
    }
}