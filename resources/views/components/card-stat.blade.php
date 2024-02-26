@props([
    'title',
    'value' => 0,
    'icon' => 'person_pin',
    'percentage' => 0.00,
    'type' => 'simple'
])

@php
    $value = (float) $value;
    $percentage = (float) $percentage;
@endphp

<div class="card card-group-row__card card-body card-body-x-lg flex-row align-items-center">
    <div class="flex">
        <div class="card-header__title text-muted">{{ $title }}</div>
        <p class=" text-muted mb-2"><small>Compared to last month</small></p>
        <div class="text-amount">
            @if($type === 'simple')
                {{ $value }}
            @endif

            @if($type === 'money')
                &dollar;{{ number_format($value, 2) }}
            @endif
        </div>
        <div @class([
            'text-stats',
            'text-success' => $percentage >= 0,
            'text-danger' => $percentage < 0,
        ])>
            {{ abs($percentage) }}% <i class="material-icons">{{ ($percentage >= 0) ? 'arrow_upward' : 'arrow_downward' }}</i>
        </div>
    </div>
    <div><i class="material-icons icon-muted icon-40pt ml-3">{{ $icon }}</i></div>
</div>
