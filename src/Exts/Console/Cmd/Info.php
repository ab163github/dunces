<?php
/**
 * Console default info
 * @author ab163github <ab__@163.com>
 * @version  0.0.1
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Console\Cmd;


use Dunces\Dunce;
use Dunces\Exts\Console\Lib\CmdDesc;
use Dunces\Exts\Console\Lib\ICmdIo;
use Dunces\Exts\Console\Lib\ICommand;

class Info implements ICommand
{
    public function __construct(){}

    private function logo()
    {
        $logo = '
===******************************************************************===       
        _/_/_/    _/    _/  _/      _/    _/_/_/  _/_/_/_/    _/_/_/        
       _/    _/  _/    _/  _/_/    _/  _/        _/        _/               
      _/    _/  _/    _/  _/  _/  _/  _/        _/_/_/      _/_/            
     _/    _/  _/    _/  _/    _/_/  _/        _/              _/           
    _/_/_/      _/_/    _/      _/    _/_/_/  _/_/_/_/  _/_/_/              
===******************************************************************===';
        return $logo;
    }

    private function usage(){
        return '<command> [args] [options]';
    }

    private function showInfo(ICmdIo $io){
        $io->outPutLine($this->logo());
        $io->outPutLine(Dunce::Version());
        $io->outPutLine(' ');
        $io->outPutLine('Usage: '.$this->usage());
        $io->outPutLine(' ');
        $io->outPutLine('Options:');
        self::info($io);
        $io->outPutLine('Available commands are:');
        $allCommands = Dunce::Console()->allCmd();
        $cmdMaxWidth = 0;
        $noGroupCmd = array();
        $groupedCmd = array();
        foreach (array_keys($allCommands) as $command){
            if(strpos($command, 'default/') === 0){
                $command = substr($command,strlen('default/'));
                $noGroupCmd[] = $command;
            }else{
                $groupedCmd[] = $command;
            }
            if(strlen($command) > $cmdMaxWidth) $cmdMaxWidth = strlen($command);
        }
        sort($noGroupCmd);
        foreach ($noGroupCmd as $cmd){
            $cmdDis = str_pad($cmd,$cmdMaxWidth+1,' ');
             $cmdPath = $allCommands['default/'.$cmd];
             $io->outPutLine('  '.$cmdDis.$cmdPath::description());
        }
        sort($groupedCmd);
        foreach ($groupedCmd as $cmd){
            $cmdDis = str_pad($cmd,$cmdMaxWidth+1,' ');
            $cmdPath = $allCommands[$cmd];
            $io->outPutLine('  '.$cmdDis.$cmdPath::description());
        }
        $io->outPutLine(PHP_EOL);
    }

    public static function description()
    {
        return '显示命令行信息';
    }

    public static function info(ICmdIo $io)
    {
        $info =  array(
            array('opt'=>'-i, --info','desc'=>''),
            array('opt'=>'-v, --version','desc'=>'显示版本信息'),
            array('opt'=>'-h, --help','desc'=>'显示命令行帮助信息'),
        );
        $io->outPutCmdInfo($info);

    }

    public static function help(ICmdIo $io)
    {
        self::info($io);
    }

    public static function version(ICmdIo $io)
    {
        $io->outPutLine(Dunce::Version());
    }

    public function execute(ICmdIo $io)
    {
        $this->showInfo($io);
    }


}