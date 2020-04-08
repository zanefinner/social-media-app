<?php namespace Controller;
class Posts{
  protected $model = '';

  public function __construct($model)
  {
      $this->model = $model;
  }

  public function getUserPosts($author){
    $data = $this->model->getPostsByUser($author);
    require('view/user-posts.php');
  }
}
