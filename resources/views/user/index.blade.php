<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品一覧
        </h2>
        <form method="get" action="{{ route('items.index') }}">
            <div class="lg:flex lg:justify-around">
                <div class="lg:flex items-center">
                    <select name="category" class="mb-2 lg:mb-0 lg:mr-2">
                        <option value="0" @if (\Request::get('category') === '0') selected @endif>全て</option>
                        @foreach ($categories as $category)
                            <optgroup label="{{ $category->name }}">
                                @foreach ($category->secondary as $secondary)
                                    <option value="{{ $secondary->id }}"
                                        @if (\Request::get('category') == $secondary->id) selected @endif>
                                        {{ $secondary->name }}
                                    </option>
                                @endforeach
                        @endforeach
                    </select>
                    <div class="flex space-x-2 items-center">
                        <div><input name="keyword" class="lg:mr-2" placeholder="何をお探しですか？"
                                value="{{ request('keyword') }}"></div>
                        <div><button
                                class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">検索する</button>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <span class="text-sm">表示順</span><br>
                        <select id="sort" name="sort" class="mr-4">
                            <option value="{{ \Constant::SORT_ORDER['recommend'] }}"
                                @if (\Request::get('sort') === \Constant::SORT_ORDER['recommend']) selected @endif>おすすめ順
                            </option>
                            <option value="{{ \Constant::SORT_ORDER['higherPrice'] }}"
                                @if (\Request::get('sort') === \Constant::SORT_ORDER['higherPrice']) selected @endif>料金の高い順
                            </option>
                            <option value="{{ \Constant::SORT_ORDER['lowerPrice'] }}"
                                @if (\Request::get('sort') === \Constant::SORT_ORDER['lowerPrice']) selected @endif>料金の安い順
                            </option>
                            <option value="{{ \Constant::SORT_ORDER['later'] }}"
                                @if (\Request::get('sort') === \Constant::SORT_ORDER['later']) selected @endif>新しい順
                            </option>
                            <option value="{{ \Constant::SORT_ORDER['older'] }}"
                                @if (\Request::get('sort') === \Constant::SORT_ORDER['older']) selected @endif>古い順
                            </option>
                        </select>
                    </div>
                    <div>
                        <span class="text-sm">表示件数</span><br>
                        <select id="pagination" name="pagination">
                            <option value="20" @if (\Request::get('pagination') === '20') selected @endif>20件
                            </option>
                            <option value="50" @if (\Request::get('pagination') === '50') selected @endif>50件
                            </option>
                            <option value="100" @if (\Request::get('pagination') === '100') selected @endif>100件
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message status="success" />
                    <div class="flex flex-wrap -m-2 md:-m-4">
                        @foreach ($products as $product)
                            {{-- 子要素にパディング (p-*) を追加します --}}
                            <div class="w-1/3 md:w-1/4 lg:w-1/5 p-2 md:p-4">
                                <a href="{{ route('items.show', ['item' => $product->id]) }}">
                                    <div class="border rounded-md overflow-hidden">
                                        <div class="w-full aspect-square">
                                            <x-thumbnail filename="{{ $product->filename ?? '' }}" type="products" />
                                        </div>
                                        <div class="p-2">
                                            <h2 class="text-gray-900 text-sm font-medium line-clamp-2 h-10">
                                                {{ $product->name }}
                                            </h2>
                                            <p class="mt-1 text-sm">
                                                ¥{{ number_format($product->price) }}<span
                                                    class="text-xs text-gray-700 hidden md:inline">(税込)</span>
                                            </p>
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
    <script>
        const select = document.getElementById('sort')
        select.addEventListener('change', function() {
            this.form.submit()
        })
        const paginate = document.getElementById('pagination')
        paginate.addEventListener('change', function() {
            this.form.submit()
        })
    </script>
</x-app-layout>
