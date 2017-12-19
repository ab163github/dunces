<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Exts\Console\Lib;


abstract class AbsCmdInfo
{
    private $cmdList;
    private $cmdGroupName;

    abstract protected function setList();

    protected function setGroupName()
    {
        return 'default';
    }

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