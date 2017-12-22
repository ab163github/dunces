<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Console\Lib;


final class CmdSet
{
    const DEF_CMD_COMMAND = 'info';
    const DEF_CMD_PREFIX = 'default';
    const CMD_G_INTERFACE = 'Dunces\Exts\Console\Lib\ICommand';

    private $_commandSet = array();
    private $_namespaceSet = array();

    private function _getCommand($c)
    {
        if(strpos($c,'/') === false){
            $command = self::DEF_CMD_PREFIX.'/'.$c;
        }elseif(strpos($c,'/') === 0){
            $command = self::DEF_CMD_PREFIX.$c;
        }else{
            $command = $c;
        }
        return $command;
    }

    private function _chkCmdType($cmdFullPath)
    {
        $implements = class_implements($cmdFullPath);
        if(is_array($implements)){
            if(in_array(self::CMD_G_INTERFACE,$implements)){
                return true;
            }
        }
        return false;
    }

    private function _cmdLoader(array $commands)
    {
        foreach ($commands as $k=> $v){
            $command = $this->_getCommand($k);
            if(in_array($command,$this->_commandSet)) continue;
            if($this->_chkCmdType($v)){
                $this->_commandSet[]=$command;
                $this->_namespaceSet[$command]=$v;
            }
        }
    }

    public function __construct()
    {
        $this->_cmdLoader(array('info'=>'Dunces\Exts\Console\Cmd\Info'));
    }

    public function getCommand(ICmdIo $io)
    {
        if($io->getCommand()) $currentCmd = $io->getCommand(); else $currentCmd = self::DEF_CMD_COMMAND;
        $currentCmd = $this->_getCommand($currentCmd);
        if(in_array($currentCmd,$this->_commandSet)){
            return new $this->_namespaceSet[$currentCmd];
        }else{
            $io->outPutLine('Can not find command: "'.$currentCmd.'.');
        }

    }

    public function getLoadedCommands()
    {
        return $this->_commandSet;
    }

    public function loadCmdLines($commands)
    {
        //if(is_array($namespaces)) $this->cmdLoader($namespaces);
        echo 'sss';
    }
}