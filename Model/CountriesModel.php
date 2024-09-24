<?php
require_once ROOT_PATH . "Model/Database.php";

class CountriesModel extends Database
{
  public function getCountries(int $limit)
  {
    return $this->select($limit);
  }
}