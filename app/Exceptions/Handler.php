<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\HasApiResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    use HasApiResponse;

    protected $dontReport = [];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception): void
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson()) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->ApiErrorResponse([], 'Data Not Found', Response::HTTP_NOT_FOUND);
            }

            if ($exception instanceof ValidationException) {
                return $this->validationErrorResponse($exception->errors());
            }
            if ($exception instanceof MissingAbilityException) {
                return $this->UnauthorizedRole([], 'Forbidden Access', Response::HTTP_FORBIDDEN);
            }
        }

        return parent::render($request, $exception);
    }
}
