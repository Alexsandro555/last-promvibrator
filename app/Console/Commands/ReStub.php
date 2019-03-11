<?php

namespace App\Console\Commands;

use Nwidart\Modules\Support\Stub;

class ReStub extends Stub
{
  /**
   * Get stub path.
   *
   * @return string
   */
  public function getPath()
  {
    return __DIR__.$this->path;
  }
}