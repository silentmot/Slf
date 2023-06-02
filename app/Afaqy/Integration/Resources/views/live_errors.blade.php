@extends('integration::layouts.master')

@section('meta')
    <meta http-equiv="refresh" content="5">
@endsection

@section('title')
    SLF Live Errors Watcher
@endsection


@section('content')
@include('integration::layouts.header-live-error')

<table class="table table-hover table-dark mt-3 mb-3 text-center">
    <thead>
        <tr class="bg-secondary">
            <th scope="col">Car Identifier</th>
            <th scope="col">Error</th>
            <th scope="col">Area</th>
            <th scope="col">Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach($errors as $error)
        <tr>
            <th>{{ $error->unit_identifier }}</th>
            <td><a href="{{ route('log.show', [$error->log_id, $error->id]) }}">{{ Str::title(Str::snake($error->event_name, ' ')) }}</a></td>
            <td>{{ Str::title(Str::snake($error->area, ' ')) }}</td>
            <td>{{ $error->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
