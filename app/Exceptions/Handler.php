<?php

namespace App\Exceptions;

use App\Http\Resources\Exceptions\LoginFailedResource;
use App\Http\Resources\Exceptions\MethodNotAllowedHttpResource;
use App\Http\Resources\Exceptions\ModelNotFoundResource;
use App\Http\Resources\Exceptions\NoApiTokenProvidedResource;
use App\Http\Resources\Exceptions\NotFoundHttpResource;
use App\Http\Resources\Exceptions\RecordDoesntExistResource;
use App\Http\Resources\Exceptions\TokenExpiredResource;
use App\Http\Resources\Exceptions\UnauthorizedResource;
use App\Http\Resources\Exceptions\ValidationFailedResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        if (!$request->expectsJson()) return parent::render($request, $e);

        if ($e instanceof NotFoundHttpException) return NotFoundHttpResource::make();
        elseif ($e instanceof MethodNotAllowedHttpException) return MethodNotAllowedHttpResource::make();
        elseif ($e instanceof ModelNotFoundException) return ModelNotFoundResource::make($e->getModel())->asResponse();
        elseif ($e instanceof NoApiTokenProvidedException) return NoApiTokenProvidedResource::make();
        elseif ($e instanceof RecordDoesntExistException) return RecordDoesntExistResource::make();
        elseif ($e instanceof LoginIncorrectException || $e instanceof PasswordIncorrectException) return LoginFailedResource::make();
        elseif ($e instanceof AuthorizationException) return UnauthorizedResource::make();
        elseif ($e instanceof TokenExpiredException) return TokenExpiredResource::make();
        elseif ($e instanceof ValidationException) return ValidationFailedResource::make(
            // returns errors as string instead of array
            Collection::make($e->errors())->map(function ($i) {
                return join(', ', $i);
            })
        );
    }
}
