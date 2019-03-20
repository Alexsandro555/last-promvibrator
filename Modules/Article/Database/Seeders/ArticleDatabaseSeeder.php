<?php

namespace Modules\Article\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Article\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $mainArticles = DB::connection('mysql2')->table('main')->get();
      foreach ($mainArticles as $mainArticle) {
        $article = new Article;
        $article->title = $mainArticle->title;
        $article->url_key = $mainArticle->alt_name;
        $description = str_replace('http://www.promvibrator.ru/images','/storage',$mainArticle->description);
        $article->content = $description;
        $article->save();
      }
    }
}
