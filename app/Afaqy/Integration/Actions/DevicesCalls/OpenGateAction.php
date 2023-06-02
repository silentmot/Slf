<?php

namespace Afaqy\Integration\Actions\DevicesCalls;

use Afaqy\Core\Actions\Action;
use Illuminate\Support\Facades\Http;
use Afaqy\Integration\Events\Fail\FailOpenGate;
use Afaqy\Integration\Events\Success\SuccessfullyOpenGate;

class OpenGateAction extends Action
{
    /**
     * @var array
     */
    public $devices;

    /**
     * @var int|null
     */
    public $car_rfid;

    /**
     * @param array $devices
     * @param int|null $car_rfid
     * @return void
     */
    public function __construct($devices, $car_rfid = null)
    {
        $this->devices  = $devices;
        $this->car_rfid = $car_rfid;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $status = (isset($this->devices['lpr']))
            ? $this->openLprGate($this->devices['lpr'])
            : $this->openInbioGate($this->devices['rfid'], $this->car_rfid);

        if ($status) {
            return true;
        }

        return false;
    }

    /**
     * @param  array $device
     * @return boolean
     */
    public function openLprGate($device)
    {
        $parameters = [
            'type'         => 'post',
            'deviceIp'     => $device['ip'],
            'interval'     => $device['duration'],
            'access_token' => config('slf.zk_token'),
        ];

        $request = [
            'url'  => config('slf.zk') . '/parkAuthorize/readDataOpenTuenstitleLPR?' . http_build_query($parameters),
            'type' => 'post',
            'body' => [],
        ];

        $response = Http::acceptJson()
            ->timeout(300)
            ->post($request['url'], $request['body']);

        if (!$response->successful() || $response->json()['ret'] < 0) {
            event(new FailOpenGate($request, $response));

            return false;
        }

        event(new SuccessfullyOpenGate($request, $response));

        return true;
    }

    /**
     * @param  array $device
     * @param  int|null $car_rfid
     * @return boolean
     */
    public function openInbioGate($device, $car_rfid)
    {
        $parameters = [
            'type'         => 'post',
            'cardNo'       => $car_rfid,
            'doorName'     => $device['gate_name'],
            'interval'     => $device['duration'],
            'access_token' => config('slf.zk_token'),
        ];

        $request = [
            'url'  => config('slf.zk') . '/parkAuthorize/readDataOpenTuenstitleUHF?' . http_build_query($parameters),
            'type' => 'post',
            'body' => [],
        ];

        $response = Http::acceptJson()
            ->timeout(300)
            ->post($request['url'], $request['body']);

        if (!$response->successful() || $response->json()['ret'] < 0) {
            event(new FailOpenGate($request, $response));

            return false;
        }

        event(new SuccessfullyOpenGate($request, $response));

        return true;
    }
}
