@props([
    "bootstrapIcon" => null,
    "url" => null,
    "label" => null,
])

<div class="d-flex flex-column  align-items-center ">
    <i class="text-white p-0 fs-2 bi {{ $bootstrapIcon }}"></i>
    <a style="font-size: .8rem" class="nav-link text-white p-0" href="{{ $url }}">{{ $label }}</a>
</div>
