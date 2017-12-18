<?php
/**
 * Console default info
 * @author ab163github <ab__@163.com>
 * @version  0.0.1
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Console\Cmd;




use Dunces\Dunce;
use Dunces\Lib\ICmdIo;
use Dunces\Lib\ICommand;
use Dunces\Lib\AbsCmdInfo;

class Info extends AbsCmdInfo implements ICommand
{
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

    protected function setList()
    {
        return array('info'=>'Info');
    }

    public function execute(Dunce $dunce,ICmdIo $io)
    {
        $io->outPutLine($this->logo());
        $versions= array();
        array_push($versions,'Dunces verson: '.$dunce->getApp('Dunce')->version);
        array_push($versions,'Console version: '.$dunce->getApp('Console')->version);
        $io->outPutLine(implode(' ',$versions));
        throw new \Exception('');
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