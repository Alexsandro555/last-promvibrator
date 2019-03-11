<?php

namespace Modules\Product\Repositories\ProductCategory;

use Modules\Product\Entities\ProductCategory;

class EloquentProductCategoryRepository implements ProductCategoryRepository
{
  private $model;

  /**
   * EloquentOrderRepository constructor.
   * @param ProductCategory $model
   */
  public function __construct(ProductCategory $model)
  {
    $this->model = $model;
  }

  public function getAll()
  {
    return $this->model->all();
  }

  public function getById($id)
  {
    // TODO: Implement getById() method.
  }

  public function create(array $attributes)
  {
    // TODO:: Implement create() method.
  }

  public function update($id, array $attributes)
  {
    // TODO: Implement update() method.
  }

  public function delete($id)
  {
    // TODO: Implement delete() method.
  }

}

