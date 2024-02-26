<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            width: 1200,
            height: 300,
            plugins: 'advlist link image paste lists wordcount',
            toolbar: 'undo redo | fontselect | styleselect | bold italic | image link | alignleft aligncenter alignright alignjustify | outdent indent',
            font_formats: 'Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Lexend=lexend,sans-serif; Montserrat=montserrat; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats'
        });
    </script>
</head>
    @section('title', 'Edit Post')
    <x-app-layout>
        <div class="mdk-drawer-layout__content page">
            <div class="container-fluid page__heading-container">
                <div class="page__heading d-flex align-items-center">
                    <div class="flex">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="/dashboard"><i
                                            class="material-icons icon-20pt">home</i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Posts</li>
                            </ol>
                        </nav>
                        <h1 class="m-0">@lang('Edit Post')</h1>
                    </div>

                </div>
            </div>
            <div class="container-fluid page__container">

                <div class="card card-form">
                    <div class="row no-gutters">
                        <div class="col-12 card-form__body card-body">
                            <form method="POST" action="{{ route('posts.update', $post->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row justify-content-start">

                                    <div class="col-6">
                                        <div class="title-forms-defaults">
                                            <h3>Card Photo *</h3>
                                        </div>
                                        <x-input-info-label>Size: 650x610 | JPG, PNG, JPEG</x-input-info-label>
                                        <input required type="file" name="cover_photo"
                                            accept="image/png, image/jpeg, image/jpg" data-value-image="{{ $post->cover_photo ? asset('storage/' . $post->cover_photo) : '' }}">
                                        <x-input-error class="mt-2" :messages="$errors->get('cover_photo')" />
                                    </div>
                                    
                                    <div class="col-6">
                                        <div class="title-forms-defaults">
                                            <h3>Banner</h3>
                                        </div>
                                        <x-input-info-label>Size: 1920x500 | JPG, PNG, JPEG</x-input-info-label>
                                        <input type="file" name="banner" accept="image/png, image/jpeg, image/jpg" data-value-image="{{ $post->banner ? asset('storage/'. $post->banner) : ''}}"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('banner')" />
                                    </div>

                                    <div class="col-12">
                                        <div class="title-forms-defaults">
                                            <h3>Video</h3>
                                        </div>
                                        <x-input-info-label>Add video link</x-input-info-label>
                                        <x-text-input type="text" id="video" name="video" placeholder="https://www.youtube.com/embed/your-video"
                                                class="form-control" :value="old('video', isset($post) ? $post->video : '')" />
                                    </div>

                                    <div class="col-12">
                                        <div class="title-forms-defaults">
                                            <h3>Main Details</h3>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <x-input-label for="name" value="Title *" />
                                            <x-text-input id="name" name="name" type="text"
                                                class="form-control" required :value="old('name', isset($post) ? $post->name : '')" /> 
                                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <x-input-label for="slug" value="Slug" />
                                            <x-text-input id="slug" name="slug" type="text"
                                                class="form-control" :value="old('slug', isset($post) ? $post->slug : '')" /> 
                                            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <x-input-label for="flipsnack_embed" value="Flipsnack Embed" />
                                            <x-text-input id="flipsnack_embed" name="flipsnack_embed" type="text"
                                                class="form-control" :value="old('flipsnack_embed', isset($post) ? $post->flipsnack_embed : '')" />
                                            <x-input-error class="mt-2" :messages="$errors->get('flipsnack_embed')" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <x-input-label for="author" value="Author *" />
                                            <x-text-input id="author" name="author" type="text"
                                                class="form-control" required :value="old(
                                                    'author',
                                                    isset($post) ? $post->author : '',
                                                )" />
                                            <x-input-error class="mt-2" :messages="$errors->get('author')" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <x-input-label for="released_at" :value="__('Released')" />
                                            <div class="flatpickr">
                                                <input type="datetime-local" name="released_at" required id="released_at"
                                                    class="form-control" placeholder="Choose released date"
                                                    data-toggle="flatpickr" data-flatpickr-enable-time="false"
                                                    data-flatpickr-alt-format="F j, Y"
                                                    data-flatpickr-date-format="Y-m-d"
                                                    value="{{ old('released_at', $post->released_at ?? $post->created_at) }}">
                                                
                                                <i class="fa fa-calendar-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                                <input name="status" type="checkbox" id="verified-for-{{ $post->id }}" class="custom-control-input" value="1" @checked($post->status)>
                                                <label class="custom-control-label" for="verified-for-{{ $post->id }}">..</label>
                                            </div>
                                            <label for="verified-for-{{ $post->id }}" class="mb-0"><small>Published</small></label>
                                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                        </div>
                                    </div>
                                    <div style="overflow: scroll;width: 100%;">
                                        <textarea name="body" id="body" cols="30" rows="10">
                                        {{old('body', $post->body)}}
                                        </textarea>
                                    </div>
                                    <div>
                                        <x-success-button class="mt-3">{{__('Update')}}</x-success-button>
                                        <a style="color:#333;" href="{{ route('posts.index') }}"
                                        class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                        {{ __('Cancel') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


</html>

</x-app-layout>

<script src="{{ asset('assets/admin/js/flatpickr.js') }}"></script>

@include('admin.scripts')
