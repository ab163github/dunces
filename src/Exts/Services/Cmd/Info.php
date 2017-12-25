<?php
/**
 * Dunces Service
 * @author ab163github <ab__@163.com>
 * @version  0.0.1
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Services\Cmd;

use Dunces\Dunce;
use Dunces\Exts\Console\Lib\ICmdIo;
use Dunces\Exts\Console\Lib\ICommand;

class Info implements ICommand
{

    public static function description()
    {
        return 'Dunces 服务管理';
    }

    public function __construct(){}


    public static function info(ICmdIo $io)
    {
        $io->outPutLine('Usage: service <commands> [-opt]');
        $io->outPutLine('Available commands are: start|stop|restart|status');
        $io->outPutLine('Options: -n,--name');
    }

    public static function help(ICmdIo $io)
    {
        self::info($io);
    }

    public static function version(ICmdIo $io)
    {
        $io->outPutLine(Dunce::Version());
    }

    public function execute(ICmdIo $io)
    {
        var_dump($io->getArgv());
        // TODO: Implement execute() method.
        $io->outPutLine(__METHOD__);
    }
}