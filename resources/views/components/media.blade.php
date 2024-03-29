{{-- The props array will hold the attributes passed to the component --}}
@props([
'src' => '',
    'alt' => '',
    'class' => '',
    'style' => '',
])

{{-- The HTML for the image --}}
<img src="{{ $src }}"  loading="lazy"
     alt="{{ $alt }}" {{ $class ? 'class="'.  $class .'"' : '' }} {{ $style ? 'style="'.  $style .'"' : '' }}>
