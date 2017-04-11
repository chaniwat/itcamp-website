<?php

namespace App\Exceptions;

use Exception;
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
        if($e instanceof NotFoundHttpException)
        {
            return $this->NotFoundExceptionHandler($request, $e);
        }

        return parent::render($request, $e);
    }

    /**
     * Handle the HTTP 404 (Not found)
     * @param \Illuminate\Http\Request $request
     * @param NotFoundHttpException $e
     * @return \Illuminate\Http\Response
     */
    protected function NotFoundExceptionHandler($request, NotFoundHttpException $e)
    {
        // If not the assets or templates(for tracker) or banner(for link-exchange) or storage, handles it (Bypass assets)
        if(!($request->is("assets/*") || $request->is("templates/*") || $request->is("banner/*") || $request->is("storage/*"))) {

            if($request->is("backend/*")) {
                // Backend handle
                config()->set('auth.defaults.guard', 'backend');

                if(!$request->is("backend/auth/*")) {
                    if(!Auth::check()) {
                        return redirect()->route('view.backend.login');
                    } else {
                        if($e instanceof NotFoundHttpException) {
                            return response()->view("backend.error.404", [], 404);
                        }
                    }
                }
            } else {
                if(!env('APP_OPEN')) {
                    // Redirect all route to frontend landing page
                    return redirect()->route('view.frontend.landing');
                }

                // Frontend handle
                config()->set('auth.defaults.guard', 'web');

                // Redirect all route to frontend index page
                return redirect()->route('view.frontend.index');
            }

        }

        return parent::render($request, $e);
    }

}
