<?php

namespace App\Console\Commands;

use Nwidart\Modules\Commands\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Nwidart\Modules\Traits\ModuleCommandTrait;

class VueFilesCommand extends GeneratorCommand
{

  use ModuleCommandTrait;

  /**
   * The name of argument being used.
   *
   * @var string
   */
  protected $argumentName = 'name';

  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'module:make-vue-files';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Command create vue files';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Путь до генерируемого файла
   *
   * @var string
   */
  protected $filePatch = '';

  /**
   * Имя файла шаблона
   *
   * @var string
   */
  protected $stubName = '';

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return [
      ['name', InputArgument::REQUIRED, 'The name of the command.'],
      ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
    ];
  }

  /**
   * Get path state.
   *
   * @return string
   */
  public function getDestinationFilePath()
  {
    $path = $this->laravel['modules']->getModulePath($this->getModuleName());
    return $path .''. $this->filePatch;
  }

  /**
   * @return string
   */
  protected function getTemplateContents()
  {
    return (new ReStub($this->getStubName(), [
      'NAME'    => $this->argument('name'),
      'NAME_URL' => strtolower($this->argument('name')),
      'MODULE_NAME' => $this->getModuleName(),
      'LOWER_NAME' => strtolower($this->argument('name')),
      'LOWER_MODULE_NAME' => strtolower($this->getModuleName())
    ]))->render();
  }

  /**
   * Get the stub file name based on the plain option
   * @return string
   */
  private function getStubName()
  {
    return '/stubs/'.$this->stubName;
  }


  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {
    $files = [
      ['filePath' => 'Resources/assets/js/vuex/'.$this->argument('name').'/state.js', 'stubName' => 'state.stub'],
      ['filePath' => 'Resources/assets/js/vuex/'.$this->argument('name').'/getters.js', 'stubName' => 'getters.stub'],
      ['filePath' => 'Resources/assets/js/vuex/'.$this->argument('name').'/mutations.js', 'stubName' => 'mutations.stub'],
      ['filePath' => 'Resources/assets/js/vuex/'.$this->argument('name').'/actions.js', 'stubName' => 'actions.stub'],
      ['filePath' => 'Resources/assets/js/vue/'.$this->argument('name').'/List'.ucfirst($this->argument('name')).'.vue', 'stubName' => 'list.stub'],
      ['filePath' => 'Resources/assets/js/vue/'.$this->argument('name').'/Edit'.ucfirst($this->argument('name')).'.vue', 'stubName' => 'edit.stub'],
      ['filePath' => 'Resources/assets/js/api/'.$this->argument('name').'.js', 'stubName' => 'api.stub']
    ];
    foreach($files as $file) {
      $this->filePatch = $file['filePath'];
      $this->stubName = $file['stubName'];
      parent::handle();
    }
  }
}
