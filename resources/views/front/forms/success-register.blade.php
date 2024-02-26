@section('title', 'Registration completed successfully! |')

<x-form-steps-layout>
    <div class="container-fluid">
        <div class="row row-height">
            <div class="col-lg-4 background-image p-0"
                data-background="url({{ asset('assets/images/bg-facilitator.png') }})">
            </div>
            <div class="col-lg-6 d-flex flex-column content-right">
                <div class="container my-auto py-5">
                    <div class="row">
                        <div class="col-lg-9 col-xl-7 mx-auto">
                            <div id="wizard_container">
                                <img src="{{ asset('assets/images/wownesslogocolorida.png') }}" alt="Logo Wowness Club"
                                    class="img-fluid px-4">
                                <div id="top-wizard">
                                    <span id="location"></span>
                                    <div id="progressbar"></div>
                                </div>
                                <!-- /top-wizard -->
                                <div class="step">
                                    <div class="summary">
                                        <div class="wrapper">
                                            <h3 class="wizard-header m-0">Thank you for signing up!</h3>
                                            <h5 style="padding-bottom: 2rem;color:#7D9A6F;padding-top: 2rem;font-weight:600;">Your Profile is Pending Approval
                                            </h5>
                                            <p>We will review your application and get in touch within up to 7 working days.
                                            </p>
                                            <p>Please keep an eye on your inbox/spam folder to find emails from us.</p>
                                            <p style="text-align:start;font-size:.9rem;">If you have any questions,
                                                feedback or require support, please email us at <a
                                                    href="mailto:support@wownessclub.com">info@wownessclub.com</a>
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /Wizard container -->
                        </div>
                    </div>
                </div>
                <div class="container pb-4 copy">
                    <span class="float-start">© Wowness Club</span>
                    <!--  <a class="btn_help float-end" href="#modal-help" id="modal_h"><i class="bi bi-question-circle"></i> Help</a><br> -->

                    <a class="btn_help float-end" href="https://practitioners-application.wownessclub.com/"><i
                            class="bi bi-question-circle"></i> {{ __('Help') }}</a><br>

                    <div class="social mobile ">
                        <ul>
                            <li><a href="https://www.facebook.com/wownessclub"><i class="bi bi-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/wownessclub/"><i class="bi bi-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /social -->
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</x-form-steps-layout>
