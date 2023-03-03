<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<Throwable>, LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
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
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param           $request
     * @param Throwable $e
     * @return Response|JsonResponse
     */
    public function render($request, Throwable $e): Response|JsonResponse
    {
        // 通常のユースケースで発生しうるエラー
        if ($e instanceof HttpException) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
        if ($e instanceof UseCaseException) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
        if ($e instanceof DomainException) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }

        // 想定外のエラー
        return response()->json([
            'message' => $e->getMessage()
        ], 500);
    }
}
