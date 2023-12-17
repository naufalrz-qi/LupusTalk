<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsModel extends Model
{
    use HasFactory;
    protected $table = 'posts';

    public function topics()
    {
        return $this->belongsToMany(TopicsModel::class, 'post_topics', 'post_id', 'topic_id');
    }

    public function category()
    {
        return $this->belongsTo(GameCategories::class, 'cat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'post_by');
    }
    protected $guarded = [];
}
