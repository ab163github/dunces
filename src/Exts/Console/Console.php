<?php
/**
 * Dunce console extensions
 * @author ab163github <ab__@163.com>
 * @version  0.0.1
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Console;


use Dunces\Dunce\Lib\IDunceExt;
use Dunces\Exts\Console\Lib\CmdSet;
use Dunces\Exts\Console\Lib\Io;


final class Console implements IDunceExt
{
    private $cmdSet;
    private $io;

    public $version ='0.0.1';

    public function __construct()
    {
        $this->io = new Io();
        $this->cmdSet = new CmdSet();
    }

    public function run()
    {
        $currentCmd = $this->cmdSet->getCommand($this->io);
        if($currentCmd){
            return $currentCmd->execute($this->io);
        }
    }

    public function allCmd()
    {
        return $this->cmdSet->getLoadedCommands();
    }

}