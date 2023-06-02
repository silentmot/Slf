<?php

namespace Afaqy\Integration\Http\Reports;

use Afaqy\Integration\Models\Log;
use Afaqy\Core\Http\Reports\Report;
use Illuminate\Database\Eloquent\Builder;

class LogShowReport extends Report
{
    /**
     * @var int
     */
    private $log_id;

    /**
     * @var int
     */
    private $row_id;

    /**
     * @param int $log_id
     * @param int $row_id
     * @return void
     */
    public function __construct($log_id, $row_id)
    {
        $this->log_id = $log_id;
        $this->row_id = $row_id;
    }

    /**
     * @return mixed
     */
    public function generate()
    {
        $headers     = $this->query()->get();
        $current_log = Log::find($this->row_id);
        $tid         = $this->row_id;

        return view('integration::show')->with(compact('headers', 'current_log', 'tid'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(): Builder
    {
        return Log::where('log_id', $this->log_id)->orderBy('id', 'desc');
    }
}
