<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGatewaySetting extends Model
{
    protected $fillable = ['gateway', 'enabled', 'config'];
    
    protected $casts = [
        'enabled' => 'boolean',
        'config' => 'array',
    ];
    
    /**
     * Check if a specific gateway is enabled
     */
    public static function isEnabled(string $gateway): bool
    {
        return self::where('gateway', $gateway)
            ->where('enabled', true)
            ->exists();
    }
    
    /**
     * Get configuration for a specific gateway
     */
    public static function getConfig(string $gateway): ?array
    {
        $setting = self::where('gateway', $gateway)->first();
        return $setting ? $setting->config : null;
    }
}
