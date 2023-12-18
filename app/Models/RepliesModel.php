<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepliesModel extends Model
{
    use HasFactory;
    protected $table = 'replies';
    protected $guarded = [];

    public function answer()
    {
        return $this->belongsTo(AnswersModel::class, 'answer_id');
    }
}
