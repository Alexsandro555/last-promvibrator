<?php
/**
 * Created by PhpStorm.
 * User: alexsandro
 * Date: 13.11.17
 * Time: 10:07
 */

namespace Modules\Files\Classes;

class UploadInfo {
  /*
   * Идентефикатор модели к которой загружается файл
   * @var Integer Идентефикатор модели к которой загружается файл
   */
  public $id;
  /*
   * Тип файла
   * @var String
   */
  public $typefile;
  /*
   * Имя поля загрузки (например, для WYSIWYG - image, по-умолчанию используется file)
   * @var String
   */
  //
  public $uploadField="file";
  // Имя загруженного файла
  public $filename = '';
  // Правила валидации
  public $validator;
  public $types;
  public $currentFileId;
  public $model;

}