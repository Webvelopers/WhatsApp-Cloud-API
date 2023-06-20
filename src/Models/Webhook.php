<?php

namespace Webvelopers\WhatsAppCloudApi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Uuid\UuidInterface as Uuid;
use Webvelopers\WhatsAppCloudApi\Enums\WebhookType;

class Webhook extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'webhooks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'data',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => WebhookType::class,
        'data' => 'array',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        //
    ];

    /**
     * Get/Set data webhook.
     */
    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    /**
     * Webhook has one notification.
     */
    public function notification(): HasOne
    {
        return $this->hasOne(Notification::class, 'webhook_id', 'id');
    }

    /**
     * Webhook has one verify token.
     */
    public function verify_token(): HasOne
    {
        return $this->hasOne(VerifyToken::class, 'webhook_id', 'id');
    }
}
