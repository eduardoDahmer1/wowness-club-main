<!-- Modal -->
<div class="modal fade review-modal" id="review-{{$orderId}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content px-5">
          <div class="modal-body">
                <div style="color: black;" class="border-bottom pb-3 border-light">
                    <h1 style="font-size: 20px; font-weight: bold;" class="modal-title" id="staticBackdropLabel">
                            Create your review
                    </h1>
                </div>

                <h4 class="text-center mt-4">Overall Experience</h4>
                <form class="row justify-content-center" method="POST" action="{{ route('reviews.store', $order->id) }}" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="col-12 col-12 d-flex justify-content-center">
                        <input id="overall" class="rating text-center overall" value="0" name="overall" max="5" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.1" style="--value:" type="range">
                    </div>
                    <span class="fw-semibold text-center mt-3" style="color: #A9A9A9;">(Overall, How satisfied are you with this service?)</span>

                    <div class="row col-12 mt-3 justify-content-between">
                        <div class="col-5">
                            <h4>Practitioner</h4>
                            <input class="rating text-center size-stars" value="0" name="practitioner" max="5" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:0.5" type="range">
                        </div>
                        <div class="col-5 mb-4">
                            <h4>Service</h4>
                            <input class="rating text-center size-stars" value="0" name="service" max="5" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:0.5" type="range">
                        </div>
                        <div class="col-5 mb-4">
                            <h6 style="color: #A9A9A9;" class="fw-normal">Knowledge & Expertise</h6>
                            <input class="rating text-center size-stars" value="0" name="practitioner_knowledge" max="5" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:0.5" type="range">
                        </div>
                        <div class="col-5 mb-4">
                            <h6 style="color: #A9A9A9;" class="fw-normal">Quality</h6>
                            <input class="rating text-center size-stars" value="0" name="service_quality" max="5" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:0.5" type="range">
                        </div>
                        <div class="col-5 mb-4">
                            <h6 style="color: #A9A9A9;" class="fw-normal">Communication</h6>
                            <input class="rating text-center size-stars" value="0" name="practitioner_communication" max="5" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:0.5" type="range">
                        </div>
                        <div class="col-5 mb-4">
                            <h6 style="color: #A9A9A9;" class="fw-normal">Value</h6>
                            <input class="rating text-center size-stars" value="0" name="service_value" max="5" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:0.5" type="range">
                        </div>
                        <div class="col-5 mb-4">
                            <h6 style="color: #A9A9A9;" class="fw-normal">Would recommend</h6>
                            <input class="rating text-center size-stars" value="0" name="practitioner_recommend" max="5" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:0.5" type="range">
                        </div>
                        <div class="col-5 mb-4">
                            <h6 style="color: #A9A9A9;" class="fw-normal">Would buy again? / Would<br>
                                recommend to someone</h6>
                            <input class="rating text-center size-stars" value="0" name="service_recommend" max="5" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:0.5" type="range">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-7">
                            <h5>Add a headline</h5>
                            <input class="form-control" type="text" maxlength="255" name="title" id="">
                        </div>
                        <div class="col-5">
                            <h5>Add a photo</h5>
                            <input class="photo-modal col-2 w-100" type="file" name="photo" id="">
                        </div>

                        <div class="col-12">
                            <h5>Write your review</h5>
                            <textarea class="w-100 form-control" maxlength="10000" name="description" id="" cols="30" rows="10"
                            placeholder="What did you like the most? 
Is there anything you didn’t like or could be improved?"
                            ></textarea>
                        </div>
                        <div class="text-left col-12 mt-3">
                            <button class="btn_modal m-0 px-5 py-2 bg-none fw-semibold" type="submit">{{ __('Submit') }}</button>
                        </div>
                    </div>
                </form>
          </div>
      </div>
  </div>
</div>

<script>

    var ratingInputs = document.querySelectorAll('.rating');

    var currentValueInput = document.getElementById('currentValue');

    var soma = 0
    var practitioner = 0
    var service = 0
    var practitionerKnowledge = 0
    var serviceQuality = 0
    var practitionerCommunication = 0
    var serviceValue = 0
    var practitionerRecommend = 0
    var serviceRecommend = 0
    var overalls = document.querySelectorAll('.overall')

    ratingInputs.forEach(function(input) {
        var nameInput = input.getAttribute('name');

        input.addEventListener('input', function() {

            if(nameInput == 'practitioner') {
                practitioner = +input.value
            }
            if(nameInput == 'service') {
                service = +input.value
            }
            if(nameInput == 'practitioner_knowledge') {
                practitionerKnowledge = +input.value
            }
            if(nameInput == 'service_quality') {
                serviceQuality = +input.value
            }
            if(nameInput == 'practitioner_communication') {
                practitionerCommunication = +input.value
            }
            if(nameInput == 'service_value') {
                serviceValue = +input.value
            }
            if(nameInput == 'practitioner_recommend') {
                practitionerRecommend = +input.value
            }
            if(nameInput == 'service_recommend') {
                serviceRecommend = +input.value
            }
            
            soma = (practitioner + service + practitionerKnowledge + serviceQuality + practitionerCommunication + serviceValue + practitionerRecommend + serviceRecommend) / 8
            overalls.forEach(function(overall) {
                overall.setAttribute('value', soma);
                overall.style.setProperty('--value', soma);
            });
        });
    });
</script>