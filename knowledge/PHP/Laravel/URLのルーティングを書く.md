PHPバージョンではURLはディレクトリ構成で決まっていた

作成されたディレクトリとファイルで、URLが決まるような形

Laravelでは、ブラウザからURLにアクセスされた場合にサーバーから返す処理を

### web.phpファイル
に記述。ちなみに、web.pHPでファイルで

### アクセスされるURLを全て管理します。

こちらを記述すると、

http://localhost:8085 

もしくは、http://localhost:8085/○○○○○○

と言った、laravelローカル環境下のページが表示されるようになる。

##　ファイルの場所

### routes/web.php

## 記述方法

初期の状態は、こんな感じ
```php
// ------------ ここから変更する -----------------
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// ------------ ここまで変更する -----------------

```

編集すると、こんな感じ
```php
Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login.index');
Route::get('/user', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('user.register');
Route::get('/memo', function() {
    return view("memo");
})->name('memo.index');

Auth::routes();


```

