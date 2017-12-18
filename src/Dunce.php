<?php
/**
 * Dunces
 * @author ab163github <ab__@163.com>
 * @version  0.0.1
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces;

use Dunces\Console\Console;
use Noodlehaus\Config;
use Pimple\Container;

class Dunce
{
    private $container;

    public $version = '0.0.1';

    private function initContainer($Apps)
    {
        //TODO 由此开始折腾
        $this->container = new Container();
        $this->container['Dunce'] = $this; //框架本身 包含 配置信息 与 容器
        $this->container['Console'] = new Console($this); //命令行脚本
    }
    
    public function __construct($settings = array())
    {
        $defSetting = Config::load(__DIR__.'/Lib/Dunces.ini');
        $defFwSetting = $defSetting->get('Apps',null);

        $defConsoleSetting = $defSetting->get('Console');
        $consoleName
        var_dump($defConsoleSetting);
        die;


    }

    public function getApp($name)
    {
        return $this->container[$name];
    }


}