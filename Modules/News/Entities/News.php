<?php

namespace Modules\News\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\DefaultTrait;
use Modules\Initializer\Traits\RelationTrait;
use Modules\Initializer\Traits\TableColumnsTrait;
use Modules\Initializer\Traits\UrlKeyTrait;
use Modules\Files\Entities\File;

class News extends Model
{
  use SoftDeletes, RelationTrait, TableColumnsTrait, UrlKeyTrait, DefaultTrait;

  protected $dates = ['deleted_at','updated_at'];

  protected $table = 'news';

  protected $guarded = [];

  public $form = [
    'id' => [
      'enabled' => true
    ],
    'title' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
        'max' => 255
      ]
    ],
    'content' => [
      'enabled' => true
    ]
  ];

  public function files() {
    return $this->morphMany(File::class, 'fileable');
  }
}
