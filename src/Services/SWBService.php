<?php
/**
 *
 * @author ab163github <ab__@163.com>
 * @version  0.0.0
 * @copyright Copyright ab163github. All rights reserved.
 */

namespace Dunces\Services;


use Dunces\Dunce;
use Dunces\Lib\IApps;

class SWBService implements IApps
{

    public function __construct(Dunce $dunce)
    {
        parent::__construct($dunce);
    }


}