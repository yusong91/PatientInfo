<?php
/**
 * @package dompdf
 * @link    http://dompdf.github.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @author  Fabien Ménager <fabien.menager@gmail.com>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

// HMLT5 Parser
require_once __DIR__ . '/lib/html5lib/Parser.php';


// Sabberworm
spl_autoload_register(function($class)
{
    if (strpos($class, 'Sabberworm') !== false) {
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $file = realpath(__DIR__ . '/lib/php-css-parser/lib/' . (empty($file) ? '' : DIRECTORY_SEPARATOR) . $file . '.php');
        if (file_exists($file)) {
            require_once $file;
            return true;
        }
    }
    return false;
});

// php-font-lib
require_once __DIR__ . '/lib/php-font-lib/src/FontLib/Autoloader.php';

//php-svg-lib
require_once __DIR__ . '/php-svg-lib/src/autoload.php';

require_once __DIR__ . '/vendor/autoload.php';



$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => [190, 236],
    'orientation' => 'L' //L
]);


/*
 * New PHP 5.3.0 namespaced autoloader
 */
require_once __DIR__ . '/lib/php-font-lib/src/FontLib/Autoloader.php';
//require_once 'dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';

require_once __DIR__ . '/vendor/autoload.php';
//require_once __DIR__ . 'vendor/autoload.php'; original but error wend delete /
//Dompdf\Autoloader::register();
