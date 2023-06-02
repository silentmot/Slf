<?php

namespace Afaqy\Integration\Events\Fail;

use Illuminate\Queue\SerializesModels;

class FailGetCarInformation
{
    use SerializesModels;

    /**
     * @var string
     */
    public $status = 'fail';

    /**
     * @var string
     */
    public $client = 'slf';

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
        $this->request  = $request;
        $this->response = $response;
    }
}
