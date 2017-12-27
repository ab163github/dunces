<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Services\Lib;


interface IConsoleManagementService
{
    public function __construct($serverName);
    public function start();
    public function stop();
    public function reload();
    public function restart();
}