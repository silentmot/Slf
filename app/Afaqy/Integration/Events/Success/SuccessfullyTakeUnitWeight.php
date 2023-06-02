<?php

namespace Afaqy\Integration\Events\Success;

use Illuminate\Queue\SerializesModels;

class SuccessfullyTakeUnitWeight
{
    use SerializesModels;

    /**
     * @var string
     */
    public $status = 'success';

    /**
     * @var string
     */
    public $client = 'scale';

    /**
     * @var mixed
     */
    public $request;

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
