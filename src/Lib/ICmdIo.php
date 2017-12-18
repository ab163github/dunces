<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Lib;


interface ICmdIo
{
    public function getOriginalCommandLine();
    public function getScriptName();
    public function getCommand();
    public function getOpts();
    public function getArgv();
    public function outPutLine($msg,$newLine=true);
}