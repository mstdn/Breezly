<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use Likeable;

    // Also load default related tabled
    protected $with = ['user'];

    // Search function
    public function scopeFilter($query, array $filters)
    {
        // Search for status
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query
                ->where('content', 'like', '%' . $search . '%')
                    ->orWhere('user', 'like', '%' . $search . '%')
            );
    }
    public function incrementReadCount() 
    {
        $this->reads++;
        return $this->save();
    }
    // Relation to user
    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
