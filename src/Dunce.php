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
use http\Exception\BadMessageException;
use Pimple\Container;

final class Dunce
{
    const VERSION = '0.0.1';
    const SETTING_NAME = 'Setting';

    private static $_i;

    private $_container = null;

    private function _loadExt($namespace,$extensions)
    {
        foreach ($extensions as $k=>$e){
            $fullName = implode('\\',array($namespace,$e));
            if(class_exists($fullName)){
                $obj = new $fullName;
                if($obj instanceof IDunceExt){
                    $this->container[trim($k)] = function () use ($fullName){
                        return new $fullName;
                    };
                }else{
                    echo "$fullName is not a 'IDunceExt' instance";
                }
            }else{
                echo "$fullName is not exist";
            }
        }
    }

    private function _loadDunceExt()
    {
        if(!empty($this->_extList)) return;
        $setting = $this->_container->offsetGet(self::SETTING_NAME);
        if($setting->get('Dunces.namespace',null) && $setting->get('Extensions.namespace',null)){
            $namespace = implode('\\',array($setting->get('Dunces.namespace'),$setting->get('Extensions.namespace')));
            $this->_loadExt($namespace,$setting->get('Extensions.extension',array()));
        }
    }

    private function __construct(){
        $this->_container = new Container();
        $this->_container['Setting'] = function ($c){
            return Config::load(__DIR__ . '/Dunce.ini');
        };
    }

    private function __clone(){}

    private static function getDunce(){
        if (!(self::$_i  instanceof self)){
            self::$_i = new self();
        }
        self::$_i->_loadDunceExt();
        return self::$_i;
    }

    public static function __callStatic($method,$arg)
    {
        if(self::getDunce()->_container->offsetExists($method))
            return self::getDunce()->_container->offsetGet($method);
        else
           echo 'False';
    }





}