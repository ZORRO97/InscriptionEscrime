<?php

namespace Shead\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SheadUserBundle extends Bundle
{
	public function getParent()
    {
      return 'FOSUserBundle';
    }
}
