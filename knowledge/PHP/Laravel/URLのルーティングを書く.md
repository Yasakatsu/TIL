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

編集すると、こんな感じ(編集内容は例として記述)
```php
Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login.index');
Route::get('/user', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('user.register');
Route::get('/memo', function() {
    return view("memo");
})->name('memo.index');

Auth::routes();


```

## コードの説明
LaravelではRouteクラスを使用して、ルーティングを定義

Routeクラスのgetメソッドはaタグからのリンクや、ブラウザからURLを入力して、アクセスしてきた場合の処理を記述(HTTP通信でGETアクセスされた場合に使います)

第1引数にドメイン以下のURLを定義

第2引数には処理をする内容を設定

処理の内容は、phpのクロージャを書いてもOK（今回は3つ目がクロージャ記述）

もしくは、コントローラのメソッドも指定できる

今回は

### Route::get

で3つのURLルーティングを記述

## １つめ
### ログイン画面の表示について(/にアクセス)
(/にアクセスした場合は、ログイン画面を表示)

Webアプリケーションの/にアクセスしてきたときは、LoginController@showLoginFormで処理

LoginControllerのshowLoginFormメソッドを使用するようにしています。

下記にファイル自体は存在しますが、対象のメソッドはないので注意

/作成したディレクトリ/app/Http/Controllers/Auth/LoginController.php

対象のメソッド処理は・・・

LoginControllerの**トレイトとして使用されている下記に記載**

/作成したディレクトリ/vendor/laravel/ui/auth-backend/AuthenticatesUsers.php


## ２つめ
## ３つめ





