<?php

namespace App\Controller;

use App\Application\SearchByFields\SearchByFieldsQuery;
use http\Env\Request;
use App\Domain\Trait\Fields;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends ApiController
{
    use Fields;

    //I decided to leave the door open and allow more filters to be added through get if needed, you
    //would only then need to add the filter in the trait and the fields array, and the application will retrieve the results
    #[Route(path: '/search', name:'search_by_fields', methods: ['GET'])]
    public function searchByFields(Request $request): string
    {
        $filterFood = $request->get($this->filterFood);
        $fields = [
            $this->filterFood => $filterFood
        ];

        $searchByFieldQuery = new SearchByFieldsQuery($fields);
        $searchByFieldResponse = $this->queryBus->dispatch($searchByFieldQuery);

        return $this->apiResponse->handleResponse($searchByFieldResponse);
    }

    public function searchById(Request $request)
    {
    }
}