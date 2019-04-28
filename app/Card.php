<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['user_id', 'japanese', 'english', 'audience_selector'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }    
    public function good_users()
    {
        return $this->belongsToMany(User::class, 'good', 'card_id', 'user_id')->withTimestamps();    
    }
}
