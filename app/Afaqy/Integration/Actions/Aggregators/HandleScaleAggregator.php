<?php

namespace Afaqy\Integration\Actions\Aggregators;

use Afaqy\Core\Actions\Aggregator;
use Afaqy\Integration\Actions\DevicesCalls\OpenGateAction;

class HandleScaleAggregator extends Aggregator
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
        if (isset($this->data['trip_id'])) {
            return (new TakeWeightAggregator($this->data))->execute();
        }

        // if any unit other then contract/permission unit types, just open the door
        return (new OpenGateAction($this->data['devices'], $this->data['unit']['rfid']))->execute();
    }
}
