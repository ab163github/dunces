<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Console;

use Dunces\Console\Lib\CmdSet;

final class Command
{
    private $defaultCommand = 'info';
    private $defaultCmdGroup = 'default';
    private $defaultCmdNamespace = 'Dunces\Console\Cmd';
    private $cmdSet;
    private $io;

    private function loadCmdList($nameSpace){

    }

    public function __construct()
    {
        $this->io = new Io();
        $this->cmdSet = CmdSet::getSet();
    }


    public function run($settings=array())
    {
        $this->cmdSet->cmdLoader(array($this->defaultCmdNamespace)); //TODO 加载命令行

        //echo __METHOD__;
//        $in = trim(fgets(STDIN));
//        fwrite(STDOUT,$in);
//        if($settings['cmd']['namespaces']){
//
//        }


//        $currentCommand = $this->io->getCommand()?$this->io->getCommand():$this->defaultCommand;
//        echo $currentCommand;
//        //echo $this->io->getScriptName();
////        var_export($this->io->getArgv());
////        var_export($this->io->getOpts());
    }
}