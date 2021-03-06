<?php
/**
 * Created by PhpStorm.
 * User: m_ibr
 * Date: 21/10/2017
 * Time: 10:02 AM
 */

namespace App;


use App\Models\Favorite;

trait Favoriteable
{
    protected static function bootFavoriteable(){

        static::deleting(function ($model){
            $model->favorite->each->delete();
        });
    }

    public function addFavorite(){
        $u=auth()->user()->id;
        if(!$this->favorite()->where('user_id',$u)->exists()){
            return  $this->favorite()->create([
                "user_id" =>$u,
                "favorite_id" =>$this->id,
                "favorite_type" =>get_class($this),
            ]);
        }{
            $this->favorite()->where('user_id',$u)->delete();
        }

    }

    public function isFavorite(){
        return $this->favorite()->where('user_id',auth()->user()->id)->exists();

    }
    public function getIsFavoriteAttribute(){

        return $this->isFavorite();
    }
    public function favorite(){

        return $this->morphMany(Favorite::class,'favorite');
    }

    public function unFavorite(){
        $attr=["user_id"=> auth()->user()->id];
         return $this->favorite()->where($attr)->get()->each->delete();
    }

}