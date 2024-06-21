<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToPrimaryModel;

class Product extends Model
{
    use HasFactory;
    use BelongsToPrimaryModel;

    public function getRelationshipToPrimaryModel(): string
    {
        return 'sections';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'productId',
        'ownerId',
        'title',
        'description',
        'thumbnailUrl',
        'onlineDate',
        'publishDate',
        'estimatedReadTime',
        'nbPages',
        'authors',
        'ownerUsername',
        'ownerDisplayableUserName',
        'language',
        'link',
        'category_id',
        'theme_id',
        'tag_id'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'onlineDate' => 'datetime',
            'publishDate' => 'datetime',
            'estimatedReadTime' => 'string',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Catalogue::class, 'category_id');
    }
    public function theme()
    {
        return $this->belongsTo(Catalogue::class, 'theme_id');
    }
    public function tag()
    {
        return $this->belongsTo(Catalogue::class, 'tag_id');
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'product_section')->withPivot('order')->orderBy('order');
    }
}
