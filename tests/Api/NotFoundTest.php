<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class NotFoundTest extends TestCase
{
	use DatabaseMigrations;


	public function testNotFoundRoute() {
		$this->get('api/qwertyuiopasdfghjkl');

		$content = json_decode($this->response->getContent());

		$this->assertResponseStatus(200);

		$this->assertEquals(404, $content->response_status->code);
	}
}