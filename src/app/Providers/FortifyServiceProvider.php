<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * サービスコンテナへの登録処理
     */
    public function register(): void
    {
        // 会員登録後の遷移先を変更する
        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse {
            public function toResponse($request)
            {
                return redirect('/mypage/profile');
            }
        });
    }

    /**
     * 起動時の設定処理
     */
    public function boot(): void
    {
        // ログイン画面の表示先を指定する
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // 会員登録画面の表示先を指定する
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // ログイン試行回数を制限する
        RateLimiter::for('login', function (Request $request) {
            // メールアドレスが未入力でも安全に文字列化する
            $email = (string) $request->input('email', '');

            // メールアドレス + IP で制限単位を作る
            return Limit::perMinute(10)->by($email . '|' . $request->ip());
        });
    }
}