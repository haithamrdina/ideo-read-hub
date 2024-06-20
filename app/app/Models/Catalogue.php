<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Translatable\HasTranslations;

class Catalogue extends Model
{
    use NodeTrait;

    use HasTranslations;

    public $translatable = ['label'];
    protected $guarded = [];

}
