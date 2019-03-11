<?php
namespace Modules\Cart\Repositories;

interface CartRepository
{
  public function getAll();

  public function deleteAll();
}