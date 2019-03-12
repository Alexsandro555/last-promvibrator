<?php
/**
 * Created by PhpStorm.
 * User: alexsandro
 * Date: 05.02.18
 * Time: 10:07
 */

namespace App;

use App\CustomObject;

class Breadcrumb extends CustomObject
{
  private $title;

  private $slug;

  /**
   * @param string $title Title breadcrumb
   * @param string $slug Slug breadcrumb
   */
  public function __construct($title,$slug) {
    $this->title = $title;
    $this->slug = $slug;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getSlug() {
    return $this->slug;
  }

}