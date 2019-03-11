<?php

namespace Modules\Product\Repositories\Attribute;

use Modules\Product\Entities\Attribute;

class EloquentAttributeRepository implements Repository
{
  private $model;

  /**
   * EloquentOrderRepository constructor.
   * @param Model $model
   */
  public function __construct(Attribute $model)
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

