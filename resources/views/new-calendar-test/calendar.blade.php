@extends('new-calendar-test.app')

@section('content')
<div id="calendar"></div>

<div id="calendarModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalTitle" class="modal-title"></h5>
            </div>
            <div id="modalBody" class="modal-body">
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Custom Styles -->
<link rel="stylesheet" href="{{ asset('assets/css/new-calendar-test/app.css') }}">
@endpush

@push('scripts-head')
<!-- Custom Scripts for the head -->
<script type="module" src="{{ asset('assets/js/new-calendar-test/app.js') }}"></script>
@endpush