<?php

namespace App\Controller;

use http\Env\Request;
use App\Domain\Trait\Filters;

class SearchController extends ApiController
{
    use Filters;
    public function searchByFood(Request $request)
    {
        $field = $request->get($this->filterFood);

        //build query
    }

    public function searchById(Request $request)
    {

    }
}