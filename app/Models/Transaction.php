<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    protected $with = ['ticketType', 'product'];

    const STATUS_PENDING = 'Pending';
    const STATUS_SUCCESS = 'Success';
    const STATUS_CANCELED = 'Canceled';

    // Method untuk menggenerate unique_id
    // public function generateUniqueId($length = 8)
    // {
    //     $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    //     $uniqueId = '';

    //     for ($i = 0; $i < $length; $i++) {
    //         $uniqueId .= $characters[random_int(0, strlen($characters) - 1)];
    //     }

    //     return $uniqueId;
    // }

    public function markAsSuccess()
    {
        $this->status = 'Success';
        // if (is_null($this->unique_id)) {
        //     $this->unique_id = $this->generateUniqueId();
        // }
        $this->save();
    }

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isSuccess()
    {
        return $this->status === self::STATUS_SUCCESS;
    }

    public function isCanceled()
    {
        return $this->status === self::STATUS_CANCELED;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function ticketType(): BelongsTo
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id');
    }
}
