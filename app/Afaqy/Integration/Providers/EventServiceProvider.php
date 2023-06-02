<?php

namespace Afaqy\Integration\Providers;

use Afaqy\Integration\Listeners\StoreLog;
use Afaqy\Integration\Events\Fail\ServerError;
use Afaqy\Integration\Events\Fail\FailGetToken;
use Afaqy\Integration\Events\Fail\FailOpenGate;
use Afaqy\Integration\Listeners\StoreServerErrorLog;
use Afaqy\Integration\Events\Fail\FailTakeUnitWeight;
use Afaqy\Integration\Events\Fail\FailSendWeightToSlf;
use Afaqy\Integration\Events\Fail\FailGetCarInformation;
use Afaqy\Integration\Events\Fail\FailCreateTelnetSocket;
use Afaqy\Integration\Events\Success\SuccessfullyOpenGate;
use Afaqy\Integration\Events\Fail\FailSendGateOpenTimeToSlf;
use Afaqy\Integration\Events\Fail\FailDisplayMessageOnScreen;
use Afaqy\Integration\Events\Fail\AllEntranceDevicesAreOffline;
use Afaqy\Integration\Events\Success\SuccessfullyTakeUnitWeight;
use Afaqy\Integration\Events\Success\SuccessfullyReceiveSlfToken;
use Afaqy\Integration\Events\Success\SuccessfullySendWeightToSlf;
use Afaqy\Integration\Events\Fail\FailedHandleZkCarInformationRequest;
use Afaqy\Integration\Events\Success\SuccessfullyReceiveCarInformation;
use Afaqy\Integration\Events\Success\SuccessfullySendGateOpenTimeToSlf;
use Afaqy\Integration\Events\Success\SuccessfullyDisplayMessageOnScreen;
use Afaqy\Integration\Events\Success\SuccessfullyHandleZkCarInformationRequest;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Success
        SuccessfullyHandleZkCarInformationRequest::class => [
            StoreLog::class,
        ],
        SuccessfullyReceiveSlfToken::class               => [
            StoreLog::class,
        ],
        SuccessfullyReceiveCarInformation::class         => [
            StoreLog::class,
        ],
        SuccessfullyDisplayMessageOnScreen::class        => [
            StoreLog::class,
        ],
        SuccessfullyOpenGate::class                      => [
            StoreLog::class,
        ],
        SuccessfullySendGateOpenTimeToSlf::class         => [
            StoreLog::class,
        ],
        SuccessfullyTakeUnitWeight::class         => [
            StoreLog::class,
        ],
        SuccessfullySendWeightToSlf::class         => [
            StoreLog::class,
        ],

        // Fail
        ServerError::class                               => [
            StoreServerErrorLog::class,
        ],
        FailedHandleZkCarInformationRequest::class       => [
            StoreLog::class,
        ],
        FailGetToken::class                              => [
            StoreLog::class,
        ],
        FailGetCarInformation::class                     => [
            StoreLog::class,
        ],
        FailDisplayMessageOnScreen::class                => [
            StoreLog::class,
        ],
        FailOpenGate::class                              => [
            StoreLog::class,
        ],
        FailSendGateOpenTimeToSlf::class                 => [
            StoreLog::class,
        ],
        AllEntranceDevicesAreOffline::class                 => [
            StoreLog::class,
        ],
        FailCreateTelnetSocket::class                 => [
            StoreLog::class,
        ],
        FailTakeUnitWeight::class                 => [
            StoreLog::class,
        ],
        FailSendWeightToSlf::class                 => [
            StoreLog::class,
        ],
    ];
}
