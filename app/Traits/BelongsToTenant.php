<?php

namespace App\Traits;

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

trait BelongsToTenant
{
    /**
     * Boot the trait
     */
    protected static function bootBelongsToTenant()
    {
        static::creating(function ($model) {
            // Automatically assign tenant_id if not set
            if (empty($model->tenant_id) && Auth::check() && Auth::user()->tenant_id) {
                $model->tenant_id = Auth::user()->tenant_id;
            }
        });

        static::addGlobalScope('tenant', function (\Illuminate\Database\Eloquent\Builder $builder) {
            if (app()->has('tenant_id')) {
                $builder->where('tenant_id', app('tenant_id'));
            }
        });
    }

    /**
     * Relation with tenant
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Scope to get records for a specific tenant
     */
    public function scopeForTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }

    /**
     * Get the current tenant
     */
    public function getCurrentTenant()
    {
        return app('current_tenant');
    }
}
