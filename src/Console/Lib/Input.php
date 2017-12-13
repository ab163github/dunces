<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Console\Lib;


class Input
{
    public function __construct($argv = null)
    {
        // 命令输入信息
        if (null === $argv) {
            $argv = $_SERVER['argv'];
        }

        // 初始化
        $this->pwd = $this->getPwd();
        $this->fullScript = implode(' ', $argv);
        $this->script = array_shift($argv);

        // 解析参数和选项
        list($this->args, $this->sOpts, $this->lOpts) = CommandParser::parse($argv);
        $this->command = isset($this->args[0]) ? array_shift($this->args) : null;
    }
}