<!-- Modal -->
<button type="button" class="btn-options" data-toggle="modal" data-target=".review{{$review->id}}"><img style="max-width: 20px;" src="https://i.ibb.co/5FSRq0Q/olho.png" alt=""></button>
<div class="modal fade review{{$review->id}}" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content px-5">
          <div class="modal-body">
                <div style="color: black;" class="border-bottom pb-3 border-light d-flex position-relative">
                    <button style="right: -50px;font-size: 18px;color: #A9A9A9;" data-dismiss="modal" class="btn position-absolute"><i class="bi bi-x-circle"></i></button>
                    <h1 style="font-size: 20px; font-weight: bold;" class="modal-title" id="staticBackdropLabel">
                        {{$review->order ? $review->order->package->service->name : ''}} - {{$review->user->name}}
                    </h1>
                </div>

                <h4 class="text-center mt-4">Overall Experience</h4>
                <div class="row justify-content-center">
                    <div class="col-12 col-12 d-flex justify-content-center">
                        <input class="rating text-center" min="{{$review->overall}}" max="{{$review->overall}}" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:{{$review->overall}}" type="range" value="{{$review->overall}}">
                    </div>
                    <span class="fw-semibold text-center mt-3" style="color: #A9A9A9;">(Overall, How satisfied are you with this service?)</span>

                    <div class="row col-12 mt-3 justify-content-between pb-3 text-left">
                        <div class="col-5">
                            <h4>Practitioner</h4>
                            <input class="rating text-center size-stars" min="{{$review->practitioner}}" max="{{$review->practitioner}}" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:{{$review->practitioner}}" type="range" value="{{$review->practitioner}}">
                        </div>
                        <div class="col-5 mb-4">
                            <h4>Service</h4>
                            <input class="rating text-center size-stars" min="{{$review->service}}" max="{{$review->service}}" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:{{$review->service}}" type="range" value="{{$review->service}}">
                        </div>
                        <div class="col-5 mb-4">
                            <h6 style="color: #A9A9A9;" class="fw-normal">Knowledge & Expertise</h6>
                            <input class="rating text-center size-stars" min="{{$review->practitioner_knowledge}}" max="{{$review->practitioner_knowledge}}" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:{{$review->practitioner_knowledge}}" type="range" value="{{$review->practitioner_knowledge}}">
                        </div>
                        <div class="col-5 mb-4">
                            <h6 style="color: #A9A9A9;" class="fw-normal">Quality</h6>
                            <input class="rating text-center size-stars" min="{{$review->service_quality}}" max="{{$review->service_quality}}" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:{{$review->service_quality}}" type="range" value="{{$review->service_quality}}">
                        </div>
                        <div class="col-5 mb-4">
                            <h6 style="color: #A9A9A9;" class="fw-normal">Communication</h6>
                            <input class="rating text-center size-stars" min="{{$review->practitioner_communication}}" max="{{$review->practitioner_communication}}" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:{{$review->practitioner_communication}}" type="range" value="{{$review->practitioner_communication}}">
                        </div>
                        <div class="col-5 mb-4">
                            <h6 style="color: #A9A9A9;" class="fw-normal">Value</h6>
                            <input class="rating text-center size-stars" min="{{$review->service_value}}" max="{{$review->service_value}}" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:{{$review->service_value}}" type="range" value="{{$review->service_value}}">
                        </div>
                        <div class="col-5 mb-4">
                            <h6 style="color: #A9A9A9;" class="fw-normal">Would recommend</h6>
                            <input class="rating text-center size-stars" min="{{$review->practitioner_recommend}}" max="{{$review->practitioner_recommend}}" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:{{$review->practitioner_recommend}}" type="range" value="{{$review->practitioner_recommend}}">
                        </div>
                        <div class="col-5 mb-4">
                            <h6 style="color: #A9A9A9;" class="fw-normal">Would buy again? / Would<br>
                                recommend to someone</h6>
                            <input class="rating text-center size-stars" min="{{$review->service_recommend}}" max="{{$review->service_recommend}}" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:{{$review->service_recommend}}" type="range" value="{{$review->service_recommend}}">
                        </div>
                        <div class="col-12">
                            <h5>{{$review->title}}</h5>
                            <p style="color: #A9A9A9;">{{$review->description}}</p>
                        </div>
                        <div class="col-12">
                            @if($review->photo)
                              <img src="{{ $review->photo ? asset('storage/' . $review->photo): '' }}" alt="" width="100%">
                            @endif
                            <form action="{{ route('review.status.update', $review->id) }}" class="mt-3" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary p-2 text-uppercase fw-bold px-4">{{ ($review->status == 0 ? 'Publish' : 'Unpublish') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
          </div>
      </div>
  </div>
</div>