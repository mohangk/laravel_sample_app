<?php

class Helper {
  
  public static function controllerName() {
    $controllerAndAction = Route::currentRouteAction();
    $name = preg_replace('/controller.*/i', '', $controllerAndAction);
    return strtolower($name);
  }

  public static function actionName() {
    $controllerAndAction = Route::currentRouteAction();
    $name = preg_replace('/^[^@]+@/i', '', $controllerAndAction);
    $name = strtolower($name);

    $normalizer = [ 'store' => 'create', 'update' => 'edit' ];
    if( array_key_exists($name, $normalizer) ) {
      return $normalizer[$name];
    }

    return $name;
  }

}


