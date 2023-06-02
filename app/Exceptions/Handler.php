<?php

namespace App\Exceptions;

use Throwable;
use Afaqy\Core\Http\Responses\ResponseBuilder;
use Afaqy\Integration\Events\Fail\ServerError;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ResponseBuilder;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        event(new ServerError($request, $exception));

        if ($exception instanceof ModelNotFoundException) {
            return $this->returnError(404, trans('messages.exception.404.model'));
        } elseif ($exception instanceof NotFoundHttpException) {
            return $this->returnError(404, trans('messages.exception.404.http'));
        } elseif ($exception instanceof PostTooLargeException) {
            return $this->returnError(413, trans('messages.exception.413'));
        } elseif ($exception instanceof HttpException && $exception->getStatusCode() == '403') {
            return $this->returnError(403, trans('messages.exception.403'));
        }

        return parent::render($request, $exception);
    }
}
