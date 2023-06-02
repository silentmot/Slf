@extends('integration::layouts.master')

@section('content')
@include('integration::layouts.header')

<div class="row">
    <div class="col pl-0 pr-0 pt-3 mt-3 border-top">
        <div class="row">
            <div class="col-md-3 pl-0 pr-0 text-left"><a class="btn btn-primary" href="{{ route('log.index') }}">Back</a></div>
            <div class="col-md-9 pl-0 pr-0 text-right">
                @foreach($headers as $header)
                    @if($header->event_name == 'FailDisplayMessageOnScreen' || $header->event_name == 'SuccessfullyDisplayMessageOnScreen')
                        @continue
                    @endif

                    <a class="btn @if($header->status == 'success') btn-success @else btn-danger @endif" href="#">{{ $header->status }}</a>
                    @break
                @endforeach
                <a class="btn btn-info" href="#">{{ $current_log->log_id }}</a>
                @foreach($headers as $header)
                    @if($header->area)
                        <a class="btn btn-primary text-light" href="#">{{ Str::title(Str::snake($header->area, ' ')) }}</a>
                        @break
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <table class="table table-hover table-dark mt-3 mb-3 text-center ">
        <thead>
            <tr class="bg-secondary">
                <th scope="col">Action</th>
                <th scope="col">Provider</th>
                <th scope="col">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($headers as $header)
            <tr class=" @if($header->id == $tid) bg-white text-dark @elseif($header->status == 'success') btn-success text-light @else btn-danger @endif">
                <td><a class="@if($header->id == $tid) text-dark @else text-light @endif" href="{{ route('log.show', [$header->log_id, $header->id]) }}">{{ Str::title(Str::snake($header->event_name, ' ')) }}</a></td>
                <td>{{ $header->client }}</td>
                <td>{{ $header->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="clearfix"></div>

    @include('integration::request', ['info' => $current_log])
</div>
@endsection
