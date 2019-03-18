<?php
namespace Modules\Order\Repositories;

use Modules\Order\Entities\Order;
use App\User;

class EloquentOrderRepository implements OrderRepository
{
  private $model;

  /**
   * EloquentOrderRepository constructor.
   * @param Order $model
   */
  public function __construct(Order $model)
  {
    $this->model = $model;
  }

  public function getAll() {
    return $this->model->all();
  }

  public function getById($id)
  {
    // TODO: Implement getById() method.
  }

  public function create(array $attributes)
  {
    $user = User::where('email', $attributes['email'])->first();
    if($user) {
      $user->update([
        'name' => $attributes['fio'],
        'company_name' => $attributes['company'],
        'telephone' => $attributes['tel']
      ]);
    }
    else {
      $user = User::Create([
        'name' => $attributes['fio'],
        'company_name' => $attributes['company'],
        'telephone' => $attributes['tel'],
        'email' => $attributes['email'],
        'password' => bcrypt(str_random(10))
      ]);
    }

    return $this->model->create([
      'number' => strtoupper(substr(uniqid(sha1(time())),0,5)),
      'user_id' => $user->id,
      'note' => $attributes['description']
    ]);
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