<?php

declare(strict_types=1);

namespace ShopSaas\Tests\Shared\Infrastructure\Behat;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Mink\Session;
use Behat\MinkExtension\Context\RawMinkContext;
use JsonException;
use Ramsey\Uuid\Uuid;
use ShopSaas\Tests\Shared\Infrastructure\Mink\MinkHelper;
use ShopSaas\Tests\Shared\Infrastructure\Mink\MinkSessionRequestHelper;
use RuntimeException;

final class ApiContext extends RawMinkContext
{
    private MinkHelper               $sessionHelper;
    private MinkSessionRequestHelper $request;

    public function __construct(private Session $minkSession)
    {
        $this->sessionHelper = new MinkHelper($this->minkSession);
        $this->request       = new MinkSessionRequestHelper(new MinkHelper($minkSession));
    }

    /**
     * @Given I send a :method request to :url
     */
    public function iSendARequestTo($method, $url): void
    {
        $this->request->sendRequest($method, $this->locatePath($url));
    }

    /**
     * @Given I send a :method request to :url with body:
     */
    public function iSendARequestToWithBody($method, $url, PyStringNode $body): void
    {
        $this->request->sendRequestWithPyStringNode($method, $this->locatePath($url), $body);
    }

    /**
     * @Then the response content should be:
     */
    public function theResponseContentShouldBe(PyStringNode $expectedResponse): void
    {
        $expected = $this->sanitizeOutput($expectedResponse->getRaw());
        $actual   = $this->sanitizeOutput($this->sessionHelper->getResponse());

        if ($expected !== $actual) {
            throw new RuntimeException(
                sprintf("The outputs does not match!\n\n-- Expected:\n%s\n\n-- Actual:\n%s", $expected, $actual)
            );
        }
    }

    /**
     * @Then the response should be empty
     */
    public function theResponseShouldBeEmpty(): void
    {
        $actual = trim($this->sessionHelper->getResponse());

        if (!empty($actual)) {
            throw new RuntimeException(
                sprintf("The outputs is not empty, Actual:\n%s", $actual)
            );
        }
    }

    /**
     * @Then the response should contains an uuid
     */
    public function theResponseShouldContainsAnUuid(): void
    {
        $actualResponse = trim($this->sessionHelper->getResponse());

        try {
            $actual = json_decode($actualResponse, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new RuntimeException(sprintf("The outputs cannot be parsed to JSON, Actual:\n%s", $actualResponse));
        }

        if (!Uuid::isValid($actual['id'])) {
            throw new RuntimeException(
                sprintf("The outputs doesn't contain an Uuid inside id attribute, Actual:\n%s", $actual)
            );
        }
    }

    /**
     * @Then the response should contains a JWT token
     */
    public function theResponseShouldContainsAJWTToken(): void
    {
        $actualResponse = trim($this->sessionHelper->getResponse());
        $JWTStringCheck = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzUxMiJ9.';

        try {
            $actual = json_decode($actualResponse, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new RuntimeException(sprintf("The outputs cannot be parsed to JSON, Actual:\n%s", $actualResponse));
        }

        if (false === str_starts_with($actual['data'], $JWTStringCheck)) {
            throw new RuntimeException(
                sprintf("The outputs doesn't contain an Uuid inside id attribute, Actual:\n%s", $actual)
            );
        }
    }

    /**
     * @Then print last api response
     */
    public function printApiResponse(): void
    {
        print_r($this->sessionHelper->getResponse());
    }

    /**
     * @Then print response headers
     */
    public function printResponseHeaders(): void
    {
        print_r($this->sessionHelper->getResponseHeaders());
    }

    /**
     * @Then the response status code should be :expectedResponseCode
     */
    public function theResponseStatusCodeShouldBe($expectedResponseCode): void
    {
        if ($this->minkSession->getStatusCode() !== (int) $expectedResponseCode) {
            throw new RuntimeException(
                sprintf(
                    'The status code <%s> does not match the expected <%s>',
                    $this->minkSession->getStatusCode(),
                    $expectedResponseCode
                )
            );
        }
    }

    private function sanitizeOutput(string $output): false|string
    {
        return json_encode(json_decode(trim($output), true));
    }
}
