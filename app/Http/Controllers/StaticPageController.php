<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class StaticPageController extends Controller
{
    // Método para a página "Terms of Use"
    public function termsOfUse() {
        return view('front.terms.terms-of-use');
    }

    // Método para a página "Terms & Conditions Customers"
    public function termsAndConditionsCustomers() {
        return view('front.terms.terms-and-conditions-customers');
    }

    // Método para a página "Terms & Conditions Practitioners"
    public function termsAndConditionsPractitioners() {
        return view('front.terms.terms-and-conditions-practitioners');
    }

    // Método para a página "Cookie Policy"
    public function cookiePolicy() {
        return view('front.terms.cookie-policy');
    }

    // Método para a página "Privacy Policy"
    public function privacyPolicy() {
        return view('front.terms.privacy-policy');
    }

    // Método para a página "Acceptable Use Policy, Content Standards & Guidelines"
    public function acceptableUsePolicyContentStandardsGuidelines() {
        return view('front.terms.acceptable-use-policy-content-standards-guidelines');
    }
}
