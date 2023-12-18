<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsModel extends Model
{
    use HasFactory;
    protected $table = 'posts';

    public function categories()
    {
        return $this->belongsToMany(GameCategories::class, 'post_categories', 'post_id', 'cat_id');
    }

    public function topic()
    {
        return $this->belongsTo(TopicsModel::class, 'topic_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'post_by');
    }
    protected $guarded = [];
}
