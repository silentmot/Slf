<?php

namespace Afaqy\Integration\Actions\DevicesCalls;

use Afaqy\Core\Actions\Action;
use Illuminate\Support\Facades\Http;
use Afaqy\Integration\Events\Fail\FailDisplayMessageOnScreen;
use Afaqy\Integration\Events\Success\SuccessfullyDisplayMessageOnScreen;

class DisplayMessageOnScreenAction extends Action
{
    /**
     * @var array
     */
    public $message;

    /**
     * @var string
     */
    public $device_ip;

    /**
     * @param array $message
     * @param string $device_ip
     * @return void
     */
    public function __construct($message, $device_ip = null)
    {
        $this->message   = $message;
        $this->device_ip = $device_ip;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $parameters = [
            'type'         => 'post',
            'deviceIp'     => $this->device_ip ?? request()->device_ip,
            'view'         => $this->message['text'],
            'voice'        => $this->message['sound'],
            'access_token' => config('slf.zk_token'),
        ];

        $request = [
            'url'  => config('slf.zk') . '/parkAuthorize/voiceControl?' . http_build_query($parameters),
            'type' => 'post',
            'body' => [],
        ];

        $response = Http::acceptJson()
            ->timeout(300)
            ->post($request['url'], $request['body']);

        $response_data = $response->json();

        if (!$response->successful() || $response_data['ret'] < 0) {
            event(new FailDisplayMessageOnScreen($request, $response));

            return false;
        }

        event(new SuccessfullyDisplayMessageOnScreen($request, $response));

        return true;
    }
}
