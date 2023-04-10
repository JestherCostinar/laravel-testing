<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div>
                    <form method="post" action="{{ route('products.update', $product) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="product_name" :value="__('Name')" />
                            <x-text-input id="product_name" name="name" type="text" class="mt-1 block w-full" value="{{ $product->name }}"/>
                            <x-input-error :messages="$errors->storeProduct->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="product_price" :value="__('Price')" />
                            <x-text-input id="product_price" name="price" type="number" class="mt-1 block w-full" value="{{ $product->price }}" />
                            <x-input-error :messages="$errors->storeProduct->get('price')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
