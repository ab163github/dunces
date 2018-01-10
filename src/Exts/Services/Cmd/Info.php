<?php
/**
 * Dunces Service
 * @author ab163github <ab__@163.com>
 * @version  0.0.1
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Services\Cmd;

use Dunces\Dunce;
use Dunces\Exts\Console\Lib\ConsoleException;
use Dunces\Exts\Console\Lib\ICmdIo;
use Dunces\Exts\Console\Lib\ICommand;
use Dunces\Exts\Console\Lib\IConsoleManagementService;

class Info implements ICommand
{
    private $_availableArg;

    public static function description()
    {
        return '控制台服务管理命令，包括启动、关闭和重载';
    }

    public function __construct(){
        $this->_availableArg = array('start','stop','reload');
    }

    public static function info(ICmdIo $io)
    {
        $io->outPutLine('Usage: service <arg> <-opt>');
        $io->outPutLine('Available args are:');
        $info =  array(
            array('arg'=>'start','desc'=>'启动服务'),
            array('arg'=>'stop','desc'=>'停止服务'),
            array('arg'=>'reload','desc'=>'重载服务')
        );
        $io->outPutCmdInfo($info);
        $io->outPutLine('Options: ');
        $info =  array(
            array('opt'=>'-n,--name','desc'=>'服务名称'),
            array('opt'=>'-h,--host','desc'=>'服务监听IP，默认为0.0.0.0'),
            array('opt'=>'--p,--port','desc'=>'服务监听端口，默认为9580'),
            array('opt'=>'--only_task','desc'=>'是否仅重启TASK'),
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
        $settingName = Dunce::SETTING_NAME;
        $services = Dunce::$settingName()->get('Services',array());
        $argv = $io->getArgv();
        if(empty($argv)) throw new ConsoleException('Command arg is required.');
        $opts = $io->getOpts();
        if(isset($opts['n'])){
            $service = $opts['n'];
        }elseif(isset($opts['name'])){
            $service = $opts['name'];
        }else{
            throw new ConsoleException('Option n or name not found.');
        }
        if(isset($services[$service])){
            $servicePath = $services[$service];
            $entity = new $servicePath($service);
            if($entity instanceof IConsoleManagementService){
                $arg = $argv[0];
                $entity->$arg($io);
            }else{
                throw new ConsoleException(sprintf('Console can not manage the service  "%s" ',$service));
            }
        }else{
            throw new ConsoleException(sprintf('Service "%s" not found',$service));
        }
    }
}