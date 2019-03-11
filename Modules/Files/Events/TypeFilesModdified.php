<?php

namespace Modules\Files\Events;

use Illuminate\Queue\SerializesModels;

class TypeFilesModdified
{
    use SerializesModels;

    public $typeFile;

    /**
     * TypeFilesModdified constructor.
     * @param $typeFile
     */
    public function __construct($typeFile)
    {
      $this->typeFile = $typeFile;
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
