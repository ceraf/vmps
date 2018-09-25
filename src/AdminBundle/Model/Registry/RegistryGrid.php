<?php

namespace App\AdminBundle\Model\Registry;

interface RegistryGrid
{
    public function getByPage($offset = 0, 
                    $limit = 50, $sortby = "id", 
                    $sorttype = "ASC", $search = null);
                    
    public function getTotal($search);
}