<?php
namespace Modules\Files\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
  protected $fillable = [
      'fileable_id', 'fileable_type', 'type_file_id', 'config', 'original_name'
  ];

  /**
   * Get all the owning fileable models
   * @return \Illuminate\Database\Eloquent\Relations\MorphTo
   */
  public function fileable() {
      return $this->morphTo();
  }

  public function typeFile() {
    return $this->belongsTo('Modules\Files\Entities\TypeFile');
  }

  protected $casts = [
    'config' => 'collection',
  ];

  protected static function boot()
  {
      parent::boot(); // TODO: Change the autogenerated stub

      static::deleting(function($file) {
          $full_size_dir = storage_path('app/public/');
          foreach ($file->config as $itemFiles) {
            foreach ($itemFiles as $itemFile) {
              $fileDir = $full_size_dir.$itemFile["filename"];
              unlink($fileDir);
            }
          }
      });
  }
}