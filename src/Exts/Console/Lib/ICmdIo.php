<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Console\Lib;


interface ICmdIo
{
    public function getOriginalCommandLine();
    public function getScriptName();
    public function getCommand();
    public function getOpts();
    public function getArgv();
    public function outPutLine($msg,$newLine=true);
    public function outPutCmdInfo(array $info);


}