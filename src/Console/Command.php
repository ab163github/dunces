<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Console;

class Command
{
    private $io;
    public function __construct()
    {
        $this->io = new Io();
    }


    public function run()
    {
        //echo __METHOD__;
//        $in = trim(fgets(STDIN));
//        fwrite(STDOUT,$in);


    }
}