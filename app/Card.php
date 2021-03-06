<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['user_id', 'japanese', 'english', 'audience_selector', 'phonetic'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }    
    public function good_users()
    {
        return $this->belongsToMany(User::class, 'good', 'card_id', 'good_user_id')->withTimestamps();    
    }
    public function bad_users()
    {
        return $this->belongsToMany(User::class, 'bad', 'card_id', 'bad_user_id')->withTimestamps();    
    }   
}
