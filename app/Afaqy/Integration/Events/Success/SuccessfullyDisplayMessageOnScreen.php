<?php

namespace Afaqy\Integration\Events\Success;

use Illuminate\Queue\SerializesModels;

class SuccessfullyDisplayMessageOnScreen
{
    use SerializesModels;

    /**
     * @var string
     */
    public $status = 'success';

    /**
     * @var string
     */
    public $client = 'zk';

    /**
     * @var mixed
     */
    public $request;

    /**
     * @var mixed
     */
    public $response;

    /**
     * @param mixed  $request
     * @param mixed  $request
     * @return void
     */
    public function __construct($request, $response)
    {
        $this->request      = $request;
        $this->response     = $response;
    }
}
