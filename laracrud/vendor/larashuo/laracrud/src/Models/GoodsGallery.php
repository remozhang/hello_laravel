<?php

namespace LaraShuo\LaraCrud\Models;

use Illuminate\Database\Eloquent\Model;
use LaraShuo\LaraCrud\Models\Repository\GoodsGalleryRepository;

class GoodsGallery extends Model
{
    use GoodsGalleryRepository;
    protected $table = 'goods_gallery';
    protected $fillable = ['goods_id','goods_thumb','goods_img','goods_original','sort_order'];
}
