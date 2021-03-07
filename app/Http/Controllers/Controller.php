<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
	 * Return 200 response
	 * @param string $message
	 * @param mixed $data
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function response(string $message, $data, int $code) {

		return response()->json([
			"code"    => $code,
			"success" => true,
			"message" => $message,
			"data"    => $data,
		], $code);

	}
}
