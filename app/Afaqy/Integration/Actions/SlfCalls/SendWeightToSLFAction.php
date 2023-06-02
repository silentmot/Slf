<?php

namespace Afaqy\Integration\Actions\SlfCalls;

use Afaqy\Core\Actions\Action;
use Afaqy\Integration\Facades\SLF;
use Illuminate\Support\Facades\Http;
use Afaqy\Integration\Events\Fail\FailSendWeightToSlf;
use Afaqy\Integration\Events\Success\SuccessfullySendWeightToSlf;

class SendWeightToSLFAction extends Action
{
    /**
     * @var array
     */
    public $data;

    /**
     * @param array $data
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        if (!$token = SLF::token()) {
            return false;
        }

        $response = $this->sendRequestToSlf($token, $this->data);

        if (!$response) {
            return false;
        }

        return true;
    }

    /**
     * @param  string $token
     * @param  array $data
     * @return array|null
     */
    private function sendRequestToSlf($token, $data)
    {
        $request = [
            'url'  => config('slf.url') . '/car_weight',
            'type' => 'post',
            'body' => [
                'trip_id'      => $data['trip_id'],
                'plate_number' => $data['unit']['plate_number'],
                'weight'       => $data['weight'],
                'weight_time'  => $data['weight_time'],
                'device_ip'    => $data['devices']['lpr']['ip'] ?? $data['devices']['rfid']['ip'],
                'scale_ip'     => $data['scale']['ip'],
            ],
        ];

        $response = Http::acceptJson()
            ->timeout(300)
            ->withToken($token)
            ->post($request['url'], $request['body']);

        if (!$response->successful()) {
            event(new FailSendWeightToSlf($request, $response));

            return false;
        }

        event(new SuccessfullySendWeightToSlf($request, $response));

        return true;
    }
}
