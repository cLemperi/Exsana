<?php

namespace App\Data;

use App\Entity\Category;

class SearchData
{
    //système qui permet de rentrer un mot clé pour une recherche
    /**
     * @var string
     */
    public $q = '';

    /**
     * @var Category[]
     */
    public $category = [];
}
