<?php
use Imbo\BehatApiExtension\Context\ApiContext;

class FeatureContext extends ApiContext
{
    /**
     * @Then I want to check something
     */
    public function assertSomething()
    {
        // do some assertions on $this->response, and throw a AssertionFailedException
        // exception if the assertion fails.
    }
}
