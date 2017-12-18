<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Lib;


use Dunces\Dunce;

interface ICommand
{
    public function execute(Dunce $dunce,ICmdIo $io);
}