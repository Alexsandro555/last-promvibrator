<?php
/**
 * Created by PhpStorm.
 * User: alexsandro
 * Date: 19.04.18
 * Time: 14:47
 */

namespace Modules\Files\Contracts;

interface Uploader {
  public function upload($file, $name, $absolute, $width, $height);
}