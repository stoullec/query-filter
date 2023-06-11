<?php
namespace Stoullec\QueryFilter;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class StoullecQueryFilterBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return __DIR__;
    }
}