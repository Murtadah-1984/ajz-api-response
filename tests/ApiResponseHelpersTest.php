<?php

declare(strict_types=1);

namespace Ajz\ApiResponse\Tests;

use Exception;
use Illuminate\Support\Collection;
use Ajz\ApiResponse\Traits\ApiResponseHelpers;

class ApiResponseHelpersTest extends TestCase
{
    use ApiResponseHelpers;

    public function test_respond_not_found(): void
    {
        $response = $this->respondNotFound('Resource not found');
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals(['error' => 'Resource not found'], $response->getData(true));
    }

    public function test_respond_with_success_empty(): void
    {
        $response = $this->respondWithSuccess();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['success' => true], $response->getData(true));
    }

    public function test_respond_with_success_collection(): void
    {
        $data = new Collection(['test' => 'value']);
        $response = $this->respondWithSuccess($data);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['test' => 'value'], $response->getData(true));
    }

    public function test_respond_with_success_array(): void
    {
        $data = ['test' => 'value'];
        $response = $this->respondWithSuccess($data);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($data, $response->getData(true));
    }

    public function test_respond_ok(): void
    {
        $response = $this->respondOk('Operation successful');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['success' => 'Operation successful'], $response->getData(true));
    }

    public function test_respond_created(): void
    {
        $data = ['id' => 1];
        $response = $this->respondCreated($data);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals($data, $response->getData(true));
    }

    public function test_respond_no_content(): void
    {
        $response = $this->respondNoContent();
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function test_respond_error(): void
    {
        $response = $this->respondError('Bad request');
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals(['error' => 'Bad request'], $response->getData(true));
    }

    public function test_respond_unauthorized(): void
    {
        $response = $this->respondUnAuthenticated();
        $this->assertEquals(401, $response->getStatusCode());
        $this->assertEquals(['error' => 'Unauthenticated'], $response->getData(true));
    }

    public function test_respond_forbidden(): void
    {
        $response = $this->respondForbidden();
        $this->assertEquals(403, $response->getStatusCode());
        $this->assertEquals(['error' => 'Forbidden'], $response->getData(true));
    }

    public function test_respond_failed_validation(): void
    {
        $response = $this->respondFailedValidation(new Exception('Validation failed'));
        $this->assertEquals(422, $response->getStatusCode());
        $this->assertEquals(['message' => 'Validation failed'], $response->getData(true));
    }

    public function test_set_default_success_response(): void
    {
        $this->setDefaultSuccessResponse(['status' => 'ok']);
        $response = $this->respondWithSuccess();
        $this->assertEquals(['status' => 'ok'], $response->getData(true));
    }

    public function test_respond_teapot(): void
    {
        $response = $this->respondTeapot();
        $this->assertEquals(418, $response->getStatusCode());
        $this->assertEquals(['message' => 'I\'m a teapot'], $response->getData(true));
    }
}