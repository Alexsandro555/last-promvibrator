<?php
namespace Modules\Article\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\RelationTrait;
use Modules\Initializer\Traits\SortTrait;
use Modules\Initializer\Traits\TableColumnsTrait;
use Modules\Initializer\Traits\UrlKeyTrait;
use Modules\Initializer\Traits\DefaultTrait;
use Modules\Files\Entities\File;

class Article extends Model
{
	use SoftDeletes, RelationTrait, TableColumnsTrait, SortTrait, UrlKeyTrait, DefaultTrait;

	protected $guarded=[];

  protected $dates = ['deleted_at','updated_at'];

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

  protected $table = 'articles';

  public function setTitleAttribute($value) {
    $this->attributes['title'] = strip_tags($value);
  }

  public function files() {
    return $this->morphMany(File::class, 'fileable');
  }
}
