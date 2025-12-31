<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'role',
        'bio',
        'image',
        'email',
        'linkedin',
        'twitter',
        'team_type',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    public function scopeLeadership($query)
    {
        return $query->where('team_type', 'leadership');
    }

    public function scopeProjectLeads($query)
    {
        return $query->where('team_type', 'project_lead');
    }

    public function scopeStaff($query)
    {
        return $query->where('team_type', 'staff');
    }
}
