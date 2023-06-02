<?php

namespace Afaqy\Integration\Listeners;

use Afaqy\Integration\Models\Log;
use Afaqy\Integration\Facades\Tracer;

class StoreLog
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (isset($event->request) && is_object($event->request)) {
            $request = [
                'url'     => $event->request->fullUrl(),
                'headers' => $event->request->header(),
                'type'    => $event->request->method(),
                'body'    => $event->request->all(),
            ];
        }

        if (isset($event->response) && is_object($event->response)) {
            $response = [
                'status'  => $event->response->status(),
                'headers' => $event->response->getHeaders(),
                'body'    => $event->response->json(),
            ];
        }

        $request  = $request ?? $event->request ?? [];
        $response = $response ?? $event->response ?? [];
        $data     = $event->data ?? [];

        Log::create([
            'client'          => $event->client,
            'unit_identifier' => Tracer::getUnitIdentifier(),
            'status'          => $event->status,
            'area'            => Tracer::getArea(),
            'feature'         => $event->feature ?? 0,
            'event_name'      => (new \ReflectionClass($event))->getShortName(),
            'request'         => json_encode((array) $request),
            'response'        => json_encode((array) $response),
            'data'            => json_encode((array) $data),
        ]);
    }
}
