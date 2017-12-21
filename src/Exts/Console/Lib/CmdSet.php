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
    private $_commandSet = array();
    private $_namespaceSet = array();

    private function getCommand($c)
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

    private function chkCmdType($obj)
    {
        return $obj instanceof ICommand;
    }

    private function cmdLoader(array $commands)
    {
        foreach ($commands as $k=> $v){
            $command = $this->getCommand($k);
            if(in_array($command,$this->_commandSet)) continue;
            if(class_exists($v)){
//                var_dump(class_implements($v));
//                die;
                if($this->chkCmdType(new $v)) $this->_namespaceSet[$command]=$v;
            }
        }
    }

    public function __construct()
    {
        $this->cmdLoader(array('info'=>'Dunces\Exts\Console\Cmd\Info'));

    }

    public function getCommandPath($commandStr)
    {
        return '';
        $command = explode('/',strtolower(trim($commandStr)));
        if(empty($command[0])){
            $group = self::DEF_CMD_GROUP;
            $cmd = self::DEF_CMD_COMMAND;
        }else{
            if(count($command) == 2){
                $group = $command[0];
                $cmd = $command[1];
            }else{
                $group = self::DEF_CMD_GROUP;
                $cmd = $command[0];
            }
        }
        if(isset(self::$_commandSet[$group]))
            if(isset(self::$_commandSet[$group][$cmd]))
                return self::$_commandSet[$group][$cmd];
        return null;
    }

    public function loadCmdLines($commands)
    {
        //if(is_array($namespaces)) $this->cmdLoader($namespaces);
        echo 'sss';
    }
}