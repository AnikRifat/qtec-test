<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSearchHistory extends Model
{
    use HasFactory;

    protected $table = 'user_search_history';

    protected $fillable = [
        'keyword',
        'user_id',
        'search_time',
        'search_results'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithKeyword($query, $keyword)
    {
        return $query->where('keyword', $keyword);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeFromDate($query, $fromDate)
    {
        return $query->where('search_time', '>=', $fromDate);
    }

    public function scopeToDate($query, $toDate)
    {
        return $query->where('search_time', '<=', $toDate);
    }
}
