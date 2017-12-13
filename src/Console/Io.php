<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Console;


use Dunces\Console\Lib\ICmdIo;

class Io implements ICmdIo
{
    private $pwd;
    private $fullArgv;
    private $argv;

    public function __construct($argv = null)
    {
        if (null === $argv) {
            $argv = $_SERVER['argv'];
        }
        $this->pwd = getcwd();
        $this->fullArgv = implode(' ', $argv);
        $this->argv = array_shift($argv);

        // 解析参数和选项
        list($this->args, $this->sOpts, $this->lOpts) = CommandParser::parse($argv);
        $this->command = isset($this->args[0]) ? array_shift($this->args) : null;
        var_dump($this->args);
        var_dump($this->sOpts);
        var_dump($this->lOpts);
    }
}