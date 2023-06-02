@extends('integration::layouts.master')

@section('content')
<div class="row">
    <div class="col-sm">{{--
        <div class="text-center">
            <img class="bg-light logo" src="en.svg">
        </div> --}}
        <div class="ascii-home">
            <pre>
               _______________                        _______________
              |  _SLF Client_ |                      |  ____SLF____  |
              | |           | |                      | |           | |
              | |   0   0   | |                      | |   0   0   | |
              | |     -     | |                      | |     -     | |
              | |   \___/   | |                      | |   \___/   | |
              | |___     ___| |                      | |___     ___| |
              |_____|\_/|_____|                      |_____|\_/|_____|
                |___|/ \|__|.....>>>............<<<.....|__|/ \|___|
               / ********** \                          / ********** \
             /  ************  \                      /  ************  \
            --------------------                    --------------------
            </pre>
        </div>
        <h1 class="text-center slf-home-header">Welcome To SLF Client</h1>
        <div class="text-center mt-5">
            <a class="btn btn-danger btn-lg" href="{{ route('live.errors') }}">See live error!</a>
        </div>
        <div class="text-center mt-5">
            <a class="btn btn-primary btn-lg" href="{{ route('log.index') }}">Enter To SLF Log Dashboard</a>
        </div>
    </div>
</div>
@endsection
