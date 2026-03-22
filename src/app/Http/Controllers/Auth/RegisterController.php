<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request; // ここは削除

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // ============== 追加 =================
        // 会員登録処理
    public function store(RegisterRequest $request): RedirectResponse
    {
        // バリデーション済みデータだけを受け取る
        $validated = $request->validated();

        // ユーザー作成
        $user = User::create([
            // 画面で入力された氏名を保存する
            'name' => $validated['name'],

            // 画面で入力されたメールアドレスを保存する
            'email' => $validated['email'],

            // パスワードは必ずハッシュ化して保存する
            'password' => Hash::make($validated['password']),
        ]);

        // 登録直後に自動ログイン
        Auth::login($user);

        // セッションIDを新しく作り直す処理（セッション固定化攻撃への対策）
        $request->session()->regenerate();

        return redirect('/mypage/profile');
    }
    // ============== 追加　end =================
}
