@if(json_decode($info->request, true))
<div class="card w-100 mt-3 mb-3">
    <div class="card-header text-white bg-primary">
        Request
    </div>
    <div class="card-body text-white bg-dark">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @php $index = 1; @endphp
            @foreach(json_decode($info->request, true) as $key => $tab)
                <li class="nav-item">
                    <a class="nav-link @if($index == 1) active @endif" id="{{ $key }}-tab" data-toggle="tab" href="#{{ $key }}" role="tab" aria-controls="{{ $key }}" aria-selected="true">{{ $key }}</a>
                </li>
                @php $index++; @endphp
            @endforeach
        </ul>
        <div class="tab-content" id="myTabContent">
            @php $index = 1; @endphp
            @foreach(json_decode($info->request, true) as $key => $tab)
                <div class="tab-pane fade @if($index == 1) show active @endif" id="{{ $key }}" role="tabpanel" aria-labelledby="{{ $key }}-tab">
                   <div class="d-block">@php dump($tab) @endphp</div>
                </div>
                @php $index++; @endphp
            @endforeach
        </div>
    </div>
</div>
@endif

@if(json_decode($info->response, true))
<div class="card w-100 mt-3">
    <div class="card-header text-white bg-success">
        Response
    </div>
    <div class="card-body text-white bg-dark">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @php $index = 1; @endphp
            @foreach(json_decode($info->response, true) as $key => $tab)
                <li class="nav-item">
                    <a class="nav-link @if($index == 1) active @endif" id="{{ $key }}-res-tab" data-toggle="tab" href="#{{ $key }}-res" role="tab" aria-controls="{{ $key }}-res" aria-selected="true">{{ $key }}</a>
                </li>
                @php $index++; @endphp
            @endforeach
        </ul>
        <div class="tab-content" id="myTabContent">
            @php $index = 1; @endphp
            @foreach(json_decode($info->response, true) as $key => $tab)
                <div class="tab-pane fade @if($index == 1) show active @endif" id="{{ $key }}-res" role="tabpanel" aria-labelledby="{{ $key }}-res-tab">
                   <div class="d-block">@php dump($tab) @endphp</div>
                </div>
                @php $index++; @endphp
            @endforeach
        </div>
    </div>
</div>
@endif

@if(json_decode($info->data, true))
<div class="card w-100 mt-3">
    <div class="card-header text-white bg-success">
        Data
    </div>
    <div class="card-body text-white bg-dark">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @php $index = 1; @endphp
            @foreach(json_decode($info->data, true) as $key => $tab)
                <li class="nav-item">
                    <a class="nav-link @if($index == 1) active @endif" id="{{ $key }}-res-tab" data-toggle="tab" href="#{{ $key }}-res" role="tab" aria-controls="{{ $key }}-res" aria-selected="true">{{ $key }}</a>
                </li>
                @php $index++; @endphp
            @endforeach
        </ul>
        <div class="tab-content" id="myTabContent">
            @php $index = 1; @endphp
            @foreach(json_decode($info->data, true) as $key => $tab)
                <div class="tab-pane fade @if($index == 1) show active @endif" id="{{ $key }}-res" role="tabpanel" aria-labelledby="{{ $key }}-res-tab">
                   <div class="d-block">@php dump($tab) @endphp</div>
                </div>
                @php $index++; @endphp
            @endforeach
        </div>
    </div>
</div>
@endif
