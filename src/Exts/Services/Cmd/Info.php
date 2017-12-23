<?php
/**
 * Dunces Service
 * @author ab163github <ab__@163.com>
 * @version  0.0.1
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Services\Cmd;

use Dunces\Exts\Console\Lib\ICmdIo;
use Dunces\Exts\Console\Lib\ICommand;

class Info implements ICommand
{

    public static function description()
    {
        return '显示服务的命令行信息';
    }

    public function __construct(){}


    public static function info(ICmdIo $io)
    {
        // TODO: Implement info() method.
        $io->outPutLine( 'hahah' );
    }

    public static function help(ICmdIo $io)
    {
        // TODO: Implement help() method.
    }

    public static function version(ICmdIo $io)
    {
        // TODO: Implement version() method.
    }

    public function execute(ICmdIo $io)
    {
        // TODO: Implement execute() method.
        $io->outPutLine(__METHOD__);
    }
}