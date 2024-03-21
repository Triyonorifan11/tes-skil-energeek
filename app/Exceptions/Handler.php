<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\DB;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        if (DB::transactionLevel() > 0) {
            DB::rollBack();
        }
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (Throwable $e, $request) {
            if ($request->expectsJson()) {
                if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                    return ResponseFormatter::error([
                        'exception_class' => get_class($e),
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                        // 'trace' => $e->getTraceAsString()
                    ], $e->getMessage(), $e->getStatusCode());
                } else {
                    if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                        return ResponseFormatter::error([
                            'exception_class' => get_class($e),
                            'file' => $e->getFile(),
                            'line' => $e->getLine(),
                            // 'trace' => $e->getTraceAsString()
                        ], $e->getMessage(), 401);
                    } elseif ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                        return ResponseFormatter::error([
                            'exception_class' => get_class($e),
                            'file' => $e->getFile(),
                            'line' => $e->getLine(),
                            // 'trace' => $e->getTraceAsString()
                        ], $e->getMessage(), 404);
                    } else {
                        return ResponseFormatter::error([
                            'exception_class' => get_class($e),
                            'file' => $e->getFile(),
                            'line' => $e->getLine(),
                            // 'trace' => $e->getTraceAsString()
                        ], $e->getMessage(), 500);
                    }
                }
            }
        });
    }
}
