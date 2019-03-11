<?php
  namespace Modules\Product\Exceptions;

  use Exception;
  use Throwable;

  abstract class myNotFoundException extends Exception
  {
    protected $id;
    protected $details;

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
      parent::__construct($message, $code, $previous);
    }

    protected function create(array $args) {
      $this->id = array_shift($args);
      $error = $this->errors($this->id);
      $this->details = vsprintf($error['context'], $args);
      return $this->details;
    }

    private function errors($id) {
      $data = [
        'not_found' => [
          'context' => 'The requested resource could not be found but may be available in the future. Subsequent requests by the client are permissible.',
        ]
      ];
      return $data[$id];
    }
  }