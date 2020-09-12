<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class EmailVerification extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'token',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public static function findByIdToken(array $data)
    {
        return \App\EmailVerification::where([
            'id' => $data['id'],
            'token' => $data['token'],
        ])->first();
    }

    public static function build(array $data)
    {
        // 同じアドレスで仮登録した場合、上書きする
        $emailVerification = \App\EmailVerification::updateOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['name'],
                'token' => str_random(250),
                'password' => Hash::make($data['password']),
            ]
        );
        return $emailVerification;
    }
}
