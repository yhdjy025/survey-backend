<?php
/**
 * Created by yhdjy.
 * Email: chenweiE@sailvan.com
 * Date: 2018/6/12
 * Time: 16:07
 */

namespace App\Exceptions;


use Throwable;
use Exception;

class AppException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return response()->json([
            'status' => 0,
            'msg' => $this->getMessage(),
        ]);
    }
}