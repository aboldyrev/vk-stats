<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class ReplaceStatusResponse
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 *
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		$is_debug = env('APP_DEBUG') && env('APP_ENV') !== 'production';

		/** @var Response $response */
		$response = $next($request);
		$response->headers->set('Content-Type', 'application/json');

		$status_code = $response->status();

		if ($status_code >= 300 && $status_code < 400 && $status_code != 304) {
			return $response;
		}

		$statuses = [
			200 => 'OK',
			201 => 'Created',
			304 => 'Not Modified',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			403 => 'Forbidden',
			404 => 'Not Found',
			424 => 'Failed Dependency',
			500 => 'Internal server error',
		];

		if (!key_exists($status_code, $statuses)) {
			return $response;
		} else {
			$response->setStatusCode(200, "OK");
		}

		$status = [
			'code'    => $status_code,
			'message' => $statuses[ $status_code ],
		];

		if ($status_code != 200) {
			$exception = $response->exception;
			if ($exception) {
				$errors = [
					'file'    => $exception->getFile(),
					'line'    => $exception->getLine(),
					'message' => $exception->getMessage(),
					'trace'   => $this->prepareTrace($exception->getTrace()),
				];
			}

		}
		$content = json_decode($response->getContent());
		if (is_null($content)) {
			$content = [];
		}

		if (is_string($content)) {
			$content = [ 'content' => $content ];
		} elseif (is_object($content)) {
			$content = (array)$content;
		}

		if (is_array($content)) {
			$content = collect($content);
		}

		$content->put('response_status', $status);
		if (isset($errors) && $is_debug) {
			$content->put('errors', $errors);
		}

		$content = json_encode($content, JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR);

		$response->setContent($content);

		// Выполнение действия
		return $response;
	}


	protected function prepareTrace($trace) {
		$result = [];
		foreach ($trace as $key => $item) {

			if (key_exists('file', $item)) {
				$result[ $key ][ 'file' ] = $item[ 'file' ];
			}

			if (key_exists('line', $item)) {
				$result[ $key ][ 'line' ] = $item[ 'line' ];
			}

			if (key_exists('function', $item)) {
				$result[ $key ][ 'function' ] = $item[ 'function' ];
			}

			if (key_exists('class', $item)) {
				$result[ $key ][ 'class' ] = $item[ 'class' ];
			}

		}

		return $result;
	}
}