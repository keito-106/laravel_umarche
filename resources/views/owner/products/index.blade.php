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
                    <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">

                        @foreach ($ownerInfo as $owner)
                            @foreach ($owner->shop->product as $product)
                                {{-- 2. カードの構造を修正 --}}
                                <div class="w-full">
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
                                            {{-- 3. 画像を正方形に --}}
                                            <div class="w-full aspect-square">
                                                <x-thumbnail filename="{{ $product->imageFirst->filename ?? '' }}"
                                                    type="products" />
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
