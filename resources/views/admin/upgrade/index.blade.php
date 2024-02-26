<x-app-layout>
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Upgrade</li>
                        </ol>
                    </nav>
                    <h1 style="font-size: 30px;" class="m-0">Upgrade Plan</h1>
                </div>
            </div>
        </div>
        <div class="container-fluid page__container">
            <div class="row justify-content-center">
                <div class="col-lg-10 p-0">
                    <div class="text-center">
                        <i class="fas fa-crown" style="font-size: 3rem;padding-bottom: 1rem;color: #ffb300;"></i>
                        <h1 class="font-weight-bolder">Choose your plan!</h1>
                        <h5>You are on the
                            @if (Auth::user()->isPlanFoundingMember())
                            Founding Member
                            @elseif(Auth::user()->isPlanProfessional())
                            Professional
                            @elseif (Auth::user()->isPlanStandard())
                            Standard
                            @else
                            Starter
                            @endif
                            plan.
                        </h5>
                    </div>
                    <div class="p-4" style="letter-spacing: 1px;line-height: 23px;color: #333;">
                        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="monthly-tab" data-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="true">Monthly</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="yearly-tab" data-toggle="tab" href="#yearly" role="tab" aria-controls="yearly" aria-selected="false">Yearly</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
                                <div class="row pt-4 mt-4">
                                    <div class="col-md-4 p-0">
                                        <div class="box-card">
                                            <h3 class="py-2">Starter</h3>
                                            <p class="py-2">No risks. No monthly costs. Access subject to application approval.</p>
                                            <p class="price py-2"><span>£0</span>/per month</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4 p-0">
                                        <div class="box-card bg-green">
                                            <h3 class="py-2">Standard</h3>
                                            <p class="py-2">Payment only after the application has been approved.</p>
                                            <p class="price py-2"><span>£11</span>/per month</p>
                                            @if (Auth::user()->isPlanStandard())
                                            <a href="#" class="button-upgrade">You are already on this plan</a>
                                            @else
                                            <a target="_blank" href="https://buy.stripe.com/7sI144dVT2uob8k4gi" class="button-upgrade">Apply Now</a>
                                            @endif
                                            <p class="py-2">Cancel Anytime.</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4 p-0">
                                        <div class="box-card">
                                            <h3 class="py-2">Professional</h3>
                                            <p class="py-2">Established professionals with a high volume of sales (services/retreats/content)</p>
                                            <p class="price py-2"><span>£19</span>/per year</p>
                                            @if (Auth::user()->isPlanFoundingMember())
                                            <a href="#" class="button-upgrade">You are already on this plan</a>
                                            @else
                                            <a target="_blank" href="https://calendly.com/wowness-club/wowness-club-sign-up" class="button-upgrade">Contact Us</a>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="yearly" role="tabpanel" aria-labelledby="yearly-tab">
                            <div class="row pt-4 mt-4">
                                    <div class="col-md-4 p-0">
                                        <div class="box-card">
                                            <h3 class="py-2">Starter</h3>
                                            <p class="py-2">No risks. No monthly costs. Access subject to application approval.</p>
                                            <p class="price py-2"><span>£0</span>/per year</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4 p-0">
                                        <div class="box-card bg-green">
                                            <h3 class="py-2">Standard</h3>
                                            <p class="py-2">Payment only after the application has been approved.</p>
                                            <p class="price py-2"><span>£110</span>/per year</p>
                                            @if (Auth::user()->isPlanStandard())
                                            <a href="#" class="button-upgrade">You are already on this plan</a>
                                            @else
                                            <a target="_blank" href="https://buy.stripe.com/14k9AA197b0U1xKfZ1  " class="button-upgrade">Apply Now</a>
                                            @endif
                                            <p class="py-2">Cancel Anytime.</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4 p-0">
                                        <div class="box-card">
                                            <h3 class="py-2">Professional</h3>
                                            <p class="py-2">Established professionals with a high volume of sales (services/retreats/content)</p>
                                            <p class="price py-2"><span>£190</span>/per year</p>
                                            @if (Auth::user()->isPlanFoundingMember())
                                            <a href="#" class="button-upgrade">You are already on this plan</a>
                                            @else
                                            <a target="_blank" href="https://calendly.com/wowness-club/wowness-club-sign-up" class="button-upgrade">Contact Us</a>
                                            @endif

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tables">
                            <div class="py-3">
                                <div style="border-radius: 10px;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;"></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;">Starter</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;">Standard</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;">Professional</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h4 style="font-weight:bold;color:#222;padding-left:20px;">Wowness Club Commission</h4>
                                <div style="border-radius: 10px; background-color:#fff;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Services, Events & Retreats</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;">15%</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;">10%</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;">5%</td>
                                            </tr>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Content</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;">10%</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;">10%</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;">5%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Services -->
                            <div class="py-3">
                                <h4 style="font-weight:bold;color:#222;padding-left:20px;">Services</h4>
                                <div style="border-radius: 10px; background-color:#fff;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Unlimited Group Listing</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="border-radius: 10px;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Unlimited Retreats</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="border-radius: 10px; background-color:#fff;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Unlimited Individual Session</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- End Services -->

                            <!-- Community -->
                            <div class="py-3">
                                <h4 style="font-weight:bold;color:#222;padding-left:20px;">Community Features</h4>
                                <div style="border-radius: 10px; background-color:#fff;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Post Starter Content</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-times" style="color: #df1f1f;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="border-radius: 10px;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Post Paid Content</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-times" style="color: #df1f1f;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div style="border-radius: 10px; background-color:#fff;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Post Online Courses (Starter or Paid)</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-times" style="color: #df1f1f;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div style="border-radius: 10px;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Share your social media and website</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-times" style="color: #df1f1f;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div style="border-radius: 10px; background-color:#fff;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Build Followers</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-times" style="color: #df1f1f;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div style="border-radius: 10px;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Customer Chat</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-times" style="color: #df1f1f;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- End Community -->

                            <!-- Management -->
                            <div class="py-3">
                                <h4 style="font-weight:bold;color:#222;padding-left:20px;">Management</h4>
                                <div style="border-radius: 10px; background-color:#fff;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Analytics & Performance Dashboard</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-times" style="color: #df1f1f;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="border-radius: 10px;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Booking Management (For individual sessions)</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div style="border-radius: 10px; background-color:#fff;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Verified Reviews</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- End Management -->
                            <!-- Add-ons -->
                            <div class="py-3">
                                <h4 style="font-weight:bold;color:#222;padding-left:20px;">Add-ons</h4>
                                <div style="border-radius: 10px; background-color:#fff;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Notify followers when service/content is uploaded</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-times" style="color: #df1f1f;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="border-radius: 10px;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Be listed on directory practitioner's page</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-times" style="color: #df1f1f;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- End Add-ons -->
                            <!-- Suport -->
                            <div class="py-3">
                                <h4 style="font-weight:bold;color:#222;padding-left:20px;">Support</h4>
                                <div style="border-radius: 10px; background-color:#fff;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Onboarding Call</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-times" style="color: #df1f1f;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="border-radius: 10px;">
                                    <table style="width: 100%; font-size: 0.8rem;">
                                        <tbody>
                                            <tr style="font-weight:bold;">
                                                <td style="width: 400px;padding: 20px;">Weekly Support Group Calls</td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                                <td style="text-align:center;padding: 20px;width: 20%;"><i class="fas fa-check-circle" style="color: #7b9a6c;"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- End Management -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    [dir="ltr"] .nav-tabs .nav-link.active, [dir="ltr"] .nav-tabs .nav-item.show .nav-link {
        background-color: #7b9a6c;
        border-radius: 5px;
        color: #fff;
    }
    [dir="ltr"] .nav-tabs .nav-link {
        background-color: #d7d7d7;
        border-radius: 5px;
        color: #888;
    }
    .box-card {
        text-align: center;
        background-color: #e8e8e8;
        padding: 3rem 1rem;
        border-radius: 20px;
        height:100%;
    }

    .box-card h3 {
        font-weight: bold;
        color: #333;
    }

    .box-card.bg-green {
        background-color:#7b9a6c;
        color: #fff;
    }

    .box-card.bg-green h3 {
        color: #fff;
    }

    .box-card .price span {
        font-size: 2.5rem;
        font-weight: bold;
    }
    .button-upgrade {
        border-radius: 15px;
        box-shadow: 0 5px 4px #13131354;
        padding: 10px 25px;
        margin: 0 0 1rem;
        display: inline-block;
        color: #fff !important;
        font-weight: bold;
        background-color: #7b9a6c !important;
    }

    .tables {
        padding: 2rem 0;
    }

</style>
