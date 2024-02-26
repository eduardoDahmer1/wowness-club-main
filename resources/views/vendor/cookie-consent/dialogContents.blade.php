@include('admin.scripts')
<div class="js-cookie-consent cookie-consent cookie-consent-modal">
    <div class="row justify-content-center">
    <div class="cookie-consent-modal-content px-1 col-lg-8 col-xl-6 col-md-10">
        <div class="message-container">
            <p class="text-center" style="font-size: 14px">
                Our website uses cookies. A cookie is a small file of letters and numbers that we put on your computer which are essential for the website to function properly and which help to provide you with a better online experience.<br>These cookies cannot be switched off and do not store any of your information.
            </p>
            <div class="button-container justify-content-center">
                <button
                    class="js-cookie-consent-agree cookie-consent__agree cursor-pointer flex items-center rounded-md text-sm font-medium hover:bg-blue-700">
                    {{ trans('cookie-consent::texts.agree') }}
                </button>
                <button class="js-cookie-consent-adjust cookie-consent__adjust cursor-pointer items-center display-inline rounded-md text-sm font-medium hover:bg-blue-700" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Preferences
                </button>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-cookie">
        <div class="modal-cookie header">
          <h4>Cookie settings</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-cookie d-block">
            <p>We use "analytical" cookies, which allow us to recognise and count the number of visitors and to see how visitors move around the site when they are using it.<br>
               Read more about the individual cookies we use, their duration and how to recognise them in our <a href="https://wownessclub.co.uk/cookie-and-privacy-policy">Cookie Policy</a>.</p>
            </p>
          </div>
        <div class="modal-cookie cookie-settings-modal-content">
                <div class="d-flex justify-content-between">
                    <h4>Strictly Necessary</h4>
                    <div class="form-check form-switch">
                        <input class="form-check-input border-0" type="checkbox" id="flexSwitchCheckDefault" disabled checked>
                      </div>                      
                </div>
                <p>These cookies are necessary for the website and can't be deactivated</p>
                <div class="d-flex justify-content-between">
                    <h4>Marketing & Analytics</h4>
                    <div class="form-check form-switch">
                        <input class="form-check-input border-0" type="checkbox" id="flexSwitchCheckDefault" name="marketing" @checked(true)>
                      </div>   
                </div>
                <p>We would like to use cookies for commercial and advertising messages tailored to your interests based on your browsing habits.
                   You can withdraw your consent at any time by contacting us at <a href="mailto:info@wownessclub.com">info@wownessclub.com</a>       
            <div>
          <button type="button" class="js-modal-cookie-consent-agree d-block btn btn-primary border-0 fw-bold" data-bs-dismiss="modal"> Accept all cookies</button>
          <button type="button" class="js-cookie-settings-save d-block btn btn-secondary shadow-none border-0 fw-bold" data-bs-dismiss="modal">Save Settings</button>
        </div>
      </div>
    </div>
  </div>

<script>
    window.addEventListener('load', function() {
        var modal = document.querySelector('.cookie-consent-modal');
        modal.style.display = 'block';

        function handleClick() {
            enableGoogleAnalyticsCookies();
            modal.style.display = 'none';
        }

        var agreeButton = document.querySelector('.js-cookie-consent-agree');
        agreeButton.addEventListener('click', handleClick);

        var modalAgreeButton = document.querySelector('.js-modal-cookie-consent-agree');
        modalAgreeButton.addEventListener('click', handleClick);

        var preferenceButton = document.querySelector('.js-cookie-consent-adjust');
        preferenceButton.addEventListener('click', function() {
            modal.style.display = 'none';
        });
        
        var saveButton = document.querySelector('.js-cookie-settings-save');
        saveButton.addEventListener('click', function() {
            var marketingCheckbox = document.querySelector('input[name="marketing"]');
            if (marketingCheckbox.checked) {
                enableGoogleAnalyticsCookies();
                window.laravelCookieConsent.consentWithCookies();
            }
        });

        });
</script>

<style>
    .header {
        border-bottom: none;
        display: flex;
        justify-content: space-between;
    }

    .btn-primary, .btn-secondary{
        width: 100%;
        margin-bottom: 10px;
    }
    .btn-primary{
        background-color: #7B9A6C;
    }
    .btn-secondary{
        background-color: hsla(0, 4%, 89%, 0.963);
        color: rgb(112, 111, 111);
    }
    .modal-cookie{
        background-color: #fff;
        padding: 15px;
        border-radius: 10px;
        pointer-events: auto;
    }
    .modal-cookie h4{
        font-weight: 500;
    }

    .modal-cookie p{
        font-size: 14px;
        color: #7f7f7f;
    }
    .modal-cookie button{
        margin-top: 10px;
    }
    .cookie-consent-modal {
        margin: 15px;
        right: 0;
        z-index: 9999;
        left: 0;
        bottom: 0;
        position: fixed;
    }

    .cookie-consent-modal-content {
        padding: 15px;
        background-color: rgba(250, 249, 249, 0.899);
        border-radius: 5px;
        display: flex;
        flex-direction: column;
        position: relative;
    }   

    .button-container {
        display: flex;
    }
    
    .cookie-consent__agree,
    .cookie-consent__adjust {
        background-color: #7B9A6C;
        color: white;
        padding: 5px 15px;
        border-radius: 10px;
        border: none;
        font-size: 14px;
        margin: 5px;
    }   

    .cookie-settings-modal {
        border-radius: 5px;
    }   

    .form-switch .form-check-input {
        width: 2.5em;
        height: 1.5em;
    }

    .form-switch .form-check-input:checked {
        background-color: #8EBF76;
    }

    .form-switch .form-check-input:checked:focus {
        box-shadow: rgba(0, 128, 0, 0.25);
    }
</style>
