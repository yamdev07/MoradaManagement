<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',  
        'subdomain',
        'domain',
        'email',
        'phone',
        'address',
        'description',
        'logo',
        'is_active',
        'theme_settings',
        'contact_email',
        'contact_phone',
        'database_name',
        'database_user',
        'database_password',
        'status',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'theme_settings' => 'array',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
