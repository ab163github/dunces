<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Console;


use Dunces\Console\Lib\CommandLine;
use Dunces\Console\Lib\ICmdIo;

class Io implements ICmdIo
{
    private $pwd;
    private $fullArgv;
    private $scriptName;
    private $command;
    private $argv;
    private $opts;

    public function __construct($argv = null)
    {
        if (null === $argv) {
            $argv = $_SERVER['argv'];
        }
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

    public function getOriginalCmmandLine()
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
}