<div class="card w-100 mt-3 mb-3">
    <div class="card-header text-white bg-primary">
        Data
    </div>
    <div class="card-body text-white bg-dark">
        @php dump(json_decode($info->data, true)) @endphp
    </div>
</div>
