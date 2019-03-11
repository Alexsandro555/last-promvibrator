<?php
namespace Modules\Initializer\Traits;

use Illuminate\Http\Request;


trait ControllerTrait {
  public $model;

  public function index(Request $request)
  {
    return $this->model->all();
  }

  public function load(Request $request)
  {
    $values=$request->all();
    $m=$this->model;
    $visible=null;
    $methodanalize=[];
    foreach ($values as $key=>$value)
    {
      switch ($key) {
        case '_order':
          $fields=explode("|",$value);
          $fields[0]=str_replace(".","->",$fields[0]);
          $m=$m->orderBy($fields[0],(count($fields)>1)?$fields[1]:'asc');
          break;
        case '_take':
          $m=$m->take(intval($value));
          break;
        case '_function':
          $methodanalize=explode("|",$value);
          break;
        case '_visible':
          $visible=$value;
          break;
        default:
          if (is_array($value)) {
            $m=$m->whereIn($key,(array) $value);} else {
            if (preg_match("#->#i",$key)) {
              // if ($value==1) {$value=true;}
            }
            // Для передачи данных по выборке необходимо добавить в ключ управляющие выборкой символы (>,=,<= и т.д)
            $fields=explode("|",$key);
            if (count($fields)==1) {$fields[1]='=';}
            switch ($fields[1]) {
              case 'null':
                $m=$m->whereNull($fields[0]);
                break;
              case 'not_null':
                $m=$m->whereNotNull($fields[0]);
                break;
              default:
                $m=$m->where($fields[0],$fields[1],$value);
            }
          }
      }
    }
    $collection=$m->get();
    if (!is_null($visible)) {
      $collection=$collection->each(function ($item) use ($visible) {
        $item->makeVisible($visible);
      });
    }
    if (count($methodanalize)>0) {
      $collection=$collection->{$methodanalize[0]}($methodanalize[1]);
    }
    return $collection;
  }

  public function save(Request $request)
  {
    $multidim=false;
    foreach ($request->all() as $key=>$value)
    {
      if ($key===0) $multidim=true;break;
    }
    if (!$multidim)
    {
      $this->model=$this->model->firstOrNew([$this->model->getKeyName() =>$request[$this->model->getKeyName()]]);
      $this->model->fill($request->all());
      $this->model->save();
      return $this->model;
    } else {
      $arrF = [];
      foreach ($request->all() as $value)
      {
        $f=$this->model->firstOrNew([$this->model->getKeyName() => $value[$this->model->getKeyName()]]);
        $f->fill($value);
        $f->save();
        array_push($arrF, $f);
      }
      return $arrF;
    }
    return $f;
  }

  public function delete(Request $request)
  {
    $k=$this->model->find($request->id);
    $k->delete();
    return $k;
  }
}

