<?php
/**
 * Created by PhpStorm.
 * User: alexsandro
 * Date: 24.04.18
 * Time: 9:17
 */

namespace Modules\Files\Classes;
use Illuminate\Support\Facades\Storage;

abstract class AbstractFileUploader
{
  // путь для сохраняемых файлов
  protected $path = "app/public/";

  protected function sanitize($string, $force_lowercase = true, $anal = false)
  {
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
      "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
      "â€”", "â€“", ",", "<", ".", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

    return ($force_lowercase) ?
      (function_exists('mb_strtolower')) ?
        mb_strtolower($clean, 'UTF-8') :
        strtolower($clean) :
      $clean;
  }

  protected function createUniqueFilename( $filename, $extension )
  {
    // Generate token for image
    $imageToken = substr(sha1(mt_rand()), 0, 5);
    return $filename . '-' . $imageToken . '.' . $extension;
  }

  protected function createUniqueFilename2( $filename, $extension )
  {
    $full_size_dir = storage_path($this->path);
    $full_image_path = $full_size_dir . $filename . '.' . $extension;

    if ( file_exists( $full_image_path ) )
    {
      // Generate token for image
      $imageToken = substr(sha1(mt_rand()), 0, 5);
      return $filename . '-' . $imageToken . '.' . $extension;
    }
    return $filename . '.' . $extension;
  }

  protected function size( $photo )
  {
    $image = $this->manager->make( $photo );
    $size = $image->filesize();
    return $size;
  }

  protected function move( $photo, $filename )
  {
    Storage::putFileAs('public',$photo,$filename);
    return $filename;
  }

  protected function resizeAbsolute( $photo, $filename, $width, $height, $path )
  {
    $image = $this->manager->make( $photo )->resize($width,$height)->save(storage_path($this->path) . $filename );
    return $image;
  }

  protected function resizeRelative( $photo, $filename, $width, $height, $path )
  {
    $image = $this->manager->make( $photo );
    $image = $image->resize($width,$height,function($constraing) {
      $constraing->aspectRatio();
      $constraing->upsize();
    })->save(storage_path($this->path) . $filename );
    return $image;
  }
}