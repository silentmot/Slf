<?php

namespace Afaqy\Integration\Actions\DevicesCalls;

use Afaqy\Core\Actions\Action;
use Afaqy\Integration\Facades\Tracer;
use Afaqy\Integration\Events\Fail\FailCreateTelnetSocket;

class OpenTelnetConnectionAction extends Action
{
    /**
     * @var string
     */
    private $ip;

    /**
     * @var int
     */
    private $port;

    /**
     * @param string $ip
     * @param int $port
     */
    public function __construct($ip, $port)
    {
        $this->ip   = $ip;
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $socket = $this->socketCreate();

        if (!$socket) {
            return false;
        }

        $connection = $this->socketConnect($socket, $this->ip, $this->port);

        if (!$connection) {
            return false;
        }

        return $socket;
    }

    /**
     * @return resource|null
     */
    private function socketCreate()
    {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, ["sec" => 2, "usec" => 0]);

        if ($socket === false) {
            $message = ["Cannot connect to telnet, socket_create Reason: " . socket_strerror(socket_last_error())];

            event(new FailCreateTelnetSocket(['ip' => $this->ip, 'port' => $this->port], $message));

            Tracer::setErrors($message);

            return false;
        }

        return $socket;
    }

    /**
     * @param  resource $socket
     * @param  string $ip
     * @param  int $port
     * @return boolean
     */
    private function socketConnect($socket, $ip, $port)
    {
        try {
            $connection = socket_connect($socket, $ip, $port);

            if ($connection === false) {
                $message = ["Cannot connect to telnet, socket_connect Reason: " . socket_strerror(socket_last_error($socket))];

                event(new FailCreateTelnetSocket(['ip' => $this->ip, 'port' => $this->port], $message));

                Tracer::setErrors($message);

                return false;
            }

            return $connection;
        } catch (\Exception $e) {
            $message = ["Cannot connect to telnet, socket_connect Reason: " . $e->getMessage()];

            event(new FailCreateTelnetSocket(['ip' => $this->ip, 'port' => $this->port], $message));

            Tracer::setErrors($message);

            return false;
        }
    }
}
