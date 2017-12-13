<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Console\Cmd;

use Dunces\Console\Lib\ICommand;

class InfoTools implements ICommand
{

    public function desc()
    {
        $desc['desc'] = 'Show the dunces framework information';
        $desc['opts'] = array(
            '-v,--version'=>'Show dunces framework version',
            '-h,--help'=>'show'
        );

        return ;
    }

    public function execute($argvs = array(),$opts = array())
    {
        
    }
}