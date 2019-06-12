<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PasswordResetNotification;//190522パスワードリセット上書き用

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'native',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function cards()
    {
        return $this->hasMany(Card::class);
    }
    
    public function good_cards()
    {
        return $this->belongsToMany(Card::class, 'good', 'good_user_id', 'card_id')->withTimestamps();    
    }    

    public function bad_cards()
    {
        return $this->belongsToMany(Card::class, 'bad', 'bad_user_id', 'card_id')->withTimestamps();    
    }  

    public function good($card_id)//goodする機能
    {
        // 既に良いねしたかの確認
        $good_exist = $this->pressed_good($card_id);
        $bad_exist = $this->pressed_bad($card_id);
    
        if ($good_exist) {
            // 既に良いねしていれば何もしない
            return false;
        } else {
            if($bad_exist) {
                // Badしてればbadを削除
                $this->bad_cards()->detach($card_id);
            } 
            //goodしてなければレコード作成
            $this->good_cards()->attach($card_id);
            return true;
        }
    }
    
    public function bad($card_id)//badする機能
    {
        // 既にbadしたかの確認
        $good_exist = $this->pressed_good($card_id);
        $bad_exist = $this->pressed_bad($card_id);
    
        if ($bad_exist) {
            // 既にbadしていれば何もしない
            return false;
        } else {
            if($good_exist) {
                // goodしてればgoodを削除する
                $this->good_cards()->detach($card_id);
            }
            //badしていなければレコードを作成
            $this->bad_cards()->attach($card_id);
            return true;
        }
    }

    public function cancel_good($card_id)
    {
        // 既に良いねしたかの確認
        $good_exist = $this->pressed_good($card_id);
        $bad_exist = $this->pressed_bad($card_id);
        
        if ($good_exist) {
            // 既に良いねしていればレコード削除
            $this->good_cards()->detach($card_id);
            return true;           
        } elseif ($bad_exist) {
            $this->bad_cards()->detach($card_id);
            return true;
        } else {
            // goodもbadもしてなければ何もしない
            return false;
        }
    }
    
    public function pressed_good($card_id)
    {
        return $this->good_cards()->where('card_id', $card_id)->exists();
    }    
    
    public function pressed_bad($card_id)
    {
        return $this->bad_cards()->where('card_id', $card_id)->exists();
    }    
    
    /**
     * パスワードリセット通知の送信をオーバーライド
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)//190522追記
    {
      $this->notify(new PasswordResetNotification($token));
    }    
}
