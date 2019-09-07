<?php
namespace App\Tests\Controller\API;

use App\Controller\API\InviteController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Invite;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class InviteControllerTest extends TestCase
{
    public function testInviteCreation()
    {
        $client = new Client([
            'base_uri' => 'http://viral-growth.com:80',
            'defaults' => [
                'exceptions' => false
            ]
        ]);

        $response = $client->get("/invite/1/create");

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());

        $response = $client->get("/invite/1/create");

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $responseBodyArray = json_decode($response->getBody(true), true);
        $this->assertArrayHasKey('resource', $responseBodyArray);
        $this->assertArrayHasKey('code', $responseBodyArray['resource']);

        return $responseBodyArray['id'];
    }
}