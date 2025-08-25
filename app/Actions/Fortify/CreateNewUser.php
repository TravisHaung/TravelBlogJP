<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $avatarPath = 'app/public/avatars/default-avatar.png';

        if (request()->hasFile('avatar')) {
            // 對 request() 做驗證
            request()->validate(['avatar' => ['image','max:2048'],]);
            $path = request()->file('avatar')->store('avatars', 'public');
            $avatarPath = 'storage/'.$path;
        }
        //dd($input, request()->file('avatar'));

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'email_verified_at' => now(), // 註冊時自動驗證
            'avatar' => $avatarPath, // 給一個預設頭像
        ]);
    }
}
