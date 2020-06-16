<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use App\Model\Nasabah;
use App\Model\Appointment;
use App\Model\User;
use Illuminate\Support\Facades\Auth;


class Handler extends ExceptionHandler
{
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
     * @param \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 404) {
                return response()->view('error404', [], 404);
            }

            if ($exception->getStatusCode() == 500) {
                return response()->view('error404', [], 500);
            }
        }
        // 404 page with status code 200
        if ($exception instanceof ModelNotFoundException) {
//            if($exception->getModel() == Appointment::class) {
//                if(Auth::check()) {
//                    if (Auth::User()->roles_id == User::MANAGER) {
//                        return response()->view('manager.appointment.notfound');
//                    } else if (Auth::User()->roles_id == User::RESEPSIONIS) {
//
//                    } else if (Auth::User()->roles_id == User::KEPATUHAN) {
//
//                    } else {
//
//                    }
//                } else {
//                     return response()->view('error404', [], 200);
//                }
//            }
            return response()->view('error404', [], 200);
        }

        return parent::render($request, $exception);
    }
}
