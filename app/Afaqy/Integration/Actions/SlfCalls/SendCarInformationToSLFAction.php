<?php

namespace Afaqy\Integration\Actions\SlfCalls;

use Afaqy\Core\Actions\Action;
use Afaqy\Integration\Facades\SLF;
use Illuminate\Support\Facades\Http;
use Afaqy\Integration\Facades\Tracer;
use Afaqy\Integration\Events\Fail\FailGetCarInformation;
use Afaqy\Integration\Events\Success\SuccessfullyReceiveCarInformation;
use Afaqy\Integration\Actions\DevicesCalls\DisplayMessageOnScreenAction;

class SendCarInformationToSLFAction extends Action
{
    /**
     * @var \Afaqy\Integration\DTO\ZkCarInfoData
     */
    public $data;

    /**
     * @param \Afaqy\Integration\DTO\ZkCarInfoData $data
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

        $response = $this->sendRequestToSlf($token, $this->data->toArray());

        if (!$response) {
            return false;
        }

        return $response;
    }

    /**
     * @param  string $token
     * @param  array $data
     * @return array|null
     */
    private function sendRequestToSlf($token, $data)
    {
        $request = [
            'url'  => config('slf.url') . '/car_information',
            'type' => 'post',
            'body' => $data,
        ];

        $response = Http::acceptJson()
            ->timeout(300)
            ->withToken($token)
            ->post($request['url'], $request['body']);

        if ($response->successful()) {
            Tracer::setSuccessData($response->json());

            event(new SuccessfullyReceiveCarInformation($request, $response));

            return $response->json()['data'];
        }

        Tracer::setErrors($response->json());

        event(new FailGetCarInformation($request, $response));

        $response = $response->json();

        if (isset($response['errors']['message'])) {
            if ($response['errors']['devices']['lpr']) {
                (new DisplayMessageOnScreenAction(
                    $response['errors']['message'],
                    $response['errors']['devices']['lpr']['ip']
                ))->execute();
            }
        }

        return null;
    }
}
