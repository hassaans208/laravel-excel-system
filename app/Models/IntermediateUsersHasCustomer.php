<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntermediateUsersHasCustomer extends Model
{
    use HasFactory;
    protected $table = 'users_has_customers';

    protected $fillable = [
        'user_id',
        'customer_id'
    ];

}
