<?php

namespace App\Infra\Models;

use App\Domain\Role;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasFactory, Notifiable;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function transactions_sender()
    {
        return $this->hasMany(Transaction::class, 'sender_id');
    }

    public function transactions_receiver()
    {
        return $this->hasMany(Transaction::class, 'receiver_id');
    }
}
