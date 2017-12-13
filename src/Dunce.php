<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.1
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces;

use Dunces\Console\Command;

class Dunce
{
    public function __construct($runtime=null)
    {
        if($runtime === 'CLI')
            (new Command)->run();
        else
            echo $runtime;

    }
}