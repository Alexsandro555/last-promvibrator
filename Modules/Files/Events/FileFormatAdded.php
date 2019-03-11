<?php

namespace Modules\Files\Events;

use Illuminate\Queue\SerializesModels;

class FileFormatAdded
{
    use SerializesModels;

    public $typeFile;
    public $curTypeFile;

    /**
     * FileFormatAdded constructor.
     * @param $typeFile
     * @param $curTypeFile
     */
    public function __construct($typeFile, $curTypeFile)
    {
      $this->typeFile = $typeFile;
      $this->curTypeFile = $curTypeFile;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
