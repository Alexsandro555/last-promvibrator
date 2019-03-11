<?php

namespace Modules\Initializer\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Nwidart\Modules\Commands\GeneratorCommand;
use Nwidart\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MakeVuexModule  extends GeneratorCommand
{
  use ModuleCommandTrait;
  /**
   * The console command name.
   *
   * @var string
   */
  public $path;
  public $stub;
  public $parts;

  protected $name = 'module:make-vuex-module';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Создать модуль со всем необходимым.';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  public function getDestinationFilePath()
  {
    $path = $this->laravel['modules']->getModulePath($this->getModuleName());
    return $path .''. $this->path;
  }

  /**
   * @return string
   */
  protected function getTemplateContents()
  {
    return (new ReStub($this->stub, [
      'NAME'    => $this->argument('name'),
      'NAME_PLURAL' => str_plural($this->argument('name')),
      'NAME_SNAKE' => snake_case($this->argument('name')),
      'NAME_URL' => strtolower($this->argument('name')),
      'MODULE_NAME' => $this->getModuleName(),
      'TABLE' => $this->getTableName(),
      'FIELDS' => '',
      'MIGRATION_CLASS' => $this->getMigrationName(),
      'LOWER_NAME' => strtolower($this->argument('name')),
      'LOWER_MODULE_NAME' => strtolower($this->getModuleName())
    ]))->render();
  }

  public function getTableName()
  {
    return strtolower(str_plural(snake_case($this->argument('name'))));
  }
  public function getMigrationName()
  {
    return 'Create'.str_plural($this->argument('name')).'Table';
  }
  public function handle()
  {
    $this->parts=explode(",",$this->option('parts'));
    $files = [];
    if (in_array('migration',$this->parts)) {
      $files[]=['path' => 'Database/Migrations/'.Carbon::now()->format('Y_m_d_His').'_create_'.$this->getTableName().'_table.php', 'stub' => 'migration.stub'];
    }
    if (in_array('actions',$this->parts)) {
      $files[]=['path' => 'Resources/assets/js/vuex/'.$this->getTableName().'/actions.js', 'stub' => 'actions.stub'];
    }
    if (in_array('api',$this->parts)) {
      $files[]=['path' => 'Resources/assets/js/api/'.$this->getTableName().'.js', 'stub' => 'api.stub'];
    }
    if (in_array('mutations',$this->parts)) {
      $files[]=
        ['path' => 'Resources/assets/js/vuex/'.$this->getTableName().'/mutations.js', 'stub' => 'mutations.stub'];
    }
    if (in_array('store',$this->parts)) {
      $files[]=['path' => 'Resources/assets/js/vuex/'.$this->getTableName().'/state.js', 'stub' => 'state.stub'];
    }
    if (in_array('getters',$this->parts)) {
      $files[]=['path' => 'Resources/assets/js/vuex/'.$this->getTableName().'/getters.js', 'stub' => 'getters.stub'];
    }
    if (in_array('list',$this->parts)) {
      $files[]=['path' => 'Resources/assets/js/vue/'.$this->getTableName().'/List'.$this->argument('name').'.vue', 'stub' => 'list.stub'];
    }
    if (in_array('edit',$this->parts)) {
      $files[]=['path' => 'Resources/assets/js/vue/'.$this->getTableName().'/Edit'.$this->argument('name').'.vue', 'stub' => 'edit.stub'];
    }
    if (in_array('model',$this->parts)) {
      $files[]=['path' => 'Models/'.$this->argument('name').'.php', 'stub' => 'model.stub'];
    }
    if (in_array('controller',$this->parts)) {
      $files[]=['path' => 'Http/Controllers/'.str_plural($this->argument('name')).'Controller.php', 'stub' => 'controller.stub'];
    }
    if (in_array('controller_routes',$this->parts)) {
      $files[]=['path' => 'Routes/'.$this->argument('name').'.php', 'stub' => 'controller_routes.stub'];
    }
    if (in_array('observer',$this->parts)) {
      $files[]=['path' => 'Observers/'.$this->argument('name').'Observer.php', 'stub' => 'observer.stub'];
    }

    foreach($files as $file) {
      $this->path = $file['path'];
      $this->stub = $file['stub'];
      parent::handle();
    }
  }

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return [
      ['name', InputArgument::REQUIRED, 'Название Vuex Модуля'],
      ['module', InputArgument::OPTIONAL, 'Общий модуль для Vuex'],
    ];
  }

  /**
   * Get the console command options.
   *
   * @return array
   */
  protected function getOptions()
  {
    return [
      ['parts', null, InputOption::VALUE_OPTIONAL, 'Какие генерации производить?', 'migration,actions,list,edit,api,mutations,getters,store,routes,model,controller,observer,controller_routes'],
    ];
  }
}
