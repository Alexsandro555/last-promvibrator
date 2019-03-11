<?php

namespace Modules\Files\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Files\Entities\TypeFile;
use Modules\Files\Events\FileFormatAdded;
use Modules\Files\Events\FileFormatDeleted;
use Modules\Files\Events\TypeFilesModdified;

class TypeFileController extends Controller
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
      return TypeFile::all();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function create(Request $request)
    {
      $addTypeFile = $request->typefile;
      $typeFile = new TypeFile();
      $typeFile->name = $addTypeFile['name'];
      $typeFile->config = $addTypeFile['config'];
      $typeFile->save();
      return ['message' => 'Успешно сохранено!'];
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function addFormat(Request $request)
    {
      $curTypeFile = $request->typeFile;
      $typeFile = TypeFile::find($request->id);
      if($typeFile) {
        $config = $typeFile->config;
        $element = $config->get('resize');
        array_push($element,$curTypeFile);
        $config->put('resize',$element);
        $typeFile->config = $config;
        $typeFile->save();

        event(new FileFormatAdded($typeFile,$curTypeFile));
        return ['message' => 'Успешно добавлено!'];
      }
      else {
        throw new \Exception('Типа файла с заданным id не существует');
      }
    }

    public function delFormat(Request $request) {
      $name = $request->name;
      $id = $request->id;
      $typeFile = TypeFile::find($id);
      if($typeFile) {
        $resizes = $typeFile->config->get('resize');
        // Удаление из типа файла
        foreach ($resizes as $key=>$resize) {
          if($resize['name'] == $name)
          {
            unset($resizes[$key]);
          }
        }
        $resizeCollect = collect((array)$resizes)->map(function($row) {
          return collect($row);
        });
        $configCollect = collect();
        $configCollect = $typeFile->config;
        $configCollect->put('resize',$resizeCollect);
        $typeFile->config = $configCollect;
        $typeFile->save();
        event(new FileFormatDeleted($id,$name));
        return ['message' => 'Успешно удалено!'];
      }
      else {
        throw new \Exception('Типа файла с заданным id не существует');
      }
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('files::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('files::edit');
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function update(Request $request)
    {
      // Получаем актуальные значения типов файлов
      $currentTypeFile = $request->typefile;
      if($currentTypeFile) {
        // Получаем содержимое таблицы типов файлов
        $typeFile = TypeFile::findOrFail($currentTypeFile['id']);
        // Выполняем обновление
        $typeFile->name = $currentTypeFile['name'];
        $typeFile->config = $currentTypeFile['config'];
        $typeFile->save();
        event(new TypeFilesModdified($typeFile));
        return ['message' => 'Сохранено!'];
      }
      else {
        throw new \Exception('Типа файла неопределен');
      }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
