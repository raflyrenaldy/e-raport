<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use FCM;
use App\Notifications\PushNotification;
use App\Model\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function trueResponse($message, $data = null, $meta = null)
    {
        $data = $this->format($data);
        $meta = $this->format($meta);

        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data,
            'meta'    => $meta,
            'error'   => []
        ], Response::HTTP_OK);
    }

    protected function falseResponse($message, $errors = null, $list = false)
    {
        $errors = $this->format($errors);

        $data = (object)[];
        if ($list) {
            $data = [];
        }

        return response()->json([
            'status'  => false,
            'message' => $message,
            'data'    => $data,
            'meta'    => (object)[],
            'error'   => $errors
        ], Response::HTTP_OK);
    }

    protected function format($var)
    {
        if (is_array($var) && sizeof($var) === 0) [];
        elseif (!$var) $var = (object)[];
        return $var;
    }

    protected function sendNotification($data, $user_ids)
    {
        $payload   = $this->setPayload($data);
        $toUsers   = User::find($user_ids);
        Notification::send($toUsers, new PushNotification($payload));
        // $toUser->notify(new PushNotification($data));
    }

    private function setPayload($data)
    {
        return [
            'notification'   => [
                'title'              => $data['title'],
                'body'               => $data['body'],
            ],
            'data'           => [
                'featurable_type'    => $data['featurable_type'],
                'featurable_id'      => $data['featurable_id'],
                'type'               => $data['type']
            ]
        ];
    }

}
