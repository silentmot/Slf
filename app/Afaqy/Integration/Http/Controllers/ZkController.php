<?php

namespace Afaqy\Integration\Http\Controllers;

use Illuminate\Http\Response;
use Afaqy\Integration\Facades\Tracer;
use Afaqy\Integration\DTO\ZkCarInfoData;
use Afaqy\Core\Http\Controllers\Controller;
use Afaqy\Core\Http\Responses\ResponseBuilder;
use Afaqy\Integration\Http\Requests\ZkCarInfoRequest;
use Afaqy\Integration\Http\Requests\ZkDeviceStatusRequest;
use Afaqy\Integration\Actions\Aggregators\HandleZkCarInformationAggregator;

class ZkController extends Controller
{
    use ResponseBuilder;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function carInformation(ZkCarInfoRequest $request)
    {
        $dto = ZkCarInfoData::fromRequest($request);

        $result = (new HandleZkCarInformationAggregator($dto))->execute();

        if ($result) {
            return $this->returnSuccess('Success operation.', []);
        }

        return $this->returnBadRequest(Tracer::getErrorCode(), 'Operation failed!', []);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function deviceStatus(ZkDeviceStatusRequest $request)
    {
        return $this->returnSuccess('Status stored successfully.');
    }
}
