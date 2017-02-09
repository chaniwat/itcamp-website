<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if($request->is("backend/*")) {
            return $this->backendHandler($request, $e);
        } else {
            return $this->frontendHandler($request, $e);
        }
    }

    /**
     * Handle the backend scope error
     *
     * @param $request
     * @param Exception $e
     * @return \Illuminate\Http\Response
     */
    private function frontendHandler($request, Exception $e) {
        config()->set('auth.defaults.guard', 'web');

        return parent::render($request, $e);
    }

    /**
     * Handle the backend scope error
     *
     * @param $request
     * @param Exception $e
     * @return \Illuminate\Http\Response
     */
    private function backendHandler($request, Exception $e) {
        config()->set('auth.defaults.guard', 'backend');

        if(!$request->is("backend/auth/*")) {
            if(!Auth::guard('backend')->check()) {
                return redirect()->route('backend.view.login');
            } else {
                if($e instanceof NotFoundHttpException) {
                    return response()->view("backend.error.404", [], 404);
                }
            }
        }

        return parent::render($request, $e);
    }
}
