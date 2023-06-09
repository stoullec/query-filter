<?php
namespace Stoullec\QueryFilter;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class AcmeTestBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return __DIR__;
    }
}