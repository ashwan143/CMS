<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    /**
     * Fields that can be mass assigned.
     */
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'status',
        'created_by',
    ];


    /**
     * Cast database values to proper PHP types.
     */
    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }


    /**
     * Get a setting value.
     */
    public static function getValue(
        string $key,
        mixed $default = null
    ): mixed {

        return Cache::remember(
            'setting.' . $key,
            now()->addHours(12),
            function () use ($key, $default) {

                $setting = static::where('key', $key)
                    ->where('status', true)
                    ->first();

                return $setting?->value ?? $default;
            }
        );
    }
    /**
 * Get all active settings as a key/value array.
 */
public static function getAll(): array
{
    return Cache::remember(
        'settings.all',
        now()->addHours(12),
        function () {
            return static::active()
                ->pluck('value', 'key')
                ->toArray();
        }
    );
}


    /**
     * Create or update a setting.
     */
    public static function setValue(
        string $key,
        mixed $value,
        ?string $group = null,
        ?string $type = null,
        ?int $createdBy = null
    ): static {

        $setting = static::where('key', $key)->first();

        if ($setting) {

            $setting->update([
                'value' => $value,
                'updated_at' => now(),
            ]);

        } else {

            $setting = static::create([
                'key' => $key,
                'value' => $value,
                'group' => $group ?? 'general',
                'type' => $type ?? 'text',
                'status' => true,
                'created_by' => $createdBy,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Clear Cached Value
        |--------------------------------------------------------------------------
        */

        Cache::forget('setting.' . $key);
        Cache::forget('settings.all');


        return $setting;
    }


    /**
     * Clear the cache of a setting.
     */
    public static function clearCache(string $key): void
    {
        Cache::forget('setting.' . $key);
    }


    /**
     * Get all active settings.
     */
    public static function active(): \Illuminate\Database\Eloquent\Builder
    {
        return static::query()
            ->where('status', true);
    }


    /**
     * Get settings belonging to a group.
     */
    public static function byGroup(string $group)
    {
        return static::query()
            ->where('group', $group)
            ->where('status', true)
            ->orderBy('id');
    }
}
