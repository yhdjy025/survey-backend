<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * return success
     * @param string $msg
     * @param string $data
     * @param string $url
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($msg = '', $data = '', $url = '')
    {
        return response()->json([
            'status' => 1,
            'msg' => $msg,
            'data' => $data,
            'url' => $url
        ]);
    }

    /**
     * return error
     * @param string $msg
     * @param string $url
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($msg = '', $url = '')
    {
        return response()->json([
            'status' => 0,
            'msg' => $msg,
            'url' => $url
        ]);
    }

    public function getSurvey()
    {
        $title = request('title', '');

    }
}
