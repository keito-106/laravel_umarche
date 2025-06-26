{{-- x-guest-layout など、ゲスト用のレイアウトを想定しています --}}
<x-guest-layout>
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-8">ECサイトへようこそ</h1>

        <div class="mb-12 p-6 border rounded-lg">
            <h2 class="text-2xl font-semibold mb-4">商品をご購入されるお客様</h2>
            <div class="space-x-4">
                <a href="{{ route('login') }}"
                    class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">ログイン</a>
                <a href="{{ route('register') }}"
                    class="inline-block bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded hover:bg-gray-400">新規登録</a>
            </div>
        </div>

        <div class="p-6 border rounded-lg">
            <h2 class="text-2xl font-semibold mb-4">店舗オーナー様</h2>
            <div class="space-x-4">
                <a href="{{ route('owner.login') }}"
                    class="inline-block bg-green-500 text-white font-bold py-2 px-4 rounded hover:bg-green-700">ログイン</a>
            </div>
            <p class="text-sm text-gray-600 mt-2">※オーナーアカウントは管理者によって作成されます。</p>
        </div>
    </div>

    <div class="mt-16">
        <h2 class="text-2xl font-bold text-center mb-8">おすすめ商品</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($recommendedProducts as $product)
                <div class="border rounded-lg overflow-hidden shadow-lg">
                    <a href="{{ route('items.show', ['item' => $product->id]) }}">
                        {{-- サムネイルコンポーネントを想定 --}}
                        <x-thumbnail filename="{{ $product->filename ?? '' }}" type="products" />
                        <div class="p-4">
                            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">{{ $product->category }}
                            </h3>
                            <h2 class="text-gray-900 title-font text-lg font-medium">{{ $product->name }}</h2>
                            <p class="mt-1">¥{{ number_format($product->price) }}(税込)</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="text-gray-600 body-font mt-20 border-t">
        <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
            <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">©
                2025 {{ config('app.name', 'Laravel') }}
            </p>
            <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
                <a href="{{ route('legal') }}" class="text-gray-500 hover:text-gray-900 ml-4">特定商取引法に基づく表記</a>
                <a href="{{ route('privacy') }}" class="text-gray-500 hover:text-gray-900 ml-4">プライバシーポリシー</a>
            </span>
        </div>
    </footer>
</x-guest-layout>
