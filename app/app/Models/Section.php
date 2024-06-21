<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;
use Wildside\Userstamps\Userstamps;

class Section extends Model
{
    use HasFactory;
    use Userstamps;
    use BelongsToTenant;

    protected $fillable = ['name', 'description', 'visibility', 'order', 'tenant_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_section')->withPivot('order')->orderBy('order');
    }

    // Define an event to set the order attribute before creating a new record
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($section) {
            $section->order = static::max('order') + 1;
        });
    }
}
