<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Services\Service;


use Dunces\Dunce;
use Dunces\Exts\Console\Lib\ICmdIo;
use Dunces\Exts\Console\Lib\IConsoleManagementService;

class SwBasedService implements IConsoleManagementService
{
    private $pidPath;
    private $serverName;

    private function getPidFileName(){
        if(!is_dir($this->pidPath)) {
            $mkdir = function($path,$f){
                if(is_dir($path)) return true;
                if(is_dir(dirname($path))){//父目录已经存在，直接创建
                    return mkdir($path);
                }
                $f(dirname($path),$f);//从子目录往上创建
                return mkdir($path,0777);//因为有父目录，所以可以创建路径
            };
            $mkdir($this->pidPath,$mkdir);
        }
        return $this->pidPath.'/'.$this->serverName.'.pid';
    }

    private function writePid($pid){
        return file_put_contents($this->getPidFileName(),$pid);
    }

    private function loadPid(){
        if(file_exists($this->getPidFileName()))
            $pid = file_get_contents($this->getPidFileName());
        else
            $pid = 0;
        return $pid;
    }

    public function __construct($serverName)
    {
        $this->serverName = $serverName;
        $settingName = Dunce::SETTING_NAME;
        $this->pidPath = Dunce::$settingName()->get('Services.pid_path','/etc/Dunces/Service');
    }

    public function start(ICmdIo $io)
    {
        if($this->loadPid() == 0){
            $http = new \swoole_http_server("0.0.0.0", 80);
            $http->set(array('daemonize'=>1));
            $sobj = $this;
            $http->on('start',function($server) use ($sobj,$io){
                $pid = $server->master_pid;
                swoole_set_process_name("web_server_".$pid);
                if($sobj->writePid($pid)){
                    $io->outPutLine("Web service was successfully started, and PID is ".$this->loadPid());
                }else{
                    $server->shutdown();
                };
            });
            $http->on('shutdown', function ($server) use ($sobj) {
                $sobj->writePid(0);
            });
            $http->on('managerStart',function ($server){
                $pid = $server->master_pid;
                swoole_set_process_name("web_server_manager".$pid);
            });
            $http->on('workerStart',function ($server,$worker_id){
                $pid = $server->master_pid;
                swoole_set_process_name("web_server_".$pid."_worker_".$worker_id);
            });
            $http->on('request', function ($request, $response) {
                $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
            });
            $http->start();
        }else{
            $io->outPutLine("Web service has been started, and PID is ".$this->loadPid());
            exit(0);
        };
    }

    public function stop(ICmdIo $io)
    {
        $timeout = 60;
        $startTime = time();
        $pid = $this->loadPid();
        if($pid != 0){
            $pid && posix_kill($pid, SIGTERM);
            $result = true;
            while (1) {
                $masterIslive = $pid && posix_kill($pid, SIGTERM);
                if ($masterIslive) {
                    if (time() - $startTime >= $timeout) {
                        $result = false;
                        break;
                    }
                    usleep(10000);
                    continue;
                }
                break;
            }
            if($result){
                $this->writePid(0);
                $io->outPutLine("Web service was successfully closed.");
                exit(0);
            }else{
                $io->outPutLine("Web service shutdown failed, please shut down manually.");
                exit(0);
            }
        }else{
            $io->outPutLine("Web service has been shut down.");
            exit(0);
        }

    }

    public function reload(ICmdIo $io)
    {
        $pid = $this->loadPid();
        if($pid != 0){
            $opts = $io->getOpts();
            if(isset($opts['only_task'])) $onlyTask = true; else $onlyTask = false;
            $signal = $onlyTask ? SIGUSR2 : SIGUSR1;
            if(posix_kill($pid, $signal)){
                $io->outPutLine("Web service was successfully reloaded, and PID is ".$this->loadPid());
                exit(0);
            }else{
                $io->outPutLine("Web service reload failed, please restart manually and restart.");
                exit(0);
            }
        }else{
            $io->outPutLine("Web service been shut down.");
            exit(0);
        }
    }

}