<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request; // ここは削除

// =============== 追加 ===================
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
// =============== 追加 end ===================

class LoginController extends Controller
{
    // =============== 追加 ===================
    // ログイン処理
    public function store(LoginRequest $request): RedirectResponse
    {
        // バリデーション済みデータだけを受け取る
        $validated = $request->validated();

        // 認証に使う値だけ取り出す
        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([ 'login' => 'ログイン情報が登録されていません',])
                // onlyInputは、「入力値のうち、指定したものだけを前の画面に戻す(入力値を保持)」機能
                ->onlyInput('email');
        }

        // セッションIDを新しく作り直す処理（セッション固定化攻撃への対策）
        $request->session()->regenerate();

        // intendedは、認証が必要なページにアクセスした後、ログイン画面にリダイレクトされた場合に、元のページにリダイレクトする
        return redirect()->intended('/mypage/profile');
    }
    // =============== 追加 end ===================
}
