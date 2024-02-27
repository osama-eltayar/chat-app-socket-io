<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static self create(array $data)
 */
class Message extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //########################################### Constants ################################################


    //########################################### Attributes ################################################
    protected function content(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => encrypt($value),
            get: fn(string $value) => decrypt($value),
        );
    }


    //########################################### Scopes ###################################################
    public function scopeBetweenUsers($query, $firstUserId, $secondUserId)
    {
        return $query->where(['sender_id' => $firstUserId, 'receiver_id' => $secondUserId])
            ->orWhere(function ($query) use ($firstUserId, $secondUserId) {
                $query->where(['sender_id' => $secondUserId, 'receiver_id' => $firstUserId]);
            });
    }


    //########################################### Relations ################################################


}
