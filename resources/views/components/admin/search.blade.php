@props(['placeholder' => 'Search by name'])

<form method="GET">
    <input id="filter_name" name="q" type="text" class="form-control" placeholder="{{ $placeholder }}"
    value="{{ request('q', '') }}">
</form>
