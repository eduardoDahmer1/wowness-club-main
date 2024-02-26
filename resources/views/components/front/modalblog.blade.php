@props(['post'])
@if($post->video)       
<div style="overflow: hidden;" class="modal fade z-index" id="exampleModal-{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div style="top: 0; max-width: 100%; height:100%;" class="modal-dialog modal-lg row align-items-center">
        <div style="background: none;" class="modal-content video-blog">
            <div class="modal-header border-0 max-w px-0">
            <button type="button" class="btn-style" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
            </div>
            <iframe class="col-xxl-6" width="100%" height="100%" src="{{$post->video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>
</div>
@endif