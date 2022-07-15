<?php

namespace App\Exceptions;

use App\Http\Resources\Exceptions\LoginFailedResource;
use App\Http\Resources\Exceptions\MethodNotAllowedHttpResource;
use App\Http\Resources\Exceptions\NoApiTokenProvidedResource;
use App\Http\Resources\Exceptions\NotFoundHttpResource;
use App\Http\Resources\Exceptions\RecordDoesntExistResource;
use App\Http\Resources\Exceptions\TokenExpiredResource;
use App\Http\Resources\Exceptions\UnauthorizedResource;
use App\Http\Resources\Exceptions\ValidationFailedResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

    public function render($request, Throwable $e)
    {
        if ($request->expectsJson()) {
            $resource = null;

            if ($e instanceof NotFoundHttpException) $resource = NotFoundHttpResource::make();
            if ($e instanceof MethodNotAllowedHttpException) $resource = MethodNotAllowedHttpResource::make();
            if ($e instanceof NoApiTokenProvidedException) $resource = NoApiTokenProvidedResource::make();
            if ($e instanceof RecordDoesntExistException) $resource = RecordDoesntExistResource::make();
            if ($e instanceof LoginIncorrectException || $e instanceof PasswordIncorrectException) $resource = LoginFailedResource::make();
            if ($e instanceof AuthorizationException) $resource = UnauthorizedResource::make();
            if ($e instanceof TokenExpiredException) $resource = TokenExpiredResource::make();
            if ($e instanceof ValidationException) $resource = ValidationFailedResource::make(
                // Convert errors to string instead of array of string
                Collection::make($e->errors())->map(function ($i) {
                    return join(', ', $i);
                })
            );

            if ($resource) return $resource->toResponse($request);
        }

        return parent::render($request, $e);
    }
}
