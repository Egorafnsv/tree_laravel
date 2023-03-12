<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Relation extends Model
{
    use HasFactory;
    protected $table = "relations";
    public function directory(): BelongsTo
    {
        return $this->belongsTo(Dicrectory::class, 'id', 'parent_id');
    }
}
