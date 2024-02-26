<x-default-layout>
    @include('front.layouts.headermain')
    <section class="init-banner">
        <div class="container" style="position:relative;">
            <div class="d-flex justify-content-center">
                <div class="meta">
                    <div class="box-home-title">
                        <h3 class="show">Cookie Policy</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container section-conteudo">
        <p>Our website uses cookies to distinguish you from other users of our website. This helps us to
            provide you with a good experience when you browse our website and also allows us to improve our website.
        </p>
        <p>A cookie is a small file of letters and numbers that we store on your browser or the hard drive of
            your computer if you agree. Cookies contain information that is transferred to your computer's hard drive.
        </p>
        <p>We use the following cookies:</p>
        <p><strong>Strictly necessary cookies.</strong> These are cookies that are required for the operation
            of our website. They include, for example, cookies that enable you to log into secure areas of our website,
            use a shopping cart or make use of e-billing services.</p>
        <p><strong>Analytical or performance cookies.</strong> These allow us to recognise and count the
            number of visitors and to see how visitors move around our website when they are using it. This helps us to
            improve the way our website works, for example, by ensuring that users are finding what they are looking for
            easily.</p>
        <p><strong>Functionality cookies.</strong> These are used to recognise you when you return to our
            website. This enables us to personalise our content for you, greet you by name and remember your preferences
            (for example, your choice of language or region).</p>
        <p><strong>Targeting cookies.</strong> These cookies record your visit to our website, the pages you
            have visited and the links you have followed. We will use this information to make our website and the
            advertising displayed on it more relevant to your interests. We may also share this information with third
            parties for this purpose.</p>
        <p>You can find more information about the individual cookies we use and the purposes for which we
            use them in the table below:</p>
        <table cellspacing="0" cellpadding="0" style="border: 1px solid #000; padding: 10px;">
            <tbody>
                <tr>
                    <td valign="middle" style="border: 1px solid #000; padding: 10px;">
                        <p><strong>Cookie Title</strong></p>
                        <p><strong>Cookie Name</strong></p>
                    </td>
                    <td valign="middle" style="border: 1px solid #000; padding: 10px;">
                        <p><strong>Purpose</strong></p>
                    </td>
                    <td valign="middle" style="border: 1px solid #000; padding: 10px;">
                        <p><strong>More information</strong></p>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" style="border: 1px solid #000; padding: 10px;">
                        <p><a href="{{ route('privacy.policy') }}">COOKIE TITLE</a></p>
                        <p><a href="{{ route('privacy.policy') }}">COOKIE NAME</a></p>
                    </td>
                    <td valign="middle" style="border: 1px solid #000; padding: 10px;">
                        <p><a href="{{ route('privacy.policy') }}#purposes">DESCRIPTION OF THE PURPOSE FOR WHICH THE COOKIE IS
                                USED AND ITS DURATION</a></p>
                        <p>Examples of purposes for which a cookie may be used:</p>
                        <a href="{{ route('privacy.policy') }}#purposes"><p>This cookie is essential for our website to
                                <strong>OR</strong> enables us
                                to</a>:
                        </p>
                        <p>(a) Estimate our audience size and usage pattern.</p>
                        <p>(b) Store information about your preferences, and so allow us to customise our
                            website and to provide you with offers that are targeted to your individual interests.</p>
                        <p>(c) Speed up your searches.</p>
                        <p>(d) Recognise you when you return to our website.</p>
                        <p>(e) Allow you to use our website in a way that makes your browsing experience
                            more convenient, for example, by allowing you to store items in an electronic shopping
                            basket between visits. If you register with us or complete our online forms, we will use
                            cookies to remember your details during your current visit, and any future visits provided
                            the cookie was not deleted in the interim.</p>
                        <p>(f) <a href="{{ route('privacy.policy') }}#purposes">OTHER PURPOSES</a>.</p>
                    </td>
                    <td valign="middle" style="border: 1px solid #000; padding: 10px;">
                        <p><a href="{{ route('privacy.policy') }}">LINK TO EXTERNAL INFORMATION WHERE APPROPRIATE</a>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p>Please note that the following third parties may also use cookies, over which we have no control.
            These named third parties may include, for example, advertising networks and providers of external services
            like web traffic analysis services. These third party cookies are likely to be analytical cookies or
            performance cookies or targeting cookies:</p>
        <p><a href="{{ route('privacy.policy') }}">NAME THIRD PARTIES</a></p>
        <p>To deactivate the use of third party advertising cookies, you may visit the consumer page to
            manage the use of these types of cookies <a href="{{ route('privacy.policy') }}">include link to consent
                management solution</a>.</p>
        <p><strong>OR</strong></p>
        <p><a href="{{ route('privacy.policy') }}">We do not share the information collected by the cookies with any
                third parties.</a></p>
        <p>You can choose which analytical, functionality and targeting cookies we can set by clicking on the
            button(s):</p>
        <p>Strictly essential cookies <strong>OFF</strong></p>
        <p>Analytical or performance cookies <strong>OFF</strong></p>
        <p>Functionality cookies <strong>OFF</strong></p>
        <p>Targeting cookies <strong>OFF</strong></p>
        <p>However, if you use your browser settings to block all cookies (including essential cookies) you
            may not be able to access all or parts of our website.</p>
        <p>Except for essential <a href="{{ route('cookie.policy') }}">cookies</a>, all cookies will expire after 6
            months.</p>
        <p>&nbsp;</p>

    </section>

</x-default-layout>
<style>
    html {
    scroll-behavior: smooth;
}
body {
    background: white;
    overflow-x: hidden;
}

footer {
    background-color: #fff;
    position: relative !important;
    width: 100vw !important;
    color: #333;
    border-top: 1px solid #0000000f;
}

.section-conteudo {
    background: transparent;
    position: relative;
    margin-bottom: 0 !important;
}

.titulo-termos {
    text-align: center;
}
</style>
