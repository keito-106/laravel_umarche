<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            画像管理
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message status="session('status')" />
                    <div class="flex justify-end mb-4">
                        <button onclick="location.href='{{ route('owner.images.create') }}'"
                            class=" text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">新規登録</button>
                    </div>
                    <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">

                        @foreach ($images as $image)
                            {{-- 2. カードの構造を、他のページと統一 --}}
                            <div class="w-full">
                                <a href="{{ route('owner.images.edit', ['image' => $image->id]) }}">
                                    <div class="border rounded-md overflow-hidden">
                                        {{-- 画像エリアを正方形に --}}
                                        <div class="w-full aspect-square">
                                            <x-thumbnail :filename="$image->filename" type="products" />
                                        </div>
                                        {{-- テキストエリア --}}
                                        <div class="py-1 px-2">
                                            <h2 class="text-gray-900 text-sm font-medium line-clamp-2 h-6">
                                                {{ $image->title ?? '' }}
                                            </h2>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>

                    {{ $images->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
