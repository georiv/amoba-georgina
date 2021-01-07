<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'First_name', 'Last_name', 'Description',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function scopeBetween(Builder $query, $date, $date2): Builder
    {

        $startDate = new Carbon($date);
        // $startDate->subDays(1);

        $endDate = new Carbon($date2);
        $endDate->addDays(1);

        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }
}
