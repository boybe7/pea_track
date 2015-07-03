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


/**
 * Autoloader
 */
class PHPWord_Autoloader
{
    const NAMESPACE_PREFIX = '';
    public static function Register() {

        return spl_autoload_register(array('PHPWord_Autoloader', 'Load'));
    }

    public static function Load($strObjectName) {
        $prefixLength = strlen(self::NAMESPACE_PREFIX);

         
          
        if (0 === strncmp(self::NAMESPACE_PREFIX, $strObjectName, $prefixLength)) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, substr($strObjectName, $prefixLength));
             $file = str_replace('PHPWord\\',"", $file);
            // if($strObjectName=="PHPWord\Collection\Bookmarks")
            // {
            //     $file = str_replace('\\', DIRECTORY_SEPARATOR, substr($strObjectName, $prefixLength));
            //       $file = str_replace('PHPWord\\',"", $file);
            //        header('Content-type: text/plain');
            //           echo $file;
            //           echo(__DIR__ . (empty($file) ? '' : DIRECTORY_SEPARATOR) . $file . '.php');                    
            //     exit;
            // }
            $file = realpath(__DIR__ . (empty($file) ? '' : DIRECTORY_SEPARATOR) . $file . '.php');
           
           
            if (file_exists($file)) {
                /** @noinspection PhpIncludeInspection Dynamic includes */
                require_once $file;
            }
        }

       
           
       
    }
}
