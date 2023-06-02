<?php

namespace Afaqy\Integration\Console;

use Carbon\Carbon;
use Afaqy\Integration\Models\Log;

class DeleteLogOlderThanTenDays
{
    public function __invoke()
    {
        Log::where('created_at', '<=', Carbon::today()->sub(10, 'days'))->delete();
    }
}
