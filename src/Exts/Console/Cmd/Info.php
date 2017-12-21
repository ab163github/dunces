<?php
/**
 * Console default info
 * @author ab163github <ab__@163.com>
 * @version  0.0.1
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Console\Cmd;


use Dunces\Exts\Console\Lib\ICmdIo;
use Dunces\Exts\Console\Lib\ICommand;

class Info implements ICommand
{
    public function __construct()
    {
    }

    private function logo()
    {
        $logo = '
======*********************************************************************======       
            _/_/_/    _/    _/  _/      _/    _/_/_/  _/_/_/_/    _/_/_/        
           _/    _/  _/    _/  _/_/    _/  _/        _/        _/               
          _/    _/  _/    _/  _/  _/  _/  _/        _/_/_/      _/_/            
         _/    _/  _/    _/  _/    _/_/  _/        _/              _/           
        _/_/_/      _/_/    _/      _/    _/_/_/  _/_/_/_/  _/_/_/              
======********************************************************************=======        
        ';
        return $logo;
    }

    public function execute(ICmdIo $io)
    {
        $io->outPutLine($this->logo());
        $versions= array();
        //array_push($versions,'Dunces verson: '.$dunce->getApp('Dunce')->version);
        //array_push($versions,'Console version: '.$dunce->getApp('Console')->version);
        $io->outPutLine(implode(' ',$versions));
        //throw new \Exception('');
    }




//    public function desc()
//    {
//        $desc['desc'] = 'Show the dunces framework information';
//        $desc['opts'] = array(
//            '-v,--version'=>'Show dunces framework version',
//            '-h,--help'=>'show'
//        );
//
//        return ;
//    }



}