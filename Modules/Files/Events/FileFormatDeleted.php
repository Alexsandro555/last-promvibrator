<?php

namespace Modules\Files\Events;

use Illuminate\Queue\SerializesModels;

class FileFormatDeleted
{
    use SerializesModels;

    public $id;
    public $name;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $name)
    {
      $this->id = $id;
      $this->name = $name;
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
