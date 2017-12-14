<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Console\Lib;


abstract class CmdInfo
{
    private $cmdList;
    private $cmdGroupName;

    abstract protected function setList();
    abstract protected function setGroupName();


    public function __construct()
    {
        $this->cmdList = $this->setList();
        $this->cmdGroupName = $this->setGroupName();
    }

    public function getCommands()
    {
        return $this->cmdList;
    }

    public function getGroup()
    {
        return $this->cmdGroupName;
    }



}