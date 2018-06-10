<?php

namespace App\Models\Newsletter;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscriber extends Model
{
    const UPDATED_AT = null;

    protected static function boot()
    {
        parent::boot();

        static::creating(function(Subscriber $subscriber) {
            $key = config('app.key');

            if (Str::startsWith($key, 'base64:')) {
                $key = base64_decode(substr($key, 7));
            }

            $subscriber->unsubscribe_token = hash_hmac('sha256', Str::random(40), $key);
        });
    }

    /**
     * @var string
     */
    protected $table = 'subscribers';

    /**
     * @var array
     */
    protected $fillable = ['email', 'name', 'locale', 'receive_newsletters'];

    /**
     * @var array
     */
    protected $casts = [
        'receive_newsletters' => 'boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }
}
