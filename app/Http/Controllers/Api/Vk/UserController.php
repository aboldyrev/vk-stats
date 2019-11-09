<?php

namespace App\Http\Controllers\Api\Vk;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use VK\Client\VKApiClient;

class UserController extends Controller
{
	function __construct() {
		$this->middleware('permission:view');
	}


	public function search(Request $request) {
		$client = new  VKApiClient();
		$id = $this->trimUserId($request->input('query'));

		$response = $client->users()->get(env('SERVICE_ACCESS_KEY'), [
			'user_ids' => $id,
			'fields' => [
				'last_seen', 'online', 'verified', 'domain'
			],
			'lang' => 'ru'
		]);

		return $response[0];
	}


	protected function trimUserId(string $id) {
		if (mb_stripos($id, 'vk.com')) {
			$id = str_replace([ 'https://vk.com/', 'https://m.vk.com/' ], '', $id);
		}

		return $id;
	}
}