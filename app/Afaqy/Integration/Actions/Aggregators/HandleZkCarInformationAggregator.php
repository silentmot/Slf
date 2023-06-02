<?php

namespace Afaqy\Integration\Actions\Aggregators;

use Afaqy\Core\Actions\Aggregator;
use Afaqy\Integration\Actions\SlfCalls\SendCarInformationToSLFAction;

class HandleZkCarInformationAggregator extends Aggregator
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
        $car_info = (new SendCarInformationToSLFAction($this->data))->execute();

        if (!$car_info) {
            return false;
        }

        if ($car_info['operation_type'] == 'entrancePermission') {
            return (new HandleEntrancePermissionAggregator($car_info))->execute();
        }

        if ($car_info['operation_type'] == 'startTrip') {
            return (new HandleStartTripAggregator($car_info))->execute();
        }

        if ($car_info['operation_type'] == 'scale') {
            return (new HandleScaleAggregator($car_info))->execute();
        }

        return false;
    }
}
