<?php
/*
Copyright 2011 3e software house & interactive agency

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

     http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/

require_once "phpwebdriver/WebDriver.php";

$webdriver = new WebDriver("localhost", "4445");
$webdriver->connect("firefox");
$webdriver->get("http://localhost/php_sessions/create.php");

echo "<h2> Prueba web iniciada</h2>";
$testResult = "";

$userElement = $webdriver->findElementBy(LocatorStrategy::name, "user");
if ($userElement) {
    $userElement->sendKeys(array("usr" . rand(100,999)) );
}
sleep(3);
$nameElement = $webdriver->findElementBy(LocatorStrategy::id, "name");
if ($nameElement) {
    $nameElement->sendKeys(array("Usuario prueba" ) );
}
sleep(3);
$passElement = $webdriver->findElementBy(LocatorStrategy::id, "password");
if ($passElement) {
    $passElement->sendKeys(array("NewPassword" ) );
}
sleep(3);
$buttonElement = $webdriver->findElementBy(LocatorStrategy::id, "createUser");
if ($buttonElement) {
    $buttonElement->click();
}
sleep(3);
$mdlResultElement = $webdriver->findElementBy(LocatorStrategy::id, "mdlSuccess");
if ($mdlResultElement) {
    $mdlSuccess = $mdlResultElement->getAttribute("value");
    if($mdlSuccess == 'true'){
        $testResult = "aprobado";
    }else{
        $testResult = "rechazado";
    }
}

echo "<h2> Resultado Prueba: $testResult </h2>";

echo "<h2> Prueba web finalizada</h2>";

$webdriver->close();

?>