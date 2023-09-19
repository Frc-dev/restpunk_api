<?php

namespace App\Controller;

use App\Application\SearchByFields\SearchByFieldsQuery;
use App\Application\SearchById\SearchByIdQuery;
use http\Env\Request;
use App\Domain\Trait\Fields;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends ApiController
{
    use Fields;

    //I decided to allow more filters to be added through get if needed, you would only then need to
    //add the filter in the trait and the fields array, and the application will retrieve the results
    #[Route(path: '/search', name:'search_by_fields', methods: ['GET'])]
    public function searchByFields(Request $request): string
    {
        $fields = [
            $this->fieldFood => $request->get($this->fieldFood)
        ];

        $searchByFieldQuery = new SearchByFieldsQuery($fields);
        $searchByFieldResponse = $this->queryBus->dispatch($searchByFieldQuery);

        return $this->apiResponse->handleResponse($searchByFieldResponse);
    }

    #[Route(path: '/id', name:'search_by_id', methods: ['GET'])]
    public function searchById(int $id): string
    {
        $searchByIdQuery = new SearchByIdQuery($id);
        $searchByIdResponse = $this->queryBus->dispatch($searchByIdQuery);

        return $this->apiResponse->handleResponse($searchByIdResponse);
    }
}