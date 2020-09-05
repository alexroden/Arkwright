<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    sku
 * @property string plu
 * @property string name
 * @property string size
 * @property string size_sort
 */
class Product extends Model
{
    /**
     * @var string[]
     */
    const FILE_MAPPING = [
        'sku',
        'plu',
        'name',
        'size',
        'size_sort',
    ];

    /**
     * @var string[]
     */
    const CLOTHING_SIZES = [
        'XS',
        'S',
        'M',
        'L',
        'XL',
        'XXL',
        'XXXL',
        'XXXXL',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'sku',
        'plu',
        'name',
        'size',
        'size_sort',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'sku'       => 'int',
        'plu'       => 'string',
        'name'      => 'string',
        'size'      => 'string',
        'size_sort' => 'string',
    ];
}
