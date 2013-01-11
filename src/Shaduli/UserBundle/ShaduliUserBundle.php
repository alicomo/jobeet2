<?php

namespace Shaduli\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ShaduliUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
