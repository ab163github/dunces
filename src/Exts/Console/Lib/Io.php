<?php
/**
 * Dunces console io
 * @author ab163github <ab__@163.com>
 * @version  0.0.1
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Console\Lib;



class Io implements ICmdIo
{
    private $pwd;
    private $fullArgv;
    private $scriptName;
    private $command;
    private $argv;
    private $opts;

    private function columnMaxWidth(array $column)
    {
        $maxWidth = 0;
        foreach ($column as $v){
            if($maxWidth < strlen($v)){
                $maxWidth = strlen($v);
            }
        }
        return $maxWidth;
    }

    public function __construct()
    {
        $argv = $_SERVER['argv'];
        $this->pwd = getcwd();
        $this->fullArgv = implode(' ', $argv);
        $argvs = array();
        $opts = array();
        foreach (CommandLine::parseArgs($argv) as $k=>$v){
            if(is_int($k)){
                $argvs[$k] = $v;
            }else{
                if($k==='fileName')
                    $this->scriptName = $v;
                else
                    $opts[$k] = $v;
            }
        }
        $this->command = array_shift($argvs);
        $this->argv = $argvs;
        $this->opts = $opts;
    }

    public function getOriginalCommandLine()
    {
        return 'php '.$this->fullArgv;
    }

    public function getScriptName()
    {
        return $this->scriptName;
    }

    public function getCommand()
    {
        return $this->command;
    }

    public function getOpts()
    {
        return $this->opts;
    }

    public function getArgv()
    {
        return $this->argv;
    }

    public function outPutLine($msg,$newLine=true)
    {
        echo $msg;
        if($newLine) echo PHP_EOL;
    }

    public function outPutCmdInfo(array $info)
    {
        $keys = array_keys($info[0]);
        $columns = array();
        foreach ($keys as $v){
            $columns[$v] = array_column($info,$v);
        }
        $columnsWidth = array();
        foreach ($columns as $k=>$v) {
            $columnsWidth[$k] = $this->columnMaxWidth($v);
        }
        foreach ($info as $item) {
            $outPut = '';
            foreach ($item as $k=>$v){
                $outPut.= str_pad($v,$columnsWidth[$k]+1,' ');
            }
            $this->outPutLine('  '.$outPut);
        }
        $this->outPutLine(' ');
    }
}