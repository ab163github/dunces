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
use Dunces\Exts\Console\Lib\ConsoleException;
use Dunces\Exts\Console\Lib\Io;


final class Console implements IDunceExt
{
    private $cmdSet;
    private $io;

    private function optFunc($opts)
    {
        $optFunc = null;
        $optNames = array_keys($opts);
        foreach ($opts as $k=>$v){
            if($v){
                if(in_array($k,$optNames)){
                    switch ($k){
                        case 'i':
                        case 'info':
                            $optFunc = 'info';
                            break;
                        case 'v':
                        case 'version':
                            $optFunc = 'version';
                            break;
                        case 'h':
                        case 'help':
                            $optFunc = 'help';
                            break;
                    }
                }
            }
            if($optFunc) break;
        }
        return $optFunc;
    }

    public function __construct()
    {
        $this->io = new Io();
        $this->cmdSet = new CmdSet();
    }

    public function allCmd()
    {
        return $this->cmdSet->getLoadedCommands();
    }

    public function run()
    {
        try{
            $currentCmd = $this->cmdSet->getCommand($this->io);
            if($currentCmd){
                $optFunc = $this->optFunc($this->io->getOpts());
                if($optFunc){
                    $currentCmd::$optFunc($this->io);
                }else{
                    (new $currentCmd)->execute($this->io);
                }
            }
        }catch(ConsoleException $ce){
            if($ce->getCode() === 0){
                echo $ce->getMessage().PHP_EOL;
                exit(0);
            }
            throw $ce;
        }

    }

}