<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Console\Cmd;


use Dunces\Console\Lib\CmdInfo;
use Dunces\Console\Lib\ICmdIo;
use Dunces\Console\Lib\ICommand;

class Info extends CmdInfo implements ICommand
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

    protected function setGroupName()
    {
        return 'default';
    }

    protected function setList()
    {
        return array('info');
    }

    public function execute(ICmdIo $io)
    {
        echo $this->logo();
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