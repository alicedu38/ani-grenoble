<?php

namespace AniGrenoble\UtilisateurBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AniGrenobleUtilisateurBundle extends Bundle
{
	public function getParent()
  	{
    	return 'FOSUserBundle';
  	}
}
