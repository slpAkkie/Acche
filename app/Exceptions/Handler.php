<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        // Handle Api exceptions only if JSON response expects
        if ($request->expectsJson()) {
            $resource = null;

            if ($e instanceof \Illuminate\Auth\Access\AuthorizationException) $resource = \App\Http\Resources\Exceptions\UnauthorizedResource::make();
            if ($e instanceof \Illuminate\Validation\ValidationException) $resource = \App\Http\Resources\Exceptions\ValidationFailedResource::make(
                // Convert errors to string instead of array of string
                \Illuminate\Support\Collection::make($e->errors())->map(function ($i) {
                    return join(', ', $i);
                })
            );

            if ($resource) return $resource->toResponse($request);
        }

        return parent::render($request, $e);
    }
}
