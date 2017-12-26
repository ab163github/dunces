<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Services;


use Dunces\Exts\Services\Lib\IConsoleManagementService;

class SwBasedService implements IConsoleManagementService
{

    public function __construct()
    {
    }

    public function start()
    {
        $http = new \swoole_http_server("0.0.0.0", 80);
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

    public function status()
    {
        // TODO: Implement status() method.
    }
}