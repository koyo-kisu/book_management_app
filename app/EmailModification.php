<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailModification extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'token',
    ];


    public static function build(array $data)
    {
        // 同じユーザが変更しようとした場合、上書きする
        $emailModification = self::updateOrCreate(
            ['user_id' => $data['user_id']],
            [
                'user_id' => $data['user_id'],
                'email' => $data['email'],
                'token' => str_random(250),
            ]
        );
        return $emailModification;
    }
}
