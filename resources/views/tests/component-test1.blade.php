<x-tests.app>
    <x-slot name="header">ヘッダー1</x-slot>
    コンポーネントテスト1

    <x-tests.card title="タイトル1" content="本文1" :message="$message" />
    <x-tests.card title="タイトル1" />
    <x-tests.card title="CSSを変更したい" class="bg-red-200" />
</x-tests.app>
