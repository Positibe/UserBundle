<?php

namespace Positibe\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PositibeUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }

}
