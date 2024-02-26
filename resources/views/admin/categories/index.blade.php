@section('title', 'Categories')
<x-app-layout>
    <div class="mdk-drawer-layout__content page">

        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="material-icons icon-20pt">home</i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Categories</li>
                        </ol>
                    </nav>
                    <h1 class="m-0">Categories</h1>
                </div>
                
            </div>
        </div>



        <div class="container-fluid page__container">

            <div class="card card-form d-flex flex-column flex-sm-row">
                <div class="card-form__body card-body-form-group flex">
                    <div class="row">
                        <div class="col-sm-auto col-lg-4">
                            <div class="form-group">
                                <label for="filter_name">Category Name</label>
                                <x-admin.search />
                            </div>
                        </div>

                        <div class="col-sm-auto d-flex align-items-end">
                            <div class="form-group">
                                <a href="{{ route('categories.create') }}" class="btn btn-primary p-2 text-uppercase fw-bold"><i class="material-icons">add</i> New Category</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">

                <div class="table-responsive" data-toggle="lists" data-lists-values='["js-lists-values-employee-name"]'>

                    <table class="table mb-0 thead-border-top-0 table-striped">
                        <thead>
                            <tr>

                                <th style="width: 30px;" class="text-center">#ID</th>
                                <th>Icon</th>
                                <th>Category Name</th>
                                <th></th>
    
                            </tr>
                        </thead>
                        <tbody class="list" id="companies">
                            @forelse ($categories as $category)
                                <tr @class(['bg-tr' => $loop->index % 2 == 0])>
                                    <td>
                                        <div class="badge badge-light">#{{ Str::limit($category->id, 6, "...") }}</div>
                                    </td>

                                    <td style="width:50px;">
                                        @if ($category->icon)
                                        <img height="50px" src="{{ asset('storage/'. $category->icon) }}">
                                        @endif
                                    </td>
                                   
                                    <td>
                                        <h6 class="m-0">{{ $category->name }}</h6>
                                    </td>

                                    <td>
                                        <div class="box-options">
                                            @if ($category->subcategories->count()) 
                                                <a data-toggle="collapse" href="#subcategories-for-{{ $category->id }}" role="button" aria-expanded="false" aria-controls="subcategories-for-{{ $category->id }}" class="btn btn-link">
                                                    <i class="material-icons">keyboard_arrow_down</i>
                                                </a>
                                            @endif
                                    
                                            <a href="{{ route('categories.edit', $category) }}" class="btn-options btn-edit"><i class="material-icons">create</i></a>
                                    
                                            @include('admin.categories.partials.delete-category-form', [
                                                'categoryId' => $category->id,
                                                'categoryName' => $category->name,
                                            ])
                                        </div>
                                    </td>            
                                </tr>    
                                <tr>
                                    <td colspan="4" class="p-0">
                                        <div class="collapse list-subcat" id="subcategories-for-{{ $category->id }}">
                                            <ul>
                                                @foreach ($category->subcategories as $subcategory)
                                                    <li><span>#{{ str($subcategory->id)->limit(6, "...")}}</span> {{$subcategory->name}}</li>
                                                @endforeach
                                            </ul>
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

                <div class="card-body text-right">
                    @if ($categories->hasPages())
                        {!! $categories->withQueryString()->links() !!}
                    @endif
                </div>


            </div>
        </div>



    </div>
</x-app-layout>
