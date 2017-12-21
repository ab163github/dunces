<?php
/**
 * Dunces Service
 * @author ab163github <ab__@163.com>
 * @version  0.0.1
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Services\Cmd;

use Dunces\Dunce;
use Dunces\Lib\ICmdIo;
use Dunces\Lib\AbsCmdInfo;
use Dunces\Lib\ICommand;

class Info extends AbsCmdInfo implements ICommand
{
    public $version = '0.0.1';

    protected function setList()
    {
        return array('service'=>'Info');
    }

    public function execute(Dunce $dunce, ICmdIo $io)
    {
        // TODO: Implement execute() method.
    }
}