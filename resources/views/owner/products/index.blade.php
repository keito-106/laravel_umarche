<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品管理
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message status="session('status')" />
                    <div class="flex justify-end mb-4">
                        <button onclick="location.href='{{ route('owner.products.create') }}'"
                            class=" text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">新規登録</button>
                    </div>
                    <div class="flex flex-wrap">

                        @foreach ($products as $product)
                            <div class="w-1/3 md:w-1/4 lg:w-1/5 p-2 md:p-4">
                                <a href="{{ route('owner.products.edit', ['product' => $product->id]) }}">
                                    <div class="relative border rounded-md overflow-hidden">
                                        @if (!$product->is_selling)
                                            <div class="absolute top-0 left-0">
                                                <div class="relative">
                                                    <div
                                                        class="absolute top-3 -left-8 w-32 h-6 bg-red-500 text-white text-center font-bold transform -rotate-45">
                                                        SOLD
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="w-full aspect-square">
                                            <x-thumbnail filename="{{ $product->imageFirst->filename ?? '' }}"
                                                type="products" />
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    {{ $products->appends([
                            'sort' => \Request::get('sort'),
                            'pagination' => \Request::get('pagination'),
                        ])->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
