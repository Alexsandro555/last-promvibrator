<?php

namespace Modules\Initializer\Console;

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
    return __DIR__.'/stubs/'.$this->path;
  }
}