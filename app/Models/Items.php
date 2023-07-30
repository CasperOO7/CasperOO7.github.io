<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable=['user_id','title','company','tags','email','website','logo','description','location'];

    use HasFactory;

    public function scopeFilter($query,array $filters)
    {
        if($filters['tag']?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
        if($filters['search']?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
