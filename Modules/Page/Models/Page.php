<?php
namespace Modules\Page\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\RelationTrait;
use Modules\Initializer\Traits\SortTrait;
use Modules\Initializer\Traits\TableColumnsTrait;
use Modules\Initializer\Traits\UrlKeyTrait;
use Modules\Initializer\Traits\DefaultTrait;
use Modules\Files\Entities\File;

class Page extends Model
{
	use SoftDeletes, RelationTrait, TableColumnsTrait, SortTrait, DefaultTrait;

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
    'url_key' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
        'max' => 255,
        'regex' => '^[a-z0-9-]+$',
      ]
    ],
    'content' => [
      'enabled' => true
    ]
  ];

  public function setTitleAttribute($value) {
    $this->attributes['title'] = strip_tags($value);
  }

  protected $table = 'pages';

  public function files() {
    return $this->morphMany(File::class, 'fileable');
  }
}
