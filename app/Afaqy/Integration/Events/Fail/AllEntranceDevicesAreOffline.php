<?php

namespace Afaqy\Integration\Events\Fail;

use Illuminate\Queue\SerializesModels;

class AllEntranceDevicesAreOffline
{
    use SerializesModels;

    /**
     * @var string
     */
    public $status = 'fail';

    /**
     * @var string
     */
    public $client = 'zk';

    /**
     * @var mixed
     */
    public $data;

    /**
     * @param mixed  $data
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
}
