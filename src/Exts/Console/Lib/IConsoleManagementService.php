<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Console\Lib;

interface IConsoleManagementService
{
    public function __construct($serverName);
    public function start(ICmdIo $io);
    public function stop(ICmdIo $io);
    public function reload(ICmdIo $io);

}