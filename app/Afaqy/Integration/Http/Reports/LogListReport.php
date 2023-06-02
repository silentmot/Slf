<?php

namespace Afaqy\Integration\Http\Reports;

use Illuminate\Http\Request;
use Afaqy\Integration\Models\Log;
use Illuminate\Support\Facades\DB;
use Afaqy\Core\Http\Reports\Report;
use Illuminate\Database\Eloquent\Builder;

class LogListReport extends Report
{
    /**
     * @var \Illuminate\Http\Request $request
     */
    private $request;

    /**
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function generate()
    {
        $logs = $this->query()->filter($this->request->all())->paginateFilter(25);

        return view('integration::index')->with(compact('logs'));
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
            DB::raw("(
                SELECT
                    `status`
                FROM `logs` AS `nlogs`
                WHERE
                    `logs`.`log_id` = `nlogs`.`log_id`
                    and `nlogs`.`event_name` not in('FailDisplayMessageOnScreen', 'SuccessfullyDisplayMessageOnScreen')
                    ORDER by `nlogs`.`id` desc
                    LIMIT 1
            ) as status"),
            'created_at',
        ])
            ->whereIn('id', function ($query) {
                $query->select(DB::raw("max(id)"))
                    ->from('logs', 'nlogs')
                    ->whereColumn('logs.log_id', 'nlogs.log_id')
                    ->groupBy('log_id');
            })
            ->orderBy('id', 'desc');
    }
}
