<?php

namespace Afaqy\Integration\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Afaqy\Integration\Models\RequestChecker;
use Afaqy\Core\Http\Responses\ResponseBuilder;

class NotSameRequest
{
    use ResponseBuilder;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $data = json_encode($request->except('create_date'));

        $last_request = RequestChecker::where('data', $data)->orderBy('id', 'desc')->first();

        if ($last_request) {
            $created_at = Carbon::parse($last_request->created_at);

            if ($created_at->diffInMinutes(Carbon::now()) < config('slf.trivial_time_amount')) {
                return $this->returnBadRequest(null, 'We handled this request before!');
            }

            $last_request->delete();
        }

        RequestChecker::create([
            'data' => $data,
        ]);

        return $next($request);
    }
}
