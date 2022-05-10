<?php

declare(strict_types=1);

use Inc\Api;
use PHPUnit\Framework\TestCase;

final class ApiTest extends TestCase {

    protected $api;

    protected function setUp(): void
    {
        $this->api = new Api;
    }


    public function testValidCard()
    {

        $this->api->setCardId('142594708f3a5a3ac2980914a0fc954f');

        $result = $this->api->result();

        $this->assertIsArray($result);
        
        $this->assertEquals(200, $result['code']);

    }

    public function testInvalidCard()
    {

        $this->api->setCardId('invalid_id');

        $result = $this->api->result();

        $this->assertIsArray($result);
        $this->assertEquals(404, $result['code']);


    }


    public function testResultHasValidKey()
    {

        $this->api->setCardId('142594708f3a5a3ac2980914a0fc954f');

        $result = $this->api->result();

        $this->assertArrayHasKey('code', $result);
        $this->assertArrayHasKey('full_name', $result);
        $this->assertArrayHasKey('department', $result);


    }

}