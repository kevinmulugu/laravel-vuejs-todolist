<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Uuid;

/**
 * Class TodoItem
 * Created by Kevin Mulugu (kevinmulugu@gmail.com)
 * @package App
 */
class TodoItem extends Model
{
    // include the soft delete trait scope
    // these allows querys records with a where deleted_at IS NOT NULL scope
    // Refer https://laravel.com/docs/7.x/eloquent#soft-deleting
    Use SoftDeletes;

    /**
     * Hidden attrs
     * @var string[]
     */
    protected $hidden = [
        'id', 'deleted_at'
    ];

    /**
     * Autofill the uuid field when the model instance is being created.
     */
    protected static function boot()
    {
        parent::boot();
        self::creating(function($todoInstance) {
            $todoInstance->uuid = Uuid::uuid4()->toString();
        });
    }

    /**
     * Returns route model key name
     * Overridden to uuid
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDateString();
    }
}
