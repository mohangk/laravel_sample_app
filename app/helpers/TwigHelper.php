<?php

class TwigHelper {

  public static function render() {
    return call_user_func_array(array(App::make('TwigEnv'), "render"), func_get_args());
  }

}
