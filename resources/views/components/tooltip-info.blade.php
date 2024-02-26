@props(['info','id'])

<a data-toggle="collapse" href="#{{ $id }}" role="button" aria-expanded="false" aria-controls="{{ $id }}" style="color:#6f6f6f;">
    <i class="material-icons">info</i>
</a>

<div class="collapse" id="{{ $id }}">
    <div class="accordionInfo">
      {{ $info }}
    </div>
</div>