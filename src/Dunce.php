<?php
/**
 * Dunces
 * @author ab163github <ab__@163.com>
 * @version  0.0.1
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces;

use Dunces\Dunce\Config;
use Pimple\Container;

final class Dunce
{
    const DUNCE_VERSION = '0.0.1';
    const SETTING_NAME = 'Setting';
    const EXT_G_INTERFACE = 'Dunces\Dunce\Lib\IDunceExt';

    private static $_i;
    private $_dunceExts = array();
    private $_container = null;

    private function _chkExtImpType($extFullName)
    {
        $implements = class_implements($extFullName);
        if(is_array($implements)){
            if(in_array(self::EXT_G_INTERFACE,$implements)){
                return true;
            }
        }
        return false;
    }

    private function _loadDunceExt()
    {
        if(!empty($this->_dunceExts)) return;
        $setting = $this->_container->offsetGet(self::SETTING_NAME);
        if($setting->get('Dunces.namespace',null) && $setting->get('Extensions.namespace',null)){
            $namespace = implode('\\',array($setting->get('Dunces.namespace'),$setting->get('Extensions.namespace')));
            foreach ($setting->get('Extensions.extension',array()) as $k=>$v){
                if(in_array(trim($k),$this->_dunceExts)) continue;
                $fullName = implode('\\',array($namespace,$v));
                if($this->_chkExtImpType($fullName)){
                    $this->_container[trim($k)] = function ($c) use ($fullName){ return new $fullName;};
                    $this->_dunceExts[] = trim($k);
                }
            }
        }
    }

    private function __construct(){
        $this->_container = new Container();
        $this->_container[self::SETTING_NAME] = function ($c){
            return Config::load(__DIR__ . '/Dunce.ini');
        };
        $this->_container['Version'] = function ($c){
            return 'Dunces version: '.self::DUNCE_VERSION;
        };
    }

    private function __clone(){}

    private static function _getDunce(){
        if (!(self::$_i  instanceof self)){
            self::$_i = new self();
        }
        self::$_i->_loadDunceExt();
        return self::$_i;
    }

    public static function __callStatic($method,$arg)
    {
        if(self::_getDunce()->_container->offsetExists($method))
            return self::_getDunce()->_container->offsetGet($method);
        else
           return null;
    }





}