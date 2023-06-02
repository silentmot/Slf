<?php

namespace Afaqy\Integration\DTO;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\FlexibleDataTransferObject;

class ZkCarInfoData extends FlexibleDataTransferObject
{
    /** @var string|null */
    public $car_number = null;

    /** @var int|null */
    public $card_number = null;

    /** @var int|null */
    public $qr_number = null;

    /** @var string|null */
    public $create_date = null;

    /** @var string|null */
    public $client_create_date = null;

    /** @var string|null */
    public $photo_path = null;

    /** @var int|null */
    public $channel_id = null;

    /** @var string|null */
    public $channel_name = null;

    /** @var string|null */
    public $device_type = null;

    /** @var string|null */
    public $device_ip = null;

    /** @var boolean|null */
    public $is_authorized = null;

    /** @var string|null */
    public $direction = null;

    /**
     * Prepare data transfer object for the given request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return self
     */
    public static function fromRequest(Request $request): self
    {
        return new self([
            "car_number"         => $request->car_number,
            "card_number"        => (int) $request->card_number,
            "qr_number"          => (int) $request->qr_number,
            "create_date"        => $request->create_date,
            "client_create_date" => Carbon::now()->toIso8601String(),
            "photo_path"         => $request->photo_path,
            "channel_id"         => (int) $request->channel_id,
            "channel_name"       => $request->channel_name,
            "device_type"        => $request->device_type,
            "device_ip"          => $request->device_ip,
            "is_authorized"      => $request->is_authorized,
            "direction"          => $request->direction,
        ]);
    }
}
