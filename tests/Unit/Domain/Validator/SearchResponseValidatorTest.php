<?php

namespace App\Tests\Unit\Domain\Validator;

use App\Domain\DomainError\ValidationFailedException;
use App\Domain\Validator\SearchResponseValidator;
use App\Tests\Unit\Application\SearchByFields\SearchByFieldsResponseMother;
use App\Tests\Unit\Domain\UnitTestCase;
use Symfony\Component\Validator\Validation;

class SearchResponseValidatorTest extends UnitTestCase
{
    private SearchResponseValidator $searchResponseValidator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->searchResponseValidator = new SearchResponseValidator(
            Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator()
        );
    }

    /** @test
     * @dataProvider validFields
     * */
    public function test_accept_valid_fields($fields): void
    {
        $this->expectNotToPerformAssertions();
        $this->searchResponseValidator->validateSearchResponse($fields);
    }

    /** @test
     * @dataProvider invalidFields
     * */
    public function test_throws_exception_invalid_fields($fields): void
    {
        $this->expectException(ValidationFailedException::class);
        $this->searchResponseValidator->validateSearchResponse($fields);
    }

    public function validFields(): array
    {
        return [
            [SearchByFieldsResponseMother::default()]
        ];
    }

    public function invalidFields(): array
    {
        return [
            [SearchByFieldsResponseMother::withName('<?php echo>')],
            [SearchByFieldsResponseMother::withDescription('<?php echo>')],
            [SearchByFieldsResponseMother::withFirstBrewed('<?php echo>')],
            [SearchByFieldsResponseMother::withTagline('<?php echo>')],
            [SearchByFieldsResponseMother::withImage('<?php echo>')],
        ];
    }
}