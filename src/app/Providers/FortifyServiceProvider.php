<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // ログイン画面のViewを指定
        Fortify::loginView(function () {
            return view('login.login');
        });

        // 会員登録画面のViewを指定
        Fortify::registerView(function () {
            return view('register.register');
        });

        // メール認証画面のViewを指定（未認証ユーザーがアクセス時に表示）
        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        // ログイン後のリダイレクト先を動的に分岐
        app()->singleton(
            \Laravel\Fortify\Contracts\LoginResponse::class,
            function () {
                return new class implements \Laravel\Fortify\Contracts\LoginResponse {
                    public function toResponse($request)
                    {
                        $user = $request->user();

                        // nickname が未登録（null）の場合はプロフィール編集画面へ
                        if (is_null($user->nickname)) {
                            return redirect('/mypage/profile/edit');
                        }

                        // 登録済みならマイページへ
                        return redirect('/mypage');
                    }
                };
            }
        );
    }
}
