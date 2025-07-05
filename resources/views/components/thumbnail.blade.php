@php
    if ($type === 'shops') {
        $path = 'storage/shops/';
    }
    if ($type === 'products') {
        $path = 'storage/products/';
    }
@endphp


@php
    // ...
@endphp

<div class="h-full">
    @if (empty($filename))
        <img src="{{ asset('images/no_image.jpg') }}" class="w-full h-full object-cover">
    @else
        <img src="{{ asset($path . $filename) }}" class="w-full h-full object-cover">
    @endif
</div>
