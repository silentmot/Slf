<?php

namespace Afaqy\Integration\Events\Fail;

use Illuminate\Queue\SerializesModels;

class FailCreateTelnetSocket
{
    use SerializesModels;

    /**
     * @var string
     */
    public $status = 'fail';

    /**
     * @var string
     */
    public $client = 'telnet';

    /**
     * @var mixed
     */
    public $request;

    /**
     * @var mixed
     */
    public $response;

    /**
     * @var mixed
     */
    public $data;

    /**
     * @param mixed  $request
     * @param mixed  $request
     * @return void
     */
    public function __construct($request, $data)
    {
        $this->request = $request;
        $this->data    = $data;
    }
}
