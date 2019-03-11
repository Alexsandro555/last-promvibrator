<?php

namespace Modules\Product\Repositories\LineProduct;

interface LineProductRepository
{
  public function getAll();

  public function getById($id);

  public function create(array $attributes);

  public function update($id, array $attributes);

  public function delete($id);
}

