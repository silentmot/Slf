<?php

namespace Afaqy\Integration\Actions\SlfCalls;

use Carbon\Carbon;
use Afaqy\Core\Actions\Action;
use Afaqy\Integration\Facades\SLF;
use Illuminate\Support\Facades\Http;
use Afaqy\Integration\Events\Fail\FailSendGateOpenTimeToSlf;
use Afaqy\Integration\Events\Success\SuccessfullySendGateOpenTimeToSlf;

class SendOpenGateTimeToSlf extends Action
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

        if ($response) {
            return true;
        }

        return false;
    }

    /**
     * @param  string $token
     * @param  array $data
     * @return array|null
     */
    private function sendRequestToSlf($token, $data)
    {
        $request = [
            'url'  => config('slf.url') . '/gate_info',
            'type' => 'post',
            'body' => [
                'trip_id'      => $data['trip_id'],
                'plate_number' => $data['unit']['plate_number'],
                'gate_ip'      => $data['devices']['lpr']['ip'] ?? $data['devices']['rfid']['ip'],
                'open_time'    => Carbon::now()->toIso8601String(),
            ],
        ];

        $response = Http::acceptJson()
            ->timeout(300)
            ->withToken($token)
            ->post($request['url'], $request['body']);

        if (!$response->successful()) {
            event(new FailSendGateOpenTimeToSlf($request, $response));

            return false;
        }

        event(new SuccessfullySendGateOpenTimeToSlf($request, $response));

        return true;
    }
}
