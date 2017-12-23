<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Console\Lib;

interface ICommand
{
    public static function description();
    public static function info(ICmdIo $io);
    public static function help(ICmdIo $io);
    public static function version(ICmdIo $io);

    public function __construct();
    public function execute(ICmdIo $io);

}