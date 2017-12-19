<?php
/**
 * Dunces
 * @author ab163github <ab__@163.com>
 * @version  0.0.1
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces;

use Dunces\Dunce\Config;
use Dunces\Dunce\Lib\IDunceExt;
use Dunces\Exts\Console\Console;
use Pimple\Container;

class Dunce
{
    private static $__instance;
    private static $__callStaticArgs;
    private $setting;
    private $container;
    private $extList = array();

    public $version = '0.0.1';

    private function loadExt()
    {
        if($this->setting->get('Dunces.namespace',null) && $this->setting->get('Extensions.namespace',null)){
            $namespace = implode('\\',array($this->setting->get('Dunces.namespace'),$this->setting->get('Extensions.namespace')));
            foreach ($this->setting->get('Extensions.extension',array()) as $k=>$e){
                $fullName = implode('\\',array($namespace,$e));
                if(class_exists($fullName)){
                    $obj = new $fullName;
                    if($obj instanceof IDunceExt){
                        $this->container[trim($k)] = $obj;
                        array_push($this->extList,trim($k));
                    }else{
                        echo "$fullName is not a 'IDunceExt' instance";
                    }
                }else{
                    echo "$fullName is not exist";
                }
            }
        }
    }

    private function __construct()
    {
        $this->container = new Container();
        $this->setting = Config::load(__DIR__ . '/Dunce.ini');
        $this->loadExt();

    }

    private function __clone(){}

    private static function getDunce(){
        if (!(self::$__instance  instanceof self)){
            self::$__instance = new self();
        }
        return self::$__instance;
    }


    public static function __callStatic($method,$arg)
    {
        self::$__callStaticArgs = $arg;
        return self::getDunce()->$method();
    }

    protected function getApp()
    {
        $name = trim(self::$__callStaticArgs[0]);
        if($this->container->offsetExists($name)){
            return $this->container->offsetGet($name);
        }
        return null;
    }

//    public function loadApp()
//    {
//        $
//    }




}