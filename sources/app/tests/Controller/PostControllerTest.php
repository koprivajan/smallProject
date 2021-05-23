<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\DataFixtures\UserFixtures;
use Safe\Exceptions\JsonException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function count;

final class PostControllerTest extends AbstractControllerWebTestCase
{


    /**
     * @throws JsonException
     */
    public function testFindAllPosts(): void
    {
        // test that sending a request without being authenticated will result to a unauthorized HTTP code.
        $this->client->request(Request::METHOD_GET, '/api/posts');
        $this->assertJSONResponse($this->client->getResponse(), Response::HTTP_UNAUTHORIZED);
        // test that sending a request while begin authenticated will result to a OK HTTP code.
        $this->login();
        $this->client->request(Request::METHOD_GET, '/api/posts');
        $response = $this->client->getResponse();
        $content = $this->assertJSONResponse($response, Response::HTTP_OK);
        $this->assertEquals(1, count($content));
    }
}
