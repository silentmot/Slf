<?php

namespace Afaqy\Integration\Helpers;

class ID
{
    /**
     * @return int
     */
    public function generate()
    {
        return hexdec(uniqid());
    }
}
