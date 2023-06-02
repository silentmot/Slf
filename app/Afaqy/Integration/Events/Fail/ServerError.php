<?php

namespace Afaqy\Integration\Events\Fail;

use Illuminate\Queue\SerializesModels;

class ServerError
{
    use SerializesModels;

    /**
     * @var mixed
     */
    public $request;

    /**
     * @var \Exception
     */
    public $exception;

    /**
     * @param mixed $request
     * @param \Exception $exception
     * @return void
     */
    public function __construct($request, $exception)
    {
        $this->request   = $request;
        $this->exception = $exception;
    }
}
