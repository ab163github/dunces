<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Console\Lib;


final class CmdSet
{
    const DEF_CMD_COMMAND = 'info';
    const DEF_CMD_GROUP = 'default';
    const DEF_CMD_FNAME = 'info';
    private static $_commandSet = array();
    private static $_namespaceSet = array();

    private function getFullCmdFname($namespace,$fileName)
    {
        return $namespace.'\\'.$fileName;
    }

    private function getDefCmdFname($namespace)
    {
        return $this->getFullCmdFname($namespace,self::DEF_CMD_FNAME);
    }

    private function chkCommandExist($namespace)
    {
        $className = $this->getDefCmdFname($namespace);
        return class_exists($className);
    }

    private function chkInfoType($obj)
    {
        return $this->chkCmdType($obj) && ($obj instanceof CmdInfo);
    }

    private function chkCmdType($obj)
    {
        return $obj instanceof ICommand;
    }

    private function cmdLoader(array $nameSpace)
    {
        echo 'Loading command from namespace.'.PHP_EOL;
        foreach ($nameSpace as $v){
            if(in_array($v,self::$_namespaceSet)) continue;
            $infoClassName = $this->getDefCmdFname($v);
            if($this->chkCommandExist($v)){
                $info = new $infoClassName;
                if($this->chkInfoType($info)){
                    array_push(self::$_namespaceSet,$v);//添加命令行命名空间
                    self::$_commandSet;
                    $group = $info->getGroup();
                    $commands = array();
                    foreach ($info->getCommands() as $command=>$fileName) {
                        $commands[$command] = $this->getFullCmdFname($v,$fileName);
                    }
                    self::$_commandSet[$group]=$commands;
                    echo 'Command info "'.$infoClassName.'" has been loaded.'.PHP_EOL;
                }else{
                    echo 'Warning: Command info "'.$infoClassName.'" is not yet legal "cmdInfo" instance.'.PHP_EOL;
                }
            }else{
                echo 'Warning: Command info "'.$infoClassName.'" does not exist."'.PHP_EOL;
            }
        }
    }

    public function __construct(array $namespace)
    {
        $this->cmdLoader($namespace);
    }

    public function getCommandPath($commandStr)
    {
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
}