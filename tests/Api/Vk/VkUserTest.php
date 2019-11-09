<?php


class VkUserTest extends TestCase
{
	public function testSearchUser() {
		$ids = [
			'https://vk.com/durov',
			'https://m.vk.com/durov',
			'durov',
			1
		];

		foreach ($ids as $id) {
			$this->call('GET', '/api/vk/search', [ 'query' => $id ], [], [], $this->header);

			$content = json_decode($this->response->getContent());

			$this->assertEquals('Павел', $content->first_name);
			$this->assertFalse($content->is_closed);
			$this->assertEquals(1, $content->verified);
		}

	}
}
