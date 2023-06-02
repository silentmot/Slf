<?php

namespace Afaqy\Integration\Actions\Aggregators;

use Afaqy\Core\Actions\Aggregator;
use Afaqy\Integration\Actions\DevicesCalls\OpenGateAction;
use Afaqy\Integration\Actions\SlfCalls\SendOpenGateTimeToSlf;
use Afaqy\Integration\Actions\DevicesCalls\DisplayMessageOnScreenAction;

class HandleStartTripAggregator extends Aggregator
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
        if (isset($this->data['devices']['lpr'])) {
            (new DisplayMessageOnScreenAction($this->data['message'], $this->data['devices']['lpr']['ip']))->execute();
        }

        $response = (new OpenGateAction($this->data['devices'], $this->data['unit']['rfid']))->execute();

        if ($response) {
            (new SendOpenGateTimeToSlf($this->data))->execute();

            return true;
        }

        return false;
    }
}
