<?php

namespace Afaqy\Integration\Listeners;

use Afaqy\Integration\Models\Log;

class StoreServerErrorLog
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $request = [
            'url'     => $event->request->fullUrl(),
            'headers' => $event->request->header(),
            'type'    => $event->request->method(),
            'body'    => $event->request->all(),
        ];

        $exception = [
            'error_code'    => $event->exception->getCode(),
            'error_message' => $event->exception->getMessage(),
            'error_file'    => $event->exception->getFile(),
            'error_line'    => $event->exception->getLine(),
        ];

        Log::create([
            'client'     => 'server',
            'status'     => 'fail',
            'area'       => 'serverError',
            'feature'    => 1,
            'event_name' => (new \ReflectionClass($event))->getShortName(),
            'request'    => json_encode($request),
            'data'       => json_encode($exception),
        ]);
    }
}
