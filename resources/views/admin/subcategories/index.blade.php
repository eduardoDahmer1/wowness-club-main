<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-x-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @lang('Subcategories')
            </h2>
            <a href="{{ route('subcategories.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('New') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="sm:overflow-x-auto md:overflow-hidden flex flex-wrap flex-col">
                        <table class="min-w-full">
                            <thead>
                                <tr class="text-left">
                                    <th>@lang('Icon')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Description')</th>
                                    <th>@lang('Parent Category')</th>
                                    <th>@lang('Created At')</th>
                                    <th>@lang('Updated At')</th>
                                    <th>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subcategories as $subcategory)
                                    <tr>
                                        <td><img width="50px" src="{{ asset('storage/'.$subcategory->icon) }}"></td>
                                        <td>{{ $subcategory->name }}</td>
                                        <td>{{ $subcategory->description }}</td>
                                        <td>{{ $subcategory->category->name }}</td>
                                        <td>{{ $subcategory->created_at->format('m/d/Y H:i:s') }}</td>
                                        <td>{{ $subcategory->updated_at->format('m/d/Y H:i:s') }}</td>
                                        <td>
                                            <a href="{{ route('subcategories.edit', $subcategory) }}">Edit</a>
                                            @include('subcategories.partials.delete-subcategory-form', [
                                                'subcategory' => $subcategory->id,
                                            ])
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

                        @if ($subcategories->hasPages())
                            {!! $subcategories->withQueryString()->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
