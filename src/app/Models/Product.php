<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',         // 商品名
        'price',        // 価格
        'image',        // 画像パス
        'description',  // 商品説明
    ];

    public $timestamps = true; // タイムスタンプを有効化（デフォルト設定）

    /**
     * リレーション: 季節
     */
    public function seasons()
    {
        return $this->belongsToMany(Season::class);
    }
}
