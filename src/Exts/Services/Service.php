<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Services;


use Dunces\Dunce\Lib\IDunceExt;

class Service implements IDunceExt
{
    public function __construct(){

    }

    public function hh()
    {
        echo __METHOD__;
    }

}