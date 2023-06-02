<?php

namespace Afaqy\Integration\Models;

use Illuminate\Database\Eloquent\Model;

class SlfToken extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'slf_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['expires_in', 'expires_at', 'token_type', 'access_token'];
}
