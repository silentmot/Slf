<?php

namespace Afaqy\Integration\Console;

use Illuminate\Support\Facades\DB;

class TruncateRequestLogTable
{
    public function __invoke()
    {
        DB::table('requests_checker')->truncate();
    }
}
