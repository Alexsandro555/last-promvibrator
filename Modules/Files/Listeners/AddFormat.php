<?php

namespace Modules\Files\Listeners;

use Illuminate\Support\Facades\Log;
use Modules\Files\Events\FileFormatAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Files\Entities\File;
use Modules\Files\Classes\FileUpdater;

class AddFormat
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
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(FileFormatAdded $event)
    {
      $typeFile = $event->typeFile;
      $curTypeFile = $event->curTypeFile;
      $countFile = 0;
      // Проходим по всем файлам который имеют соответствующий тип файла
      $files = File::where('type_file_id',$typeFile->id)->get();
      foreach ($files as $file) {
        foreach ($file->config as $key => $fileConfig) {
          foreach ($fileConfig as $key => $fileFormat) {
            // ещем оригинальный файл на основе которого будем создавать
            if($key == 'original') {
              $filename = $fileFormat["filename"];
              $fileUpdater = new FileUpdater($file, $typeFile);
              $fileUpdater->resize($filename,$curTypeFile["name"],true,$curTypeFile["absolute"],$curTypeFile["width"],$curTypeFile["height"]);
              $countFile++;
            }
          }
        }
      }
      // завершение обработки всех файлов
      Log::info('AddFormat обработано '.$countFile.' файлов.');
    }
}
