@extends('integration::layouts.master')

@section('meta')
    <meta http-equiv="refresh" content="60">
@endsection

@section('title')
    SLF Client Logs
@endsection

@section('content')
@include('integration::layouts.header')

<div class="row">
    <div class="col-sm">
        <form class="form-inline" method="get" action="{{ route('log.index') }}">
            <div class="form-group mx-sm-3 mt-4 mb-2">
                <label for="plate" class="sr-only">Unit Identifier</label>
                <input type="text" value="{{ request()->unit_identifier }}" name="unit_identifier" class="form-control" id="plate" placeholder="Unit Identifier">
            </div>
            <div class="form-group mx-sm-3 mt-4 mb-2">
                <label for="date" class="sr-only">Date</label>
                <input type="date" name="date" value="{{ request()->date }}"  class="form-control" id="date" placeholder="date">
            </div>
            <select class="form-control mx-sm-3 mt-4 mb-2" name="status">
                <option value="" disabled selected>Status...</option>
                <option value="success" @if(request()->status == 'success') selected @endif>Success</option>
                <option value="fail" @if(request()->status == 'fail') selected @endif>Fail</option>
            </select>
            <button type="submit" class="btn btn-primary mt-4 mb-2">Search</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-sm p-0 mt-2">
    @if ($errors->any())
        <div class="d-block p-2 bg-danger text-white">
            <ul class="list-unstyled mb-0">
                @foreach ($errors->all() as $error)
                    <li class="mb-2"> * {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>
</div>
<div class="row">
    <table class="table table-hover table-dark mt-3 mb-3 text-center">
        <thead>
            <tr class="bg-secondary">
                <th scope="col">#ID</th>
                <th scope="col">Unit Identifier</th>
                <th scope="col">Status</th>
                <th scope="col">Area</th>
                <th scope="col">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr class="@if($log->area == 'serverError') bg-danger text-light @endif">
                <th scope="row"><a class="@if($log->area == 'serverError') text-light @endif" href="{{ route('log.show', [$log->log_id, $log->id]) }}">{{ $log->log_id }}</a></th>
                <td>{{ $log->unit_identifier }}</td>
                <td class="
                    @if($log->status == 'fail' && $log->area != 'serverError')
                        bg-danger
                    @elseif($log->status == 'success' && $log->area != 'serverError')
                        bg-success
                    @endif
                ">{{ $log->status }}</td>
                <td>{{ Str::title(Str::snake( $log->area, ' ')) }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $logs->links() }}
@endsection
