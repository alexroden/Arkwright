<?php

namespace App\Concerns;

use Ramsey\Uuid\Uuid;

trait HasToken
{
    protected static function bootHasToken()
    {
        static::creating(function ($model) {
            if (!$model->token) {
                $model->token = (string) Uuid::uuid4();
            }
        });
    }

    /**
     * @param string   $token
     * @param string[] $columns
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function findByToken(string $token, $columns = ['*']): self
    {
        return static::where('token', '=', $token)->firstOrFail($columns);
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'token';
    }
}
