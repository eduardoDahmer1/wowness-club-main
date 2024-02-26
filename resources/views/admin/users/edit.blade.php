@section('title', 'Edit ' . $user->name)

<x-app-layout>
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i
                                        class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Practitioner</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">Edit Practitioner</h1>
                </div>

            </div>
        </div>

        <div class="container-fluid page__container">

            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col-12 card-form__body card-body">
                        <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <x-input-label for="photo" :value="__('profile pic *')" />
                                        <x-input-info-label>Size: 1080x1080 | JPG, PNG, JPEG</x-input-info-label>
                                        <input type="file" name="photo" accept="image/png, image/jpeg, image/jpg" required data-value-image="{{ $user->photo_url }}">
                                        <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="name" :value="__('Name *')" />
                                                <x-text-input id="name" name="name" type="text"
                                                    class="form-control" :value="old('name', $user->name)" />
                                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="alias" :value="__('Profile Name *')" />
                                                <x-input-info-label>Name you would like to display on your profile
                                                </x-input-info-label>
                                                <x-text-input id="alias" name="alias" type="text"
                                                    class="form-control" :value="old('alias', $user->alias)" />
                                                <x-input-error class="mt-2" :messages="$errors->get('alias')" />
                                            </div>
                                        </div>

                                        @isMaintainer(auth()->user())
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <x-input-label for="position" :value="__('Presentation position *')" />
                                                    <x-text-input id="position" min="0" max="16" name="position" type="number"
                                                        class="form-control" :value="old('position', $user->position)" />
                                                    <x-input-error class="mt-2" :messages="$errors->get('position')" />
                                                </div>
                                            </div>
                                        @endisMaintainer

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="phone" :value="__('Phone Number *')" />
                                                <x-text-input id="phone" name="phone" type="text"
                                                    class="form-control" :value="old('phone', $user->phone)" oninput="this.value = '+' + this.value.replace('+', '')"/>
                                                <x-input-error class="mt-2" :messages="$errors->get('phone')"/>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="email" :value="__('Email *')" />
                                                <x-text-input id="email" name="email" type="email"
                                                    class="form-control" :value="old('email', $user->email)" />
                                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="password" :value="__('Password')" />
                                                <x-text-input id="password" name="password" type="password"
                                                    class="form-control" :value="old('password')" />
                                                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                                            </div>
                                        </div>

                                        @isAdmin(auth()->user())
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <x-input-label for="role" :value="__('Role *')" />
                                                    <select name="role" id="role" data-toggle="select" required>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->value }}" @selected($user->role->value === $role->value)>
                                                                {{ $role->name() }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-input-error class="mt-2" :messages="$errors->get('role')" />
                                                </div>
                                            </div>
                                            @if ($user->selected_plan)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <x-input-label for="selected_plan" :value="__('Application')" />
                                                    <x-text-input disabled id="selected_plan" name="selected_plan" type="text"
                                                        class="form-control" :value="old('selected_plan', $user->selected_plan)" />
                                                </div>
                                            </div>
                                            @endif
                                        @else
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    @if ($user->status)
                                                        <x-input-label for="status" :value="__('Status')" />
                                                        <p class="mt-2" style="color:#515151;"><i class="fa fa-circle" style="color:green;"></i> Approved</p>
                                                    @else
                                                        <x-input-label for="status" :value="__('Status')" />
                                                        <p class="mt-2" style="color:#515151;"><i class="fa fa-circle"></i> Pending</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endisAdmin

                                        <div class="col-9">
                                            <div>
                                                <input type="checkbox" name="show_certificates"
                                                    id="show_certificates" value="1" @checked($user->show_certificates) />
                                                <label for="show_certificates"
                                                    class="check-styles">{{__('Show on profile')}}</label>
                                            </div>
                                            <div class="form-group multiple-files">
                                                <x-input-label for="certificates" :value="__('Qualifications/insurance')" />
                                                <x-input-info-label>This is an optional feature. We recommend this if you work in technical fields to increase your credibility and strengthen your profile.</x-input-info-label>
                                                <div class="box-galleries">
                                                    <div class="d-flex">
                                                        @foreach ($user->certificates  as $certificate)
                                                            @if (in_array( pathinfo(asset("storage/".$certificate->file),PATHINFO_EXTENSION), ['jpg','jpeg','png','webp', 'gif', 'svg']))
                                                                <div class="box-image-gallery" id="certificate-{{ $certificate->id }}" style="background-image: url('{{asset("storage/".$certificate->file)}}');">
                                                                    <i class="material-icons delete-certificate" data-id="{{ $certificate->id }}">delete</i>
                                                                    <a target="_blank" href="{{asset("storage/".$certificate->file)}}"
                                                                        style="width: 100%;height: 100%;"></a>
                                                                </div>
                                                            @else
                                                                <div class="box-image-gallery" id="certificate-{{ $certificate->id }}" style="background: #fff;">
                                                                    <i class="material-icons delete-certificate" data-id="{{ $certificate->id }}">delete</i>
                                                                    <a href="{{asset("storage/".$certificate->file)}}" class="text-center w-100 p-2 " target="_blank">
                                                                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M9.86886 35.9993C8.96887 35.9993 8.19816 35.6785 7.55672 35.0371C6.91528 34.3957 6.5951 33.6255 6.59619 32.7266V14.4406C6.59619 14.0042 6.67801 13.5886 6.84164 13.1937C7.00528 12.7988 7.23709 12.4508 7.53708 12.1497L15.4733 4.21353C15.7733 3.91354 16.1213 3.68173 16.5173 3.51809C16.9133 3.35446 17.3289 3.27264 17.7642 3.27264H29.5048C30.4048 3.27264 31.1755 3.59336 31.817 4.23481C32.4584 4.87625 32.7786 5.64641 32.7775 6.54531V32.7266C32.7775 33.6266 32.4568 34.3973 31.8153 35.0387C31.1739 35.6802 30.4037 36.0003 29.5048 35.9993H9.86886ZM9.86886 32.7266H29.5048V6.54531H17.8051L9.86886 14.4815V32.7266ZM19.6868 27.1222C19.905 27.1222 20.1096 27.0878 20.3005 27.0191C20.4914 26.9503 20.6686 26.8347 20.8323 26.6722L25.1276 22.3768C25.4276 22.0768 25.5776 21.7086 25.5776 21.2723C25.5776 20.8359 25.414 20.4541 25.0867 20.1269C24.7867 19.8269 24.4115 19.6769 23.9609 19.6769C23.5104 19.6769 23.122 19.8269 22.7959 20.1269L21.3232 21.5177V16.3633C21.3232 15.8997 21.1661 15.5108 20.8519 15.1966C20.5377 14.8824 20.1494 14.7259 19.6868 14.727C19.2232 14.727 18.8343 14.884 18.5201 15.1982C18.206 15.5124 18.0494 15.9008 18.0505 16.3633V21.5177L16.5778 20.0859C16.2505 19.7859 15.8687 19.636 15.4324 19.636C14.996 19.636 14.6142 19.7996 14.2869 20.1269C13.987 20.4268 13.837 20.8087 13.837 21.2723C13.837 21.7359 13.987 22.1177 14.2869 22.4177L18.5414 26.6722C18.705 26.8358 18.8823 26.952 19.0732 27.0207C19.2641 27.0894 19.4687 27.1233 19.6868 27.1222Z" fill="#555555"/>
                                                                        </svg>
                                                                        <small>{{str(basename($certificate->file))->limit(6, '...') . pathinfo(asset("storage/".$certificate->file),PATHINFO_EXTENSION)}}</small>
                                                                    </a>
                                                                </div>
                                                            @endif

                                                        @endforeach
                                                    </div>
                                                </div>

                                                <input type="file" name="certificates[]" multiple  data-value-image="{{ $user->certificates }}">
                                                <x-input-error class="mt-2" :messages="$errors->get('certificates')" />
                                            </div>
                                        </div>

                                        @isMaintainer(auth()->user())
                                            <div class="col-3 d-flex justify-content-center">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                                        <input name="status" type="checkbox" id="verified-for-{{ $user->id }}" data-id-user="{{ $user->id }}" class="custom-control-input" value="1" @checked( $user->status )>
                                                        <label class="custom-control-label" for="verified-for-{{ $user->id }}">..</label>
                                                    </div>
                                                    <label for="verified-for-{{ $user->id }}" class="mb-0"><small>Verified</small></label>
                                                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                                </div>
                                            </div>
                                        @endisMaintainer
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <x-input-label for="headline" :value="__('Headline/Title*')" />
                                        <x-input-info-label>(Be clear and specific. Write short title of what you do).</x-input-info-label>
                                        <x-text-input id="headline" name="headline" type="text" :value="old('headline', $user->headline)"
                                            placeholder="Eg. Yoga Teacher & Breathwork Coach" />

                                        <x-input-error class="mt-2" :messages="$errors->get('headline')" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <x-input-label for="bio" :value="__('Description Bio *')" />
                                        <x-input-info-label>Up to 500 characters</x-input-info-label>
                                        <textarea id="bio" name="bio" type="text" class="form-control" rows="4"
                                            placeholder="Hint: What led you to this work? What are your super powers? What is your experience? Who do you help? What results or transformation can you offer? Why you and your services?">{{ old('bio', $user->bio) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <x-input-label for="offer" :value="__('What do you offer?')" />
                                        <x-input-info-label>(Be clear and specific. Write short title of what you do).</x-input-info-label>
                                        <x-text-input id="offer" name="offer" type="text" :value="old('offer', $user->offer)"
                                            placeholder="E.g. PTSD, Hormones, Hair Loss." />

                                        <x-input-error class="mt-2" :messages="$errors->get('offer')" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <x-input-label for="help" :value="__('Who do you help?')" />
                                        <x-input-info-label>Your Ideal Client....</x-input-info-label>
                                        <x-text-input id="help" name="help" type="text" :value="old('help', $user->help)"
                                            placeholder="E.g. Single mums in their late 40s. " />

                                        <x-input-error class="mt-2" :messages="$errors->get('help')" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <x-input-label for="quote" :value="__('Elevator Pitch')" />
                                        <x-input-info-label>Up to 100 characters</x-input-info-label>
                                        <x-text-input id="quote" name="quote" type="text" :value="old('quote', $user->quote)"
                                            placeholder="E.g. I help [INSERT Gender + Age) suffering from [INSERT condition) to get {INSERT result/benefit) through [INSERT method/expertise]." maxlength="100"/>

                                        <x-input-error class="mt-2" :messages="$errors->get('quote')" />
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <x-input-label :value="__('Language')" />
                                        <x-input-info-label>Select more than 1 if you offer simultaneous translation
                                        </x-input-info-label>
                                        <div class="row">
                                            @foreach ($languages as $language)
                                                <div class="col-lg-6 py-1">
                                                    <input type="checkbox" name="languages[{{ $language->id }}][id]"
                                                        id="language_{{ $language->id }}"
                                                        value="{{ $language->id }}"
                                                        @checked($user->languages->contains('id', $language->id)) />
                                                    <label for="language_{{ $language->id }}"
                                                        class="check-styles">{{ $language->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button type="button" id="open-list-cat"
                                            class="btn btn-primary p-2 text-uppercase fw-bold">{{ __('+ Categories') }}</button>
                                        <x-tooltip-info id='infoCategorie' :info="__(
                                            'Didn’t find a suitable category? Email us at: support@wownessclub.com and let us know your category.',
                                        )" />
                                        <x-input-info-label>Click to add new categories</x-input-info-label>
                                        <div id="categories-check" class="row"></div>

                                        <div class="list-categ">
                                            <div class="row">
                                                <x-input-info-label class="col-12">Click to select the categories you
                                                    want to relate to the content</x-input-info-label>
                                                @if ($categories->count() == 0 && $subcategories->count() == 0)
                                                    <h6 class="col-12 py-2">No categories created, try creating <a
                                                            href="{{ route('categories.store') }}">new categories</a>
                                                    </h6>
                                                @endif
                                            </div>
                                            <div class="row">
                                                @foreach ($categories as $category)
                                                    <div class="col-md-4">
                                                        <input class="check-categories" type="checkbox"
                                                            name="categories[{{ $category->id }}][id]"
                                                            data-handle-name="{{ $category->name }}"
                                                            data-handle-id="category_{{ $category->id }}"
                                                            id="category_{{ $category->id }}"
                                                            value="{{ $category->id }}"
                                                            {{ isset($user) && $user->categoriesuser->contains('id', $category->id) ? 'checked' : '' }}/>
                                                        <label for="category_{{ $category->id }}">
                                                            <img class="pr-2" width='28px'
                                                                src="{{ asset('storage/' . $category->icon) }}"
                                                                alt="">
                                                            {{ $category->name }}
                                                        </label>
                                                        <div class="d-flex flex-wrap">
                                                            @foreach ($category->subcategories as $subcategory)
                                                            <div>
                                                                <input class="check-categories" type="checkbox"
                                                                    name="subcategories[{{ $subcategory->id }}][id]"
                                                                    data-handle-name="{{ $subcategory->name }}"
                                                                    data-handle-id="subcategory_{{ $subcategory->id }}"
                                                                    id="subcategory_{{ $subcategory->id }}"
                                                                    value="{{ $subcategory->id }}" {{ isset($user) && $user->subcategoriesuser->contains('id', $subcategory->id) ? 'checked' : '' }}/>
                                                                <label class="p-1" style="font-size: 13px; margin: 1.5px;" for="subcategory_{{ $subcategory->id }}">
                                                                    {{ $subcategory->name }}
                                                                </label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group specialisations">
                                        <button type="button" class="btn btn-primary p-2 text-uppercase fw-bold"
                                            data-handler="newinput" data-ratio="specialisations" data-name="name"
                                            data-placeholder="E.g. 500 Hours Yoga Teacher Training">+ new specialisation</button>
                                        <x-tooltip-info id='infospecialisations' :info="__('Qualifications, Specialisations or Experience')" />

                                        @foreach ($user->specialisations as $specialisation)
                                            <div class="box-inputs-dinamic d-flex align-items-center">
                                                <x-text-input id="specialisation_{{ $loop->index }}"
                                                    name="specialisations[{{ $loop->index }}][name]" type="text"
                                                    class="form-control" :value="old('specialisations.' . $loop->index . '.name', $specialisation->name)"
                                                    placeholder="Insert text here" />
                                                <x-input-error class="mt-2" :messages="$errors->get('specialisations.' . $loop->index . '.name')" />
                                                <div class="p-1">
                                                    <i onclick="removeExtras()" class="material-icons icon-delete btn-extras" data-ratio="specialisations">delete</i>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group testimonials">
                                        <button type="button" class="btn btn-primary p-2 text-uppercase fw-bold"
                                            data-handler="newinput" data-ratio="testimonials" data-name="name"
                                            data-placeholder="https://">+ new testimonial</button>
                                        <x-tooltip-info id='infotestimonials' :info="__('Qualifications, testimonials or Experience')" />

                                        @foreach ($user->testimonials as $testimonial)
                                            <div class="box-inputs-dinamic d-flex align-items-center">
                                                <x-text-input id="testimonial_{{ $loop->index }}"
                                                    name="testimonials[{{ $loop->index }}][name]" type="text"
                                                    class="form-control" :value="old('testimonials.' . $loop->index . '.name', $testimonial->name)"
                                                    placeholder="Insert text here" />
                                                <x-input-error class="mt-2" :messages="$errors->get('testimonials.' . $loop->index . '.name')" />
                                                <div class="p-1">
                                                    <i onclick="removeExtras()" class="material-icons icon-delete btn-extras" data-ratio="testimonials">delete</i>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="years_experience" :value="__('Years of Experience *')" />
                                        <select name="years_experience" id="years_experience" data-toggle="select">
                                            <option selected disabled value="">Select your experience</option>
                                            <option value="< 1 year of experience" @selected($user->years_experience === '< 1 year of experience')>< 1 year of experience</option>
                                            <option value="1-2 years of experience"  @selected($user->years_experience === '1-2 years of experience')>1-2 years of experience</option>
                                            <option value="2-5 years of experience" @selected($user->years_experience === '2-5 years of experience')>2-5 years of experience</option>
                                            <option value="5+ years of experience" @selected($user->years_experience === '5+ years of experience')> >5+ years of experience</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('years_experience')" />
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="title-forms-defaults">
                                        <h3>Social Links</h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-input-label for="instagram" :value="__('Instagram')" />
                                        <x-text-input id="instagram" name="instagram" type="text"
                                            class="form-control" :value="old('instagram', $user->instagram)" placeholder="https://instagram.com"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-input-label for="youtube" :value="__('Youtube')" />
                                        <x-text-input id="youtube" name="youtube" type="text"
                                            class="form-control" :value="old('youtube', $user->youtube)" placeholder="https://youtube.com"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('youtube')" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-input-label for="tiktok" :value="__('Tiktok')" />
                                        <x-text-input id="tiktok" name="tiktok" type="text"
                                            class="form-control" :value="old('tiktok', $user->tiktok)" placeholder="https://titkot.com"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('tiktok')" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-input-label for="facebook" :value="__('Facebook')" />
                                        <x-text-input id="facebook" name="facebook" type="text"
                                            class="form-control" :value="old('facebook', $user->facebook)" placeholder="https://facebook.com"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('facebook')" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="linkedin" :value="__('Linkedin')" />
                                        <x-text-input id="linkedin" name="linkedin" type="text"
                                            class="form-control" :value="old('linkedin', $user->linkedin)" placeholder="https://linkedin.com"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="twitter" :value="__('Twitter')" />
                                        <x-text-input id="twitter" name="twitter" type="text"
                                            class="form-control" :value="old('twitter', $user->twitter)" placeholder="https://twitter.com"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('twitter')" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="site" :value="__('Website')" />
                                        <x-text-input id="site" name="site" type="text"
                                            class="form-control" :value="old('site', $user->site)" placeholder="https://website.com"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('site')" />
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="title-forms-defaults">
                                        <h3>Address</h3>
                                        <x-input-info-label>Don't worry, users will not have access to your address.
                                        </x-input-info-label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="street" :value="__('Street *')" />
                                        <x-text-input id="street" name="street" type="text"
                                            class="form-control" :value="old('street', $user->street)"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('street')" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="number" :value="__('Number *')" />
                                        <x-text-input id="number" name="number" type="text"
                                            class="form-control" :value="old('number', $user->number)"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('number')" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="city" :value="__('City *')" />
                                        <x-text-input id="city" name="city" type="text"
                                            class="form-control" :value="old('city', $user->city)" required/>
                                        <x-input-error class="mt-2" :messages="$errors->get('city')" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="complement" :value="__('State *')" />
                                        <x-text-input id="complement" name="complement" type="text" required
                                            class="form-control" :value="old('complement', $user->complement)" />
                                        <x-input-error class="mt-2" :messages="$errors->get('complement')" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="zipcode" :value="__('Zipcode *')" />
                                        <x-text-input id="zipcode" name="zipcode" type="text"
                                            class="form-control" :value="old('zipcode', $user->zipcode)"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('zipcode')" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-input-label for="country_id" :value="__('Country *')" />
                                        <select name="country_id" id="country_id" data-toggle="select" required>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" @selected($user->country_id === $country->id)>
                                                    {{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('country_id')" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row justify-content-center">
                                        <x-success-button>{{ __('Save') }}</x-success-button>
                                        <a style="color:#333;" href="{{ route('users.index') }}"
                                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                            {{ __('Cancel') }}
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>

        let isFirtsClick = true;
        document.querySelectorAll('i.delete-certificate').forEach(element => {
            element.addEventListener('click', () => {

                if (isFirtsClick) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "By continuing you will delete this file without having to save your changes.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Continue',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Função que deleta uma certificado do usuario
                                var idCertificate = element.getAttribute('data-id');
                                var url = `/certificates/${idCertificate}`
                                $('div#certificate-'+idCertificate).remove()
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    type: 'DELETE',
                                    url: url,
                                })
                                isFirtsClick = false;
                            }
                    })
                    return
                }

                // Função que deleta uma certificado do usuario
                var idCertificate = element.getAttribute('data-id');
                var url = `/certificates/${idCertificate}`
                $('div#certificate-'+idCertificate).remove()
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    url: url,
                })
            })
        });
    </script>

</x-app-layout>

@include('admin.scripts')
