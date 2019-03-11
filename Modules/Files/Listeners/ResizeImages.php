<?php

namespace Modules\Files\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Modules\Files\Events\TypeFilesModdified;
use Modules\Files\Entities\File;
use Modules\Files\Classes\FileUpdater;
use Modules\Files\Entities\TypeFile;

class ResizeImages
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param TypeFilesModdified $event
     * @throws \Exception
     */
    public function handle(TypeFilesModdified $event)
    {
      $typeFile = $event->typeFile;
      $countFile = 0;
      // Проверяем что тип файла поддерживает изменение размеров, если нет, то получается не будет обработан ни один файл!
      if(isset($typeFile->config['resize'])) {
        $typeFileResizes = $typeFile->config['resize'];
        $files = File::where('type_file_id',$typeFile->id)->get();
        // Проходимся по всем файлам соответствующего типа
        foreach ($files as $file) {
          foreach ($file->config as $fileConfig) {
            foreach ($fileConfig as $key => $fileFormat) {
              // format: medium, small,...
              // Проверяем старые значения размеров они обязательно должны быть
              if(array_key_exists('resize',$fileFormat))
              {
                $resize = $fileFormat['resize'];
                foreach ($typeFileResizes as $typeFileResize) {
                  //Log::info($typeFileResize);
                  // если находим одинаковые форматы файлов в старом и новом
                  if($typeFileResize['name'] === $resize['name'])
                  {
                    // если старое значение отличается от нового
                    $arrResult = array_diff_assoc($typeFileResize,$resize);
                    if($arrResult) {
                      //Log::info('Различается');
                      $filename = $fileConfig["original"]["filename"];
                      // удаление старого файла из файловой системы
                      $delFilename = $fileFormat["filename"];
                      $full_size_dir = storage_path('app/public/');
                      if(file_exists($full_size_dir.$filename))
                      {
                        if(file_exists($full_size_dir.$delFilename)) {
                          unlink($full_size_dir.$delFilename);
                        }
                        else {
                          throw new \Exception('Удаляемого файла '.$delFilename.' не существует!');
                        }
                      }
                      else {
                        throw new \Exception('Оригинального файла '.$filename.' не существует!');
                      }
                      // Обработка изменения размеров
                      $typeFile = TypeFile::find($typeFile->id);
                      $fileUpdater = new FileUpdater($file, $typeFile);
                      $fileUpdater->resize($filename,$typeFileResize['name'],true,$typeFileResize["absolute"],$typeFileResize["width"],$typeFileResize["height"]);
                    }
                  }
                }
              }
              /*else {
                throw new \Exception('Старые размеры не были найдены');
              }*/
            }
          }
        }
      }
    }
}
