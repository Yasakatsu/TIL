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

※参照情報
[Laravelのディレクトリ階層]([knowledge/PHP/Laravel/各、ディレクトリの意味.md](https://github.com/Yasakatsu/TIL/blob/main/knowledge/PHP/Laravel/%E5%90%84%E3%80%81%E3%83%87%E3%82%A3%E3%83%AC%E3%82%AF%E3%83%88%E3%83%AA%E3%81%AE%E6%84%8F%E5%91%B3.md))

`/作成したディレクトリ/app/Http/Controllers/Auth/LoginController.php`

対象のメソッド処理は・・・

LoginControllerの**トレイトとして使用されている下記に記載**

`/作成したディレクトリ/vendor/laravel/ui/auth-backend/AuthenticatesUsers.php`

LoginController.phpの中でトレイトを使用するように

use AuthenticatesUsers;の一文があります。

vendor配下はcomposerでインストールしたライブラリが入るディレクトリになる

ファイルを開いて、対象を確認すると下記のようになっている

```php
public function showLoginForm()
{
    return view('auth.login');
}

```
中身はreturnでviewを返していますね。

このようにreturnを使用してviewを返すように処理を実行すると、引数で渡されている画面の内容を表示してくれます。

このview関数は**Laravel全体で使える関数**になります。こういう関数を

### ヘルパーといいます。

因みに、対象の画面は下記に配置されることになる

`/作成したディレクトリ/resources/views/auth/login.blade.php`
`.blade.php`はLaravelの画面(view)ファイルになります。

viewヘルパーはviewsの配下からファイルをみてくれます。

## 豆知識

今回のauth.loginを指定している中で、Laravelでは**「.」**で、

### 下のディレクトリを表す

なので、auth.loginと記述するとauth配下のloginページが呼ばれているということになる。

## ２つめ
### ユーザー登録画面の表示について(/userにアクセス)
(/userにアクセスした場合はユーザー登録画面を表示)

１と同じように、処理する内容については、

`RegisterController@showRegistrationForm`が使用

RegisterControllerは下記にファイルがあります。

`/作成したディレクトリ/app/Http/Controllers/Auth/RegisterController.php
`

1と同じくして、

`RegisterController`のコントローラを参照しても、`showRegistrationFormメソッド`は書いていません。

これもコントローラ内でトレイトを定義して(use RegistersUsers)、

そっちで処理を使うようになってる

トレイトのファイルは下記

`/作成したディレクトリ/vendor/laravel/ui/auth-backend/RegistersUsers.php
`

中身は、こんな感じ。

```php
public function showRegistrationForm()
{
    return view('auth.register');
}

```
処理の内容としては、シンプルで

`作成したディレクトリ/resources/views`に配置されている

auth配下にある`register.blade.php`の画面を表示しているだけ

## ３つめ
### メモ投稿画面の表示について(/memoにアクセス)
```php
Route::get('/memo', function() {
    return view("memo");
})->name('memo.index');

```
第2引数の処理内容は、

`PHPのクロージャ`を記述

中にはreturn `view("memo")`が書いているだけ

処理の内容としては、

`作成したディレクトリ/resources/views`配下に配置されている`memo.blade.php`が表示される

### このようにURLにアクセスされた場合の処理を、クロージャに直接書くこともできます。

それぞれのURL定義についている、
`->name('memo.index')`ですが、

これはURLに別名を付ける事ができ、

Laravel内でアクセスする場合に使用できる。
