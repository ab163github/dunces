<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.1
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces;

use Dunces\Console\Command;

require_once dirname(__DIR__).'/src/Console/Command.php';


class Dunce
{
    public function __construct()
    {
        (new Command)->run();

    }
}

new Dunce();