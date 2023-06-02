<?php

namespace Afaqy\Integration\Http\Controllers;

use Illuminate\Http\Response;
use Afaqy\Core\Http\Controllers\Controller;
use Afaqy\Integration\Http\Reports\LogListReport;
use Afaqy\Integration\Http\Reports\LogShowReport;
use Afaqy\Integration\Http\Reports\LiveErrorsReport;
use Afaqy\Integration\Http\Requests\LogDashboardRequest;

class LogDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(LogDashboardRequest $request)
    {
        return (new LogListReport($request))->show();
    }

    /**
     * @param int $id
     * @param int $tid
     * @return Response
     */
    public function show($id, $tid)
    {
        return (new LogShowReport($id, $tid))->show();
    }

    /**
     * @return Response
     */
    public function liveErrors()
    {
        return (new LiveErrorsReport)->show();
    }
}
