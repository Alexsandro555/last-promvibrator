<?php

namespace Modules\Initializer\Traits;

use Illuminate\Support\Facades\Schema;
use Whoops\Exception\ErrorException;

trait TableColumnsTrait
{
  public function getColumns($name)
  {
    $resultCollection = collect([]);
    $model = new static;
    $tableName = $model->table ? $model->table : $name.'s';
    $columns = Schema::getColumnListing($tableName);
    if ($columns) {
      $primaryKey = \DB::select(\DB::raw("SELECT k.column_name FROM information_schema.table_constraints t JOIN information_schema.key_column_usage k USING(constraint_name, table_schema, table_name) WHERE t.constraint_type='PRIMARY KEY' AND t.table_schema=schema() AND t.table_name='" . $tableName . "'"))[0]->column_name;
      foreach ($columns as $column) {
        $collection = collect([]);
        $collection->put('type',Schema::getColumnType($tableName, $column));
        $collection->put('label',\DB::select(\DB::raw("SELECT COLUMN_COMMENT FROM information_schema.COLUMNS WHERE TABLE_NAME = '" . $tableName . "' AND COLUMN_NAME='" . $column . "'"))[0]->COLUMN_COMMENT);
        if ($column === $primaryKey) {
          $collection->put('primary',true);
        }
        $resultCollection->put($column,$collection);
      }
    }
    else {
      throw new ErrorException("Не могу получить данные из таблицы ".$tableName);
    }
    return $resultCollection;
  }
}