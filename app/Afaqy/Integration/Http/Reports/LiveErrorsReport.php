<?php

namespace Afaqy\Integration\Http\Reports;

use Carbon\Carbon;
use Afaqy\Integration\Models\Log;
use Illuminate\Support\Facades\DB;
use Afaqy\Core\Http\Reports\Report;
use Illuminate\Database\Eloquent\Builder;

class LiveErrorsReport extends Report
{
    /**
     * @return mixed
     */
    public function generate()
    {
        $errors = $this->query()->get();

        return view('integration::live_errors')->with(compact('errors'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(): Builder
    {
        return Log::select([
            'id',
            'log_id',
            'unit_identifier',
            DB::raw("(
                SELECT
                    `area`
                FROM `logs` AS `nlogs`
                WHERE
                    `logs`.`log_id` = `nlogs`.`log_id`
                    and `nlogs`.`area` is not null
                    ORDER by `nlogs`.`id` desc
                    LIMIT 1
            ) as area"),
            'event_name',
            'created_at',
        ])
            ->whereIn('id', function ($query) {
                $start = Carbon::today()->startOfDay()->toDateTimeString('millisecond');
                $end   = Carbon::today()->endOfDay()->toDateTimeString('millisecond');

                $query->select(DB::raw("max(id)"))
                    ->from('logs')
                    ->groupBy('log_id')
                    ->whereRaw("created_at between '${start}' and '${end}' and status = 'fail' and event_name != 'ServerError'");
            })
            ->limit(100)
            ->orderBy('id', 'desc');
    }
}
