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
        return $this->belongsToMany(Card::class, 'good', 'user_id', 'card_id')->withTimestamps();    
    }    

    public function good($card_id)//goodする機能
    {
        // 既に良いねしたかの確認
        $good_exist = $this->pressed_good($card_id);
        $bad_exist = $this->pressed_bad($card_id);
    
        if ($good_exist) {
            // 既に良いねしていれば何もしない
            return false;
        } elseif($bad_exist) {
            // Badしてれば書き換えて良いねする
            //ユーザがgoodしたカードのうち当該カードのレコードを取得
            //$this->good_cards()->where('card_id', $card_id);
            $this->good_cards()->updateExistingPivot($card_id, ['good' => 'good']);
            return true;
        } else {
            //goodもbadもしてなければレコードを作ってgoodカラムをgoodにする
            $this->good_cards()->attach($card_id, ['good' => 'good']);
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
        } elseif($good_exist) {
            // goodしてれば書き換えてbadする
            //ユーザがgoodしたカードのうち当該カードのレコードを取得
            $this->good_cards()->updateExistingPivot($card_id, ['good' => 'bad']);
            return true;
        } else {
            //goodもbadもしていなければレコードを作成してgoodカラムをbadにする
            $this->good_cards()->attach($card_id, ['good' => 'bad']);
            return true;
        }
    }

    public function cancel_good($card_id)
    {
        // 既に良いねしたかの確認
        $good_exist = $this->pressed_good($card_id);
        $bad_exist = $this->pressed_bad($card_id);
        
        if ($good_exist||$bad_exist) {
            // 既に良いねしていればレコード削除
            $this->good_cards()->detach($card_id);
            return true;
        } else {
            // 良いねしてなければ何もしない
            return false;
        }
    }
    
    public function pressed_good($card_id)
    {
        return $this->good_cards()->where('card_id', $card_id)->where('good', 'good')->exists();
    }    
    
    public function pressed_bad($card_id)
    {
        return $this->good_cards()->where('card_id', $card_id)->where('good', 'bad')->exists();
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
