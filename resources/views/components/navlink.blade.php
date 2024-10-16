@props(['active' => false])

<a {{ $attributes }} class={{ $active ? "active" : "inactive" }}>[{{$slot}}]</a>
