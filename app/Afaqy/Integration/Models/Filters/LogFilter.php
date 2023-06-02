<?php

namespace Afaqy\Integration\Models\Filters;

use Illuminate\Support\Facades\DB;
use Afaqy\Core\Models\Filters\ModelFilter;

class LogFilter extends ModelFilter
{
    /**
     * @param  string $status
     * @return UnitFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function status(string $status)
    {
        return $this->where('status', $status);
    }

    /**
     * @param  string $unit_identifier
     * @return UnitFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function unitIdentifier(string $unit_identifier)
    {
        return $this->where('unit_identifier', $unit_identifier);
    }

    /**
     * @param  string $created_at
     * @return UnitFilter|\Illuminate\Database\Eloquent\Builder
     */
    public function date(string $created_at)
    {
        return $this->where(DB::raw('date(created_at)'), $created_at);
    }
}
