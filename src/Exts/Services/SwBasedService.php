<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Services;


use Dunces\Exts\Console\Lib\ConsoleException;
use Dunces\Exts\Services\Lib\IConsoleManagementService;

class SwBasedService implements IConsoleManagementService
{
    private $pidPath;
    private $serverName;

    private function writePid(){

    }

    private function loadPid(){

    }

    public function __construct($serverName)
    {
        $this->serverName = $serverName;
        $settingName = Dunce::SETTING_NAME;
        $this->pidPath = Dunce::$settingName()->get('Services.pid_path','\etc\Dunces\service');
    }

    public function start()
    {

        if(empty($pidPath)) $pidPath = '\etc\Dunces\service';
        $pidFile = $
        $http = new \swoole_http_server("0.0.0.0", 80);
        $http->set(array('daemonize'=>1));
        $http->on('start',function($server){
            $pid = $server->master_pid;
            swoole_set_process_name("web_server_".$pid);
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
    }

    public function stop()
    {
        // TODO: Implement stop() method.
    }

    public function reload()
    {
        // TODO: Implement reload() method.
    }

    public function restart()
    {
        // TODO: Implement status() method.
    }
}