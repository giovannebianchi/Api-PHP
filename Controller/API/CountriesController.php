<?php

class CountriesController extends BaseController
{
  public function listAction()
  {
    $errorDescription = '';
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $stringParamsArray = $this->getStringParams();

    if(strtoupper($requestMethod) == 'GET') {
      try {
        $countriesModel = new CountriesModel();
        $intLimit = 10;
        if(isset($stringParamsArray['limit']) && $stringParamsArray['limit']) {
          $intLimit = $stringParamsArray['limit'];
        }

        $countriesArray = $countriesModel->getCountries($intLimit);
        $respondeData = json_encode($countriesArray);
      } catch(Error $e) {
        $errorDescription = $e->getMessage() . 'Somenthing went wrong!';
        $errorHeader = 'HTTP/1.1 500 Internal Server Error';
      }
    } else {
      $errorDescription = 'Method not Suported';
      $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
    }

    if(!$errorDescription) {
      $this->sendOutput(
        $respondeData,
        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
      );
    } else {
      $this->sendOutput(json_encode(array('error' => $errorDescription)),
    array('Content-Type: application/json', $errorHeader));
    }
  }
}