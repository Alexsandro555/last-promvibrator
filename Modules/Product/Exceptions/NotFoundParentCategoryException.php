<?php
  namespace Modules\Product\Exceptions;

  use Throwable;

  class NotFoundParentCategoryException extends  myNotFoundException
  {
    public function __construct()
    {
      $message = $this->create(func_get_args());
      parent::__construct();
    }
  }