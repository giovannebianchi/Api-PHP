<?php

class Database
{
  public function select($limit): array
  {
    try {
      $countries = json_decode(file_get_contents(DATABASE_FILE), true);
      $countries = array_slice($countries, 0, $limit);
      return $countries;
    } catch(Exception $e) {
      throw new Exception(($e->getMessage()));
    }

    return false;
  }
}