<?php
// see https://github.com/konshensx16/symfony-todo-backend/blob/master/src/Serializer/CircularReferenceHandler.php

namespace App\Services\Serializer;


class CircularReferenceHandler
{
  public function __invoke($object) {
    return $object->getId();
  }
}