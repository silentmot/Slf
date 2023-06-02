<?php

namespace Afaqy\Integration\Actions\Aggregators;

use Afaqy\Core\Actions\Aggregator;
use Afaqy\Integration\Actions\DevicesCalls\OpenGateAction;
use Afaqy\Integration\Actions\DevicesCalls\TakeWeightAction;
use Afaqy\Integration\Actions\SlfCalls\SendWeightToSLFAction;

class TakeWeightAggregator extends Aggregator
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
        $data = (new TakeWeightAction($this->data))->execute();

        if (!$data) {
            return false;
        }

        $response = (new SendWeightToSLFAction($data))->execute();

        if (!$response) {
            return false;
        }

        return (new OpenGateAction($data['devices'], $data['unit']['rfid']))->execute();
    }
}
