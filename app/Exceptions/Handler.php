<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\ApiResponser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof SurplusException) {
            return $this->errorResponse($exception->message, $exception->status);
        } else if ($exception instanceof MethodNotAllowedHttpException) {
            $code = $exception->getStatusCode();
            $message = "Method URL tidak diizinkan";
            return $this->errorResponse($message, $code);
        } else if ($exception instanceof NotFoundHttpException) {
            $code = $exception->getStatusCode();
            $message = Response::$statusTexts[$code];
            return $this->errorResponse($message, $code);
        } else if ($exception instanceof RouteNotFoundException) {
            return $this->errorResponse('Jangan asal bro', Response::HTTP_INTERNAL_SERVER_ERROR);
        } else if ($exception instanceof AuthenticationException) {
            return $this->errorResponse('Unauthenticated, token tidak ditemukan', Response::HTTP_UNAUTHORIZED);
        }

        if (env('APP_DEBUG', false)) {
            return parent::render($request, $exception);
        }
    }
}
