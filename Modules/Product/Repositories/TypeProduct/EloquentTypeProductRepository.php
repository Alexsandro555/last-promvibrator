<?php

namespace Modules\Product\Repositories\TypeProduct;

use Modules\Product\Entities\TypeProduct;

class EloquentTypeProductRepository implements Repository
{
  private $model;

  /**
   * EloquentOrderRepository constructor.
   * @param TypeProduct $model
   */
  public function __construct(TypeProduct $model)
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

