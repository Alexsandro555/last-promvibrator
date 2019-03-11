<?php
/**
 * Created by PhpStorm.
 * User: alexsandro
 * Date: 18.04.18
 * Time: 14:20
 */

namespace Modules\Files\Services;

use Illuminate\Http\Request;
use Modules\Files\Entities\UploadInfo;
use Modules\Files\Entities\TypeFile;
use Modules\Files\Contracts\Uploader;
use Validator;

class UploadService {

  protected $request;
  protected $fileUploader;
  protected $uploader;
  protected $response;

  public function __construct(Request $request, Uploader $uploader)
  {
    $this->request = $request;
    $this->uploader = $uploader;
  }

  public function getTypeFile() {
    $typeFile = null;
    if($this->request->typeFiles) {
      $typeFile = TypeFile::where('name',$this->request->typeFiles)->first();
    }
    else {
      // тип файла по-умолчанию
      $typeFile = TypeFile::where('name','file')->first();
    }
    if(!$typeFile) {
      throw new \Exception('Не найден тип файла с заданным именем');
    }
    return $typeFile;
  }

  public function maxsize($maxsize) {
    $messages = [
      'max' => 'Файл превышает максимальный размер '.$maxsize,
    ];
    $rule = 'required|file|max:'.$maxsize;
    $validator = Validator::make($this->request->all(), [
      'file' => $rule
    ],$messages);
    if ($validator->fails()) {
      throw new \Exception($validator->errors()->first());
    }
    return true;
  }

  public function checkExtension($extensions) {
    $messages = [
      'mimes' => 'Поддерживаемые расширения: '.$extensions,
    ];
    $rule = 'mimes:'.$extensions;
    $validator = Validator::make($this->request->all(), [
      'file' => $rule
    ],$messages);
    if ($validator->fails()) {
      throw new \Exception($validator->errors()->first());
    }
    return true;
  }

  public function upload() {
    // Получение информации о типе файла
    $typeFile = $this->getTypeFile();
    $config = $typeFile->config;

    //====================================Валидация=====================================
    // Проверка максимального размера
    if(isset($config['maxsize']))
      $result = $this->maxsize($config['maxsize']);
    if(isset($config['ext']))
      $result = $this->checkExtension($config['ext']);
    //===================================конец валидации===================================

    if(isset($config['resize'])) {
      foreach ($config['resize'] as $type) {
        if(isset($type["absolute"]) && $type["absolute"]) {
          $result = $this->uploader->upload($typeFile, $type['name'], true,  true, $type['width'], $type['height']);
        }
        if(isset($type["absolute"]) && !$type["absolute"]) {
          $result = $this->uploader->upload($typeFile, $type['name'], true, false, $type['width'], $type['height']);
        }
      }
    }
    $result = $this->uploader->upload($typeFile, "original", false,  false);
    return $result;
  }
}