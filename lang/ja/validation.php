<?php

return [
    'accepted' => ':attributeを承認してください。',
    'accepted_if' => ':otherが:valueのとき、:attributeを承認してください。',
    'active_url' => ':attributeは有効なURLではありません。',
    'after' => ':attributeには、:date以降の日付を指定してください。',
    'after_or_equal' => ':attributeには、:date以降または同日の日付を指定してください。',
    'alpha' => ':attributeにはアルファベットのみ使用できます。',
    'alpha_dash' => ':attributeにはアルファベット、数字、ダッシュ、アンダースコアのみ使用できます。',
    'alpha_num' => ':attributeにはアルファベットと数字のみ使用できます。',
    'array' => ':attributeには配列を指定してください。',
    'before' => ':attributeには、:date以前の日付を指定してください。',
    'before_or_equal' => ':attributeには、:date以前または同日の日付を指定してください。',
    'between' => [
        'array' => ':attributeには:minから:max件の項目を指定してください。',
        'file' => ':attributeには:minから:maxキロバイトのサイズを指定してください。',
        'numeric' => ':attributeには:minから:maxの値を指定してください。',
        'string' => ':attributeには:minから:max文字を指定してください。',
    ],
    'boolean' => ':attributeにはtrueまたはfalseを指定してください。',
    'confirmed' => ':attributeの確認が一致しません。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attributeは有効な日付ではありません。',
    'date_equals' => ':attributeには、:dateと同じ日付を指定してください。',
    'date_format' => ':attributeは、:format形式と一致しません。',
    'declined' => ':attributeを拒否してください。',
    'declined_if' => ':otherが:valueのとき、:attributeを拒否してください。',
    'different' => ':attributeと:otherは異なる値を指定してください。',
    'digits' => ':attributeには:digits桁の数字を指定してください。',
    'digits_between' => ':attributeには:minから:max桁の数字を指定してください。',
    'dimensions' => ':attributeの画像サイズが無効です。',
    'distinct' => ':attributeには重複した値があります。',
    'email' => ':attributeには有効なメールアドレスを指定してください。',
    'ends_with' => ':attributeは、:valuesのいずれかで終わる必要があります。',
    'enum' => '選択された:attributeは無効です。',
    'exists' => '選択された:attributeは無効です。',
    'file' => ':attributeにはファイルを指定してください。',
    'filled' => ':attributeには値を指定してください。',
    'gt' => [
        'array' => ':attributeには:value件を超える項目を指定してください。',
        'file' => ':attributeには:valueキロバイトを超えるサイズを指定してください。',
        'numeric' => ':attributeには:valueより大きい値を指定してください。',
        'string' => ':attributeには:value文字より多い文字を指定してください。',
    ],
    'gte' => [
        'array' => ':attributeには:value件以上の項目を指定してください。',
        'file' => ':attributeには:valueキロバイト以上のサイズを指定してください。',
        'numeric' => ':attributeには:value以上の値を指定してください。',
        'string' => ':attributeには:value文字以上の文字を指定してください。',
    ],
    'image' => ':attributeには画像を指定してください。',
    'in' => '選択された:attributeは無効です。',
    'in_array' => ':attributeは:otherに存在しません。',
    'integer' => ':attributeには整数を指定してください。',
    'ip' => ':attributeには有効なIPアドレスを指定してください。',
    'ipv4' => ':attributeには有効なIPv4アドレスを指定してください。',
    'ipv6' => ':attributeには有効なIPv6アドレスを指定してください。',
    'json' => ':attributeには有効なJSON文字列を指定してください。',
    'lowercase' => ':attributeは小文字で指定してください。',
    'lt' => [
        'array' => ':attributeには:value件未満の項目を指定してください。',
        'file' => ':attributeには:valueキロバイト未満のサイズを指定してください。',
        'numeric' => ':attributeには:valueより小さい値を指定してください。',
        'string' => ':attributeには:value文字未満の文字を指定してください。',
    ],
    'lte' => [
        'array' => ':attributeには:value件以下の項目を指定してください。',
        'file' => ':attributeには:valueキロバイト以下のサイズを指定してください。',
        'numeric' => ':attributeには:value以下の値を指定してください。',
        'string' => ':attributeには:value文字以下の文字を指定してください。',
    ],
    'mac_address' => ':attributeには有効なMACアドレスを指定してください。',
    'max' => [
        'array' => ':attributeには:max件以下の項目を指定してください。',
        'file' => ':attributeには:maxキロバイト以下のサイズを指定してください。',
        'numeric' => ':attributeには:max以下の値を指定してください。',
        'string' => ':attributeには:max文字以下の文字を指定してください。',
    ],
    'mimes' => ':attributeには、:valuesタイプのファイルを指定してください。',
    'mimetypes' => ':attributeには、:valuesタイプのファイルを指定してください。',
    'min' => [
        'array' => ':attributeには:min件以上の項目を指定してください。',
        'file' => ':attributeには:minキロバイト以上のサイズを指定してください。',
        'numeric' => ':attributeには:min以上の値を指定してください。',
        'string' => ':attributeには:min文字以上の文字を指定してください。',
    ],
    'multiple_of' => ':attributeは:valueの倍数でなければなりません。',
    'not_in' => '選択された:attributeは無効です。',
    'not_regex' => ':attributeの形式が無効です。',
    'numeric' => ':attributeには数字を指定してください。',
    'password' => [
        'letters' => ':attributeには文字を含めてください。',
        'mixed' => ':attributeには大文字と小文字の両方を含めてください。',
        'numbers' => ':attributeには数字を含めてください。',
        'symbols' => ':attributeには記号を含めてください。',
        'uncompromised' => '指定された:attributeは漏洩しています。別のものを選択してください。',
    ],
    'present' => ':attributeが存在していません。',
    'regex' => ':attributeの形式が無効です。',
    'required' => ':attributeは必須です。',
    'required_array_keys' => ':attributeには、:valuesの項目が必要です。',
    'required_if' => ':otherが:valueのとき、:attributeは必須です。',
    'required_if_accepted' => ':otherが承認された場合、:attributeは必須です。',
    'required_without' => ':valuesが指定されていない場合、:attributeは必須です。',
    'required_without_all' => ':valuesのいずれも指定されていない場合、:attributeは必須です。',
    'same' => ':attributeと:otherは同じ値を指定してください。',
    'size' => [
        'array' => ':attributeには:size件の項目を指定してください。',
        'file' => ':attributeには:sizeキロバイトのサイズを指定してください。',
        'numeric' => ':attributeには:sizeの値を指定してください。',
        'string' => ':attributeには:size文字を指定してください。',
    ],
    'starts_with' => ':attributeは、:valuesのいずれかで始まる必要があります。',
    'string' => ':attributeには文字列を指定してください。',
    'timezone' => ':attributeには有効なタイムゾーンを指定してください。',
    'unique' => ':attributeはすでに使用されています。',
    'uploaded' => ':attributeのアップロードに失敗しました。',
    'url' => ':attributeの形式が無効です。',
    'uuid' => ':attributeには有効なUUIDを指定してください。',

    'costom' => [
        '属性名' => [
            'ルール名' => 'カスタムメッセージ',
        ],
    ],

    'attributes' => [
        'name' => '名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード確認',
        'remember' => 'ログイン状態を保持する',
        'current_password' => '現在のパスワード',
        'new_password' => '新しいパスワード',
        'new_password_confirmation' => '新しいパスワード確認',
    ],
];
