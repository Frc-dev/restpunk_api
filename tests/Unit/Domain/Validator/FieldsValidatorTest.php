<?php

namespace App\Tests\Unit\Domain\Validator;

use App\Domain\DomainError\ValidationFailedException;
use App\Domain\Validator\FieldsValidator;
use App\Tests\Unit\Domain\SearchFieldsMother;
use App\Tests\Unit\Domain\UnitTestCase;
use Symfony\Component\Validator\Validation;

class FieldsValidatorTest extends UnitTestCase
{
    private FieldsValidator $fieldsValidator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->fieldsValidator = new FieldsValidator(
            Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator()
        );
    }

    /** @test
     * @dataProvider validFields
     * */
    public function test_accept_valid_fields($fields): void
    {
        $this->expectNotToPerformAssertions();
        $this->fieldsValidator->validateFields($fields);
    }

    /** @test
     * @dataProvider invalidFields
     * */
    public function test_throws_exception_invalid_fields($fields): void
    {
        $this->expectException(ValidationFailedException::class);
        $this->fieldsValidator->validateFields($fields);
    }

    public function validFields(): array
    {
        return [
            [SearchFieldsMother::withFood('tacos and beer')],
            [SearchFieldsMother::withFood('hershey\'s chocolate syrup 300ml sauce')],
            [SearchFieldsMother::withFood('paella valenciana con arroz y garrofón')]
        ];
    }

    public function invalidFields(): array
    {
        return [
            [SearchFieldsMother::withFood('<?php echo>>')],
            [SearchFieldsMother::withFood('{}(*};')],
            [SearchFieldsMother::withFood('')]
        ];
    }
}