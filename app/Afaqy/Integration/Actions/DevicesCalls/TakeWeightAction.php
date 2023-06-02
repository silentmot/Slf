<?php

namespace Afaqy\Integration\Actions\DevicesCalls;

use Carbon\Carbon;
use Afaqy\Core\Actions\Action;
use Afaqy\Integration\Facades\Tracer;
use Afaqy\Integration\Events\Fail\FailTakeUnitWeight;
use Afaqy\Integration\Events\Success\SuccessfullyTakeUnitWeight;

class TakeWeightAction extends Action
{
    /**
     * Trip information
     * @var array
     */
    public $trip;

    /**
     * @param array $trip
     * @return void
     */
    public function __construct($trip)
    {
        $this->trip = $trip;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $weight = $this->takeWeight($this->trip['scale']);

        if ($weight < 0) {
            return false;
        }

        $this->trip['weight']      = $weight;
        $this->trip['weight_time'] = Carbon::now()->toIso8601String();

        return $this->trip;
    }

    /**
     * @param  array $scale
     * @return int
     */
    private function takeWeight($scale)
    {
        $connection = (new OpenTelnetConnectionAction($scale['ip'], $scale['com_port']))->execute();

        if (!$connection) {
            return -1;
        }

        $weight = $this->readWeight($connection);

        if (!$weight) {
            return -1;
        }

        return $weight;
    }

    /**
     * @param  resource $socket
     * @return mixed
     */
    private function readWeight($socket)
    {
        // wait 3 seconds before take the reads
        sleep(3);

        $weight = 0;

        for ($i = 0; $i < 3; $i++) {
            preg_match_all('/[1-9][0-9]*/', socket_read($socket, 2048), $weights);
            $weight = $weights[0] ? (int) max($weights[0]) : 0;

            if ($weight > 500) {
                break;
            }

            sleep(1);
        }

        socket_close($socket);

        if ($weight <= 500) {
            $message = ["Weight is less than 500 kg."];

            event(new FailTakeUnitWeight($this->trip, $message));

            Tracer::setErrors($message);

            return false;
        }

        event(new SuccessfullyTakeUnitWeight($this->trip, $weight));

        return (int) $weight;
    }
}
