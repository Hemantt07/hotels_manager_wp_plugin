<?php
/**
 * @package Calculator
 *
 */
namespace CG\Base;
/**
* 
*/
class Deactivate{

    public static function deactivate()
    {
        flush_rewrite_rules();
    }

}