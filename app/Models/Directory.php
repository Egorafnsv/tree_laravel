<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Directory extends Model
{
    use HasFactory;
    protected $table = "directories";

    public function subdirectories(): HasMany
    {
        return $this->hasMany(Relation::class, 'parent_id', 'id');
    }

    public function parentDicrectory(): HasOne
    {
        return $this->hasOne(Relation::class, 'child_id', 'id');
    }
}
