<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property float  amount
 * @property int    from_user_id
 * @property int    from_to_id
 * @property string status
 */
class Transaction extends Model
{
    use HasFactory;


    const STATUS_DRAFT     = "draft";
    const STATUS_CONFIRMED = "confirmed";
    const STATUS_REJECTED  = "rejected";


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'amount',
        'status',
    ];



    /**
     * relation with TransactionAttachment model
     *
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(TransactionAttachment::class);
    }



    /**
     * relation with User model for the payer instance
     *
     * @return BelongsTo
     */
    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(User::class, "from_user_id");
    }



    /**
     * relation with User model for the receiver instance
     *
     * @return BelongsTo
     */
    public function toUser(): BelongsTo
    {
        return $this->belongsTo(User::class, "to_user_id");
    }
}
