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
    private $defaultCmdNamespace = 'Dunces\Exts\Console\Cmd';
    private $cmdSet;
    private $io;

    public $version ='0.0.1';

    public function __construct()
    {
        $this->io = new Io();
        if(isset($settings['CLI'])){
            //TODO 加载命令行启动脚本指定的配置文件
            //$setting = $settings['CLI'];
        }else{
            $setting['namespaces'] = array($this->defaultCmdNamespace,'safsf\asdfa\ss');
        }
        $this->cmdSet = new CmdSet($setting['namespaces']);
        return $this;
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
            echo 'Can not find command: "'.$currentCmd.'" in command list.'.PHP_EOL;
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