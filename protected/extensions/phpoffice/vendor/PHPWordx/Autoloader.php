<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @link        https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2014 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

PHPWord_Autoloader::Register();

/**
 * Autoloader
 */
class PHPWord_Autoloader
{
    /** @const string */


    /**
     * Register
     *
     * @param bool $throw
     * @param bool $prepend
     * @return void
     */
    

     public static function Register() {
        if (function_exists('__autoload')) {
            //    Register any existing autoloader function with SPL, so we don't get any clashes
            spl_autoload_register('__autoload');
        }
        //    Register ourselves with SPL
        return spl_autoload_register(array('PHPWord_Autoloader', 'Load'));
    }   //    function Register()

    /**
     * Autoload
     *
     * @param string $class
     * @return void
     */
    public static function Load($strObjectName)
    {
        if((class_exists($strObjectName)) || (strpos($strObjectName, 'PHPWord') === false)) {
            return false;
        }

        $strObjectFilePath = 'vendor/PHPWord/' . str_replace('_', '/', $strObjectName) . '.php';
        header('Content-type: text/plain');
        print_r($strObjectFilePath);
        exit;
        
        if((file_exists($strObjectFilePath) === false) || (is_readable($strObjectFilePath) === false)) {
            return false;
        }
        
        require($strObjectFilePath);
    }
}
