<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Console\Lib;


class CmdSet
{
    private $namespaces = array();
    private $sets = array();
    private static $_set;

    private function __construct()
    {

    }

    private function __clone(){}

    public static function getSet()
    {
        if(!(self::$_set instanceof self)){
            self::$_set = new self();
        }
        return self::$_set;
    }

    public function cmdLoader(array $nameSpace,$setName='def')
    {
        $infos = array();
        foreach ($nameSpace as $v){
            $className = $v.'\info';
            $info = new$className;
            if(($info instanceof CmdInfo)&&($info instanceof ICommand)){
                //TODO 从这接着写
                echo 'write';
            }
        }

        $this->sets[$setName] = $infos;
    }
}