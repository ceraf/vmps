<?php

namespace App\AdminBundle\Model;
    
interface BaseDBModel
{
    public function isHasSeoUrl();
    public function getSeoUrlKey();
	
}