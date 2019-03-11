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
        'name' => $attributes['surname'].' '.$attributes['firstname'].' '.$attributes['patronymiс'],
        'company_name' => $attributes['company_name'],
        'telephone' => $attributes['telephone']
      ]);
    }
    else {
      $user = User::Create([
        'name' => $attributes['surname'].' '.$attributes['firstname'].' '.$attributes['patronymiс'],
        'email' => $attributes['email'],
        'company_name' => $attributes['company_name'],
        'password' => bcrypt(str_random(10)),
        'telephone' => $attributes['telephone']
      ]);
    }

    return $this->model->create([
      'number' => strtoupper(substr(uniqid(sha1(time())),0,5)),
      'user_id' => $user->id,
      'note' => $attributes['note']
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