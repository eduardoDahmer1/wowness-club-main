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
                                            <h3 class="wizard-header m-0">
                                                Your account has been created successfully!</h3>
                                            <h5 style="padding-top: 26px; color:#7D9A6F;font-weight:600;">Your Profile is Created
                                            </h5>
                                            <p>Please check your inbox and confirm your email.</p>
                                            <p>If you have not received the confirmation email, click the button below to resend!</p>
                                            <div class="mt-4 flex items-center justify-between">
                                                <form method="POST" action="{{ route('verification.send') }}">
                                                    @csrf

                                                    <div>
                                                        <x-primary-button>
                                                            {{ __('Resend Verification Email') }}
                                                        </x-primary-button>
                                                    </div>
                                                </form>
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
                        <a class="btn_help float-end" href="https://practitioners-application.wownessclub.com/"><i
                                class="bi bi-question-circle"></i> {{ __('Help') }}</a><br>
                        <div class="social mobile ">
                            <ul>
                                <li><a href="https://www.facebook.com/wownessclub"><i class="bi bi-facebook"></i></a>
                                </li>
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
