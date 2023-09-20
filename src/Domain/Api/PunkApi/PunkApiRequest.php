<?php

namespace App\Domain\Api\PunkApi;

use App\Domain\Api\ApiRequest;
use App\Domain\SearchResponseCollection;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PunkApiRequest implements ApiRequest
{
    //https://punkapi.com/documentation/v2 for endpoints and format
    use PunkApiData;

    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly PunkApiDataMapper $dataMapper
    ) {
    }

    public function searchByFields(array $fields): SearchResponseCollection
    {
        $baseUrl = $this->buildBaseUrl();
        $params = $this->buildParams($fields);

        $requestUrl = $baseUrl . $params;

        $response = $this->callApi($requestUrl);

        return $this->dataMapper->buildSearchByFieldsResponse($response);
    }

    public function searchById(int $id): SearchResponseCollection
    {
        $baseUrl = $this->buildBaseUrl();

        $requestUrl = $baseUrl . sprintf('/%s', $id);

        $response = $this->callApi($requestUrl);

        return $this->dataMapper->buildSearchByIdResponse($response);
    }

    private function buildBaseUrl(): string
    {
        return $this->baseApiUrl . $this->baseBeersUrl;
    }

    private function buildParams(array $fields): string
    {
        $params = '';

        //build get params from fields that match PunkApi allowed fields in the trait
        foreach ($fields as $name => $value) {
            if (in_array($name, $this->apiFields)) {
                $params .= sprintf('?%s=%s', $name, $value);
            }
        }

        return $params;
    }

    public function callApi(string $url, string $method = 'GET'): array
    {
        try {
            $response = $this->client->request(
                $method,
                $url
            )->getContent();
        } catch (\Exception $e) {
            if ($e->getCode() === 404) {
                throw new NotFoundHttpException();
            }

            if($e->getCode() === 400) {
                throw new BadRequestHttpException();
            }
        }

        return json_decode($response, true);
    }
}
