<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class AuthTest extends TestCase
{
	use DatabaseMigrations;


	public function testSuccessLogin() {
		$this->get('api/login', [ 'Authorization' => 'Basic YWRtaW46MDAwMDAw' ]);

		$this->assertObjectHasAttribute('accessToken', json_decode($this->response->getContent()));
	}


	public function testFailLogin() {
		$this->get('api/login', [ 'Authorization' => 'Basic YWRtaW46MDAwMDAwMDA=' ]);

		$content = json_decode($this->response->getContent());

		$this->assertObjectHasAttribute('errors', $content);

		$this->assertEquals(401, $content->response_status->code);
	}
}