@section('title', 'Your orders |')
<x-default-layout>
    @include('front.layouts.headersearch')
    <main>

        <section class="container">
            <div style="padding-bottom: 100px;" class="row justify-content-center">

                    <div class="breadcrumb px-2">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li>></li>
                            <li><a href="{{ route('orders.indexSeeker') }}" class="active">{{ auth()->user()->name}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="row">
                            <div id="bgMedia" style="background: url('{{ asset('storage/' . auth()->user()->photo) }}') center center;
                                background-size: cover;
                                background-repeat: no-repeat;
                                border-radius: 10px;"
                                class="col-md-2 col-12 shadow">
                            </div>

                            <div class="col-md-10 col-12">

                                <div class="bg-white row p-3 rounded">

                                    <div class="col-12 col-md-6">

                                        {{-- nome --}}
                                        <div class="fs-media orders-info">
                                            <span>Full Name:</span>
                                            <p>{{ auth()->user()->name }}</p>
                                        </div>

                                        {{-- registred --}}
                                        <div class="orders-info">
                                            <span>Registred:</span>
                                            <div class="fs-media d-flex">
                                                <svg class="mt-1" width="18" height="18" viewBox="0 0 16 16"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.33333 14.6667C2.96667 14.6667 2.65267 14.5363 2.39133 14.2754C2.13044 14.014 2 13.7 2 13.3334V4.00004C2 3.63337 2.13044 3.3196 2.39133 3.05871C2.65267 2.79737 2.96667 2.66671 3.33333 2.66671H4V1.33337H5.33333V2.66671H10.6667V1.33337H12V2.66671H12.6667C13.0333 2.66671 13.3473 2.79737 13.6087 3.05871C13.8696 3.3196 14 3.63337 14 4.00004V13.3334C14 13.7 13.8696 14.014 13.6087 14.2754C13.3473 14.5363 13.0333 14.6667 12.6667 14.6667H3.33333ZM3.33333 13.3334H12.6667V6.66671H3.33333V13.3334ZM3.33333 5.33337H12.6667V4.00004H3.33333V5.33337ZM8 9.33337C7.81111 9.33337 7.65289 9.26937 7.52533 9.14137C7.39733 9.01382 7.33333 8.8556 7.33333 8.66671C7.33333 8.47782 7.39733 8.31937 7.52533 8.19137C7.65289 8.06382 7.81111 8.00004 8 8.00004C8.18889 8.00004 8.34733 8.06382 8.47533 8.19137C8.60289 8.31937 8.66667 8.47782 8.66667 8.66671C8.66667 8.8556 8.60289 9.01382 8.47533 9.14137C8.34733 9.26937 8.18889 9.33337 8 9.33337ZM5.33333 9.33337C5.14444 9.33337 4.986 9.26937 4.858 9.14137C4.73044 9.01382 4.66667 8.8556 4.66667 8.66671C4.66667 8.47782 4.73044 8.31937 4.858 8.19137C4.986 8.06382 5.14444 8.00004 5.33333 8.00004C5.52222 8.00004 5.68067 8.06382 5.80867 8.19137C5.93622 8.31937 6 8.47782 6 8.66671C6 8.8556 5.93622 9.01382 5.80867 9.14137C5.68067 9.26937 5.52222 9.33337 5.33333 9.33337ZM10.6667 9.33337C10.4778 9.33337 10.3196 9.26937 10.192 9.14137C10.064 9.01382 10 8.8556 10 8.66671C10 8.47782 10.064 8.31937 10.192 8.19137C10.3196 8.06382 10.4778 8.00004 10.6667 8.00004C10.8556 8.00004 11.0138 8.06382 11.1413 8.19137C11.2693 8.31937 11.3333 8.47782 11.3333 8.66671C11.3333 8.8556 11.2693 9.01382 11.1413 9.14137C11.0138 9.26937 10.8556 9.33337 10.6667 9.33337ZM8 12C7.81111 12 7.65289 11.936 7.52533 11.808C7.39733 11.6805 7.33333 11.5223 7.33333 11.3334C7.33333 11.1445 7.39733 10.9863 7.52533 10.8587C7.65289 10.7307 7.81111 10.6667 8 10.6667C8.18889 10.6667 8.34733 10.7307 8.47533 10.8587C8.60289 10.9863 8.66667 11.1445 8.66667 11.3334C8.66667 11.5223 8.60289 11.6805 8.47533 11.808C8.34733 11.936 8.18889 12 8 12ZM5.33333 12C5.14444 12 4.986 11.936 4.858 11.808C4.73044 11.6805 4.66667 11.5223 4.66667 11.3334C4.66667 11.1445 4.73044 10.9863 4.858 10.8587C4.986 10.7307 5.14444 10.6667 5.33333 10.6667C5.52222 10.6667 5.68067 10.7307 5.80867 10.8587C5.93622 10.9863 6 11.1445 6 11.3334C6 11.5223 5.93622 11.6805 5.80867 11.808C5.68067 11.936 5.52222 12 5.33333 12ZM10.6667 12C10.4778 12 10.3196 11.936 10.192 11.808C10.064 11.6805 10 11.5223 10 11.3334C10 11.1445 10.064 10.9863 10.192 10.8587C10.3196 10.7307 10.4778 10.6667 10.6667 10.6667C10.8556 10.6667 11.0138 10.7307 11.1413 10.8587C11.2693 10.9863 11.3333 11.1445 11.3333 11.3334C11.3333 11.5223 11.2693 11.6805 11.1413 11.808C11.0138 11.936 10.8556 12 10.6667 12Z"
                                                        fill="#555555" />
                                                </svg>
                                                <p class="mx-1">{{ auth()->user()->updated_at }}</p>
                                            </div>
                                        </div>

                                        {{-- address --}}
                                        <div class=" orders-info">
                                            <span>Address:</span>
                                            <div class="fs-media d-flex">
                                                <svg class="mt-1" width="15" height="15" viewBox="0 0 14 14"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_21_171)">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.7125 9.8C2.75325 9.74566 2.80609 9.70156 2.86684 9.67119C2.92759 9.64081 2.99458 9.625 3.0625 9.625H5.25C5.36603 9.625 5.47731 9.67109 5.55936 9.75314C5.64141 9.83519 5.6875 9.94647 5.6875 10.0625C5.6875 10.1785 5.64141 10.2898 5.55936 10.3719C5.47731 10.4539 5.36603 10.5 5.25 10.5H3.28125L1.3125 13.125H12.6875L10.7188 10.5H8.75C8.63397 10.5 8.52269 10.4539 8.44064 10.3719C8.35859 10.2898 8.3125 10.1785 8.3125 10.0625C8.3125 9.94647 8.35859 9.83519 8.44064 9.75314C8.52269 9.67109 8.63397 9.625 8.75 9.625H10.9375C11.0054 9.625 11.0724 9.64081 11.1332 9.67119C11.1939 9.70156 11.2467 9.74566 11.2875 9.8L13.9125 13.3C13.9612 13.365 13.9909 13.4423 13.9982 13.5232C14.0055 13.6041 13.9901 13.6855 13.9538 13.7582C13.9175 13.8308 13.8616 13.8919 13.7925 13.9347C13.7234 13.9774 13.6437 14 13.5625 14H0.4375C0.356251 14 0.276607 13.9774 0.207493 13.9347C0.138378 13.8919 0.082524 13.8308 0.0461883 13.7582C0.00985267 13.6855 -0.00552861 13.6041 0.00176801 13.5232C0.00906462 13.4423 0.0387508 13.365 0.0875002 13.3L2.7125 9.8Z"
                                                            fill="#555555" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M7 0.875042C6.65528 0.875042 6.31394 0.94294 5.99546 1.07486C5.67698 1.20678 5.3876 1.40013 5.14385 1.64389C4.90009 1.88764 4.70674 2.17702 4.57482 2.4955C4.4429 2.81398 4.375 3.15532 4.375 3.50004C4.375 3.84476 4.4429 4.18611 4.57482 4.50459C4.70674 4.82307 4.90009 5.11244 5.14385 5.3562C5.3876 5.59995 5.67698 5.79331 5.99546 5.92523C6.31394 6.05714 6.65528 6.12504 7 6.12504C7.69619 6.12504 8.36387 5.84848 8.85616 5.3562C9.34844 4.86391 9.625 4.19624 9.625 3.50004C9.625 2.80385 9.34844 2.13617 8.85616 1.64389C8.36387 1.1516 7.69619 0.875042 7 0.875042ZM3.5 3.50004C3.50006 2.82649 3.69448 2.16726 4.05991 1.60146C4.42534 1.03566 4.94627 0.587317 5.56019 0.310235C6.17411 0.0331532 6.85494 -0.0608999 7.52099 0.0393615C8.18704 0.139623 8.81001 0.42994 9.31516 0.875476C9.8203 1.32101 10.1862 1.90284 10.3688 2.55115C10.5515 3.19946 10.5432 3.88671 10.345 4.53043C10.1468 5.17415 9.767 5.747 9.25128 6.18025C8.73555 6.61349 8.10577 6.88872 7.4375 6.97292V11.8125C7.4375 11.9286 7.39141 12.0399 7.30936 12.1219C7.22731 12.2039 7.11603 12.25 7 12.25C6.88397 12.25 6.77269 12.2039 6.69064 12.1219C6.60859 12.0399 6.5625 11.9286 6.5625 11.8125V6.97379C5.71634 6.86719 4.93823 6.4553 4.37431 5.8155C3.8104 5.1757 3.49949 4.35289 3.5 3.50004Z"
                                                            fill="#555555" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_21_171">
                                                            <rect width="14" height="14" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                <p class="mx-1">
                                                    {{ str(
                                                        auth()->user()->street .
                                                        (auth()->user()->number ? ', ' . auth()->user()->number : '') .
                                                        (auth()->user()->complement ? ' - ' . auth()->user()->complement : '') .
                                                        (auth()->user()->country?->name ? ', ' . auth()->user()->country?->name : '') .
                                                        (auth()->user()->zipcode ? ' / ' . auth()->user()->zipcode : '')
                                                    )}}
                                                </p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-12 col-md-6">

                                        <div class="d-flex justify-content-between">
                                            {{-- phone --}}
                                            <div class="fs-media orders-info">
                                                @if(auth()->user()->phone >= 0)
                                                    <span>Phone Number:</span>
                                                    <p>{{ auth()->user()->phone }}</p>
                                                @else
                                                    <span>Phone Number:</span>
                                                @endif
                                            </div>

                                            <div>
                                                @if (Auth::user()->role->value == \App\Enums\Role::CommonUser->value)
                                                    <a class="btn_edit d-flex align-items-center gap-1"
                                                    href="{{ route('seeker.edit', Auth::user()->id) }}">Edit<img style="max-width: 14px"
                                                        src="https://i.ibb.co/S3b8M9M/material-symbols-edit-rounded.png"
                                                        alt=""></a>
                                                @else
                                                    <a class="btn_edit d-flex align-items-center gap-1"
                                                        href="{{ route('users.edit', auth()->user()) }}">Edit<img style="max-width: 14px"
                                                            src="https://i.ibb.co/S3b8M9M/material-symbols-edit-rounded.png"
                                                            alt=""></a>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- email --}}
                                        <div class="fs-media orders-info">
                                            <span>Email:</span>
                                            <p>{{ auth()->user()->email }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                    </div>
                <div style="border: 0;" class="card mt-4">
                    <div class="table-responsive bg-white p-4 rounded">
                        <ul class="nav nav-tabs mb-2" style="display: flex;flex-wrap: nowrap;">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route('orders.indexSeeker', Auth::user()->id)}}">
                                    <h6 style="color: #333333;">Service Orders</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('purchases.indexSeeker', Auth::user()->id)}}">
                                    <h6 style="color: #808080;">Content Orders</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('following.indexSeeker', Auth::user()->id)}}">
                                    <h6 style="color: #808080;">Following</h6>
                                </a>
                            </li>
                        </ul>

                        @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <table class="table mb-0 thead-border-top-0 table-striped">
                            <thead>
                                <tr style="color: #A9A9A9;">
                                    <th style="border: none; white-space: nowrap; font-weight: 600;">{{ __('Code') }}</th>
                                    <th style="border: none; white-space: nowrap; font-weight: 600;">{{ __('Status') }}</th>
                                    <th style="border: none; white-space: nowrap; font-weight: 600;">{{ __('Date') }}</th>
                                    <th style="border: none; white-space: nowrap; font-weight: 600;">{{ __('Service Name') }}</th>
                                    <th style="border: none; white-space: nowrap; font-weight: 600;">{{ __('Practitioner Name') }}</th>
                                    <th style="border: none; white-space: nowrap; font-weight: 600;">{{ __('Amount') }}</th>
                                    <th style="border: none;"></th>
                                    <th style="border: none;"></th>
                                    <th style="border: none;"></th>
                                </tr>
                            </thead>

                            <tbody class="list" id="companies">
                                @forelse ($orders as $order)
                                    <tr @class(['bg-tr' => $loop->index % 2 == 0])>
                                        <td style="border: none;">
                                            <div style="white-space: nowrap; color: #333333;" class="badge badge-light">
                                                #{{ Str::limit($order->id, 6, '...') }}
                                            </div>
                                        </td>

                                        <td style="border: none;">
                                            @if ($order->status)
                                            <small style="font-size: 13px;"><i style="color: rgb(0, 210, 0); font-size: 8px;" class="bi bi-circle-fill"></i> {{ __('Paid') }}</small>
                                            @else
                                                <a href="{{route('checkout.index', $order->id)}}">
                                                   <small>{{ __('Pending') }}</small>
                                                </a>
                                            @endif
                                        </td>

                                        <td style="border: none;">
                                            <small style="white-space: nowrap;" class="d-flex gap-1 align-items-center">
                                                <svg width="15" height="15" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.33333 14.6667C2.96667 14.6667 2.65267 14.5363 2.39133 14.2754C2.13044 14.014 2 13.7 2 13.3334V4.00004C2 3.63337 2.13044 3.3196 2.39133 3.05871C2.65267 2.79737 2.96667 2.66671 3.33333 2.66671H4V1.33337H5.33333V2.66671H10.6667V1.33337H12V2.66671H12.6667C13.0333 2.66671 13.3473 2.79737 13.6087 3.05871C13.8696 3.3196 14 3.63337 14 4.00004V13.3334C14 13.7 13.8696 14.014 13.6087 14.2754C13.3473 14.5363 13.0333 14.6667 12.6667 14.6667H3.33333ZM3.33333 13.3334H12.6667V6.66671H3.33333V13.3334ZM3.33333 5.33337H12.6667V4.00004H3.33333V5.33337ZM8 9.33337C7.81111 9.33337 7.65289 9.26937 7.52533 9.14137C7.39733 9.01382 7.33333 8.8556 7.33333 8.66671C7.33333 8.47782 7.39733 8.31937 7.52533 8.19137C7.65289 8.06382 7.81111 8.00004 8 8.00004C8.18889 8.00004 8.34733 8.06382 8.47533 8.19137C8.60289 8.31937 8.66667 8.47782 8.66667 8.66671C8.66667 8.8556 8.60289 9.01382 8.47533 9.14137C8.34733 9.26937 8.18889 9.33337 8 9.33337ZM5.33333 9.33337C5.14444 9.33337 4.986 9.26937 4.858 9.14137C4.73044 9.01382 4.66667 8.8556 4.66667 8.66671C4.66667 8.47782 4.73044 8.31937 4.858 8.19137C4.986 8.06382 5.14444 8.00004 5.33333 8.00004C5.52222 8.00004 5.68067 8.06382 5.80867 8.19137C5.93622 8.31937 6 8.47782 6 8.66671C6 8.8556 5.93622 9.01382 5.80867 9.14137C5.68067 9.26937 5.52222 9.33337 5.33333 9.33337ZM10.6667 9.33337C10.4778 9.33337 10.3196 9.26937 10.192 9.14137C10.064 9.01382 10 8.8556 10 8.66671C10 8.47782 10.064 8.31937 10.192 8.19137C10.3196 8.06382 10.4778 8.00004 10.6667 8.00004C10.8556 8.00004 11.0138 8.06382 11.1413 8.19137C11.2693 8.31937 11.3333 8.47782 11.3333 8.66671C11.3333 8.8556 11.2693 9.01382 11.1413 9.14137C11.0138 9.26937 10.8556 9.33337 10.6667 9.33337ZM8 12C7.81111 12 7.65289 11.936 7.52533 11.808C7.39733 11.6805 7.33333 11.5223 7.33333 11.3334C7.33333 11.1445 7.39733 10.9863 7.52533 10.8587C7.65289 10.7307 7.81111 10.6667 8 10.6667C8.18889 10.6667 8.34733 10.7307 8.47533 10.8587C8.60289 10.9863 8.66667 11.1445 8.66667 11.3334C8.66667 11.5223 8.60289 11.6805 8.47533 11.808C8.34733 11.936 8.18889 12 8 12ZM5.33333 12C5.14444 12 4.986 11.936 4.858 11.808C4.73044 11.6805 4.66667 11.5223 4.66667 11.3334C4.66667 11.1445 4.73044 10.9863 4.858 10.8587C4.986 10.7307 5.14444 10.6667 5.33333 10.6667C5.52222 10.6667 5.68067 10.7307 5.80867 10.8587C5.93622 10.9863 6 11.1445 6 11.3334C6 11.5223 5.93622 11.6805 5.80867 11.808C5.68067 11.936 5.52222 12 5.33333 12ZM10.6667 12C10.4778 12 10.3196 11.936 10.192 11.808C10.064 11.6805 10 11.5223 10 11.3334C10 11.1445 10.064 10.9863 10.192 10.8587C10.3196 10.7307 10.4778 10.6667 10.6667 10.6667C10.8556 10.6667 11.0138 10.7307 11.1413 10.8587C11.2693 10.9863 11.3333 11.1445 11.3333 11.3334C11.3333 11.5223 11.2693 11.6805 11.1413 11.808C11.0138 11.936 10.8556 12 10.6667 12Z"
                                                        fill="#B4BEC5" />
                                                </svg>
                                                {{ $order->created_at->format('d-m-Y') }}</small>
                                        </td>

                                        <td style="border: none;">
                                            <small>{{ str($order->package->service->name)->limit(16, '...') }}</small>
                                        </td>

                                        <td style="border: none;">
                                            {{ $order->package->service->user()->withTrashed()->first()->name }}
                                        </td>

                                        <td style="border: none;">
                                            <small>{{ $order->package->price * $order->quantity }}</small>
                                        </td>
                                        <td data-evaluation="{{$order->review ? $order->review->overall : ''}}" style="border: none;">
                                            <input class="rating text-center size-stars" min="{{$order->review ? $order->review->overall : 0}}" max="{{$order->review ? $order->review->overall : 0}}" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)" step="0.5" style="--value:{{$order->review ? $order->review->overall : ''}}" type="range">
                                        </td>

                                        <td style="border: none;">
                                            <div class="d-flex justify-content-end">
                                                <!-- Button trigger modal -->
                                                @if($order->status)
                                                    @if(!$order->reviewed)
                                                    <button type="button" class="btn_1 py-2 px-3" data-bs-toggle="modal" data-bs-target="#review-{{$order->id}}">
                                                        Leave a review
                                                    </button>
                                                    @else
                                                    <button type="button" class="ml-2 btn_1 py-2 px-3" data-bs-toggle="modal" data-bs-target="#reviewed-{{$order->id}}">
                                                        See review
                                                    </button>
                                                    <button type="submit" style="margin-left: 15px;" class="btn-options btn-delete" data-bs-toggle="modal" data-bs-target="#confirm-review-deletion-{{ $order->id }}">
                                                        <i class="bi bi-trash" style="color:#EC0B0B;"></i>
                                                    </button>
                                                    @endif
                                                @endif    
                                            </div>
                                        </td>

                                        <td style="border: none;">
                                            <div class="d-flex justify-content-end">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn-options" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$order->id}}">
                                                    <img style="max-width: 20px;" src="https://i.ibb.co/5FSRq0Q/olho.png" alt="">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="6">
                                            @lang('No results found')
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- /container-->
    </main>
    @forEach ($orders as $order)
        @include('front.orders.partials.review-modal', ['orderId' => $order->id,'orderName' => $order->name,])
        @include('front.orders.partials.modal', ['orderId' => $order->id,'orderName' => $order->name,])
        @if($order->review)
            @include('front.orders.partials.reviewed-modal', ['order' => $order, 'review' => $order->review])
            @include('front.orders.partials.delete-review-form', ['order' => $order, 'review' => $order->review])
        @endif
    @endforeach
</x-default-layout>
<link href="{{ asset('assets/front/css/stars.css')}}" rel="stylesheet">
<script>
    var tdStars = document.querySelectorAll('.tdStars');

    tdStars.forEach(element => {
        var iconsStar = element.querySelectorAll('i');
        var evaluationValue = +element.getAttribute('data-evaluation');
        
        for (var i = 0; i < evaluationValue; i++) {
            iconsStar[i].classList.replace('opacity-25', 'text-warning');
        }
    });
    document.querySelectorAll('#cancel-btn').forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.preventDefault();
        });
    })
</script>
<style>
    .review-modal .modal-dialog {
        top:0 !important;
    }
    @media (max-width: 767px) {
        #bgMedia {
            height: 400px;
            margin-bottom: 20px
        }
        .fs-media p {
            font-size: 14px;
        }
    }
</style>
