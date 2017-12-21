<?php
/**
 * Dunce console extensions
 * @author ab163github <ab__@163.com>
 * @version  0.0.1
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Console;


use Dunces\Dunce;
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
        $currentCmd = $this->io->getCommand();
        $commandFname = $this->cmdSet->getCommandPath($currentCmd);
        if($commandFname){
            $cmd = new $commandFname;
            try{
                $cmd->execute($this->io);
            }catch (\Exception $e){
                if($e->getCode() !=0){
                    $msg = $e->getMessage().PHP_EOL.$e->getTraceAsString();
                }else{
                    $msg = $e->getMessage();
                }
                exit($msg);
            }
        }else{
            echo 'Can not find command: "'.$currentCmd.'".'.PHP_EOL;
        }


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