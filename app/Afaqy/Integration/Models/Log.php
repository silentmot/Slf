<?php

namespace Afaqy\Integration\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Afaqy\Integration\Models\Filters\LogFilter;

class Log extends Model
{
    use Filterable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'logs';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s.u';

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->log_id = resolve('ID');
        });
    }

    /**
     * Returns the ModelFilter for the current model.
     *
     * @return string
     */
    public function modelFilter()
    {
        return $this->provideFilter(LogFilter::class);
    }
}
