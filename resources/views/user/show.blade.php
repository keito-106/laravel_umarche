<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="md:flex md:justify-around">
                        <div class="md:w-1/2">
                            <div class="swiper-container">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper aspect-square">
                                    <!-- Slides -->
                                    <div class="swiper-slide">
                                        @if ($product->imageFirst)
                                            <img src="{{ asset('storage/products/' . $product->imageFirst->filename) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <img src="">
                                        @endif
                                    </div>
                                    <div class="swiper-slide">
                                        @if ($product->imageSecond)
                                            <img src="{{ asset('storage/products/' . $product->imageSecond->filename) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <img src="">
                                        @endif
                                    </div>
                                    <div class="swiper-slide">
                                        @if ($product->imageThird)
                                            <img src="{{ asset('storage/products/' . $product->imageThird->filename) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <img src="">
                                        @endif
                                    </div>
                                    <div class="swiper-slide">
                                        @if ($product->imageFourth)
                                            <img src="{{ asset('storage/products/' . $product->imageFourth->filename) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <img src="">
                                        @endif
                                    </div>
                                </div>
                                <!-- If we need pagination -->
                                <div class="swiper-pagination"></div>

                                <!-- If we need navigation buttons -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>

                                <!-- If we need scrollbar -->
                                <div class="swiper-scrollbar"></div>
                            </div>
                        </div>
                        <div class="md:w-1/2 ml-4 md:mt-0 mt-4">
                            <h2 class="mb-4 text-sm title-font text-gray-500 tracking-widest">
                                {{ $product->category->name }}
                            </h2>
                            <h1 class="mb-4 text-gray-900 text-3xl title-font font-medium">{{ $product->name }}
                            </h1>
                            <p class="mb-4 leading-relaxed">{{ $product->information }}</p>
                            <form method="post" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                {{-- 数量の行 --}}
                                <div class="flex items-center mb-4">
                                    <span class="mr-3">数量</span>
                                    <div class="relative mr-4">
                                        <select name="quantity"
                                            class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10">
                                            @for ($i = 1; $i <= $quantity; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                {{-- 価格とカートボタンの行 --}}
                                <div class="flex items-center">
                                    <span class="title-font font-medium md:text-2xl sm:text-lg text-gray-900 mr-8"><span
                                            class="text-gray-700">¥</span>{{ number_format($product->price) }}
                                        <span class="text-xs md:text-sm text-gray-700">
                                            (税込)
                                        </span>
                                    </span>
                                    <button
                                        class="flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">カートに入れる</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="border-t border-gray-400 my-8"></div>
                    <div class="mb-4 text-center">この商品を販売しているショップ</div>
                    <div class="mb-4 text-center">{{ $product->shop->name }}</div>
                    <div class="mb-4 text-center">
                        @if ($product->shop->filename !== null)
                            <img class="mx-auto w-40 h-40 object-cover rounded-full"
                                src="{{ asset('storage/shops/' . $product->shop->filename) }}">
                        @else
                            <img src="">
                        @endif
                    </div>
                    <div class="mb-4 text-center">
                        <button data-micromodal-trigger="modal-1" href="javascript:;" type="button"
                            class="text-white bg-gray-400 border-0 py-2 px-6 focus:outline-none hover:bg-gray-500 rounded">ショップの詳細</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal micromodal-slide fixed inset-0 z-50" id="modal-1" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="text-xl text-gray-700 modal__title" id="modal-1-title">
                        {{ $product->shop->name }}
                    </h2>
                    <button type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-1-content">
                    <p>
                        {{ $product->shop->information }}
                    </p>
                </main>
                <footer class="modal__footer">
                    <button type="button" class="modal__btn" data-micromodal-close aria-label="閉じる">閉じる</button>
                </footer>
            </div>
        </div>
    </div>

</x-app-layout>
