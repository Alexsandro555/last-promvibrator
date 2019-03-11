<?php

namespace Modules\Files\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Files\Events\FileFormatDeleted;
use Modules\Files\Entities\File;

class DelFormat
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
    public function handle(FileFormatDeleted $event)
    {
      $id = $event->id;
      $name = $event->name;
      if($id && $name) {
        $countFile = 0;
        $files = File::where('type_file_id',$id)->get();
        foreach ($files as $file) {
          if(isset($file->config['files'][$name])) {
            $files = $file->config->get('files');
            $filename = $files[$name]['filename'];
            $full_size_dir = storage_path('app/public/');
            if(file_exists($full_size_dir.$filename)) {
              unlink($full_size_dir.$filename);
            }
            else {
              return response()->json(['success' => 0, 'message' => 'Файла '.$filename." не существует."],422);
            }
            unset($files[$name]);
            $fileCollect = collect();
            $fileCollect->put('files',$files);
            $file->config = $fileCollect;
            $countFile++;
          }
          $file->save();
        }
      }
    }
}
