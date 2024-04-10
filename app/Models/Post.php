<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Post extends Model
{
    use HasFactory, Sortable;

    public function IkitaisCountSortable($query, $direction)
    {
        return $query->orderBy('ikitais_count', $direction);
    }

    public function empathiesCountSortable($query, $direction)
    {
        return $query->orderBy('empathies_count', $direction);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ikitais()
    {
        return $this->hasMany(Ikitai::class);
    }

    public function empathies()
    {
        return $this->hasMany(Empathy::class);
    }

    public function Post_reports()
    {
        return $this->hasMany(Post_report::class);
    }
}
