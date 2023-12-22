<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswersModel extends Model
{
    use HasFactory;
    protected $table = 'answers';
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(PostsModel::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'answer_by');
    }

}
