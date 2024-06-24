@props(['employer', 'width' => 90])

@php
    $logoPath = $employer->logo;
    $isUrl = filter_var($logoPath, FILTER_VALIDATE_URL) !== false;
@endphp

@if ($isUrl)
    <img src="{{ $logoPath }}" alt="Employer Logo" class="rounded-xl" width="{{ $width }}">
@else
    <img src="{{ asset('storage/' . $logoPath) }}" alt="Employer Logo" class="rounded-xl" width="{{ $width }}">
@endif
