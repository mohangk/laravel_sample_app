<?php

trait Eventable {

  /**
   * The "booting" method of the model.
   * Overrided to attach before/after method hooks into the model events.
   *
   * @see \Illuminate\Database\Eloquent\Model::boot()
   * @return void
   */
  public static function boot() {
    parent::boot();

    $myself   = get_called_class();
    $hooks    = array('before' => 'ing', 'after' => 'ed');
    $radicals = array('sav', 'validat', 'creat', 'updat', 'delet');

    foreach ($radicals as $rad) {
      foreach ($hooks as $hook => $event) {
        $method = $hook.ucfirst($rad).'e';
        if (method_exists($myself, $method)) {
          $eventMethod = $rad.$event;
          self::$eventMethod(function($model) use ($method){
            return $model->$method();
          });
        }
      }
    }
  }
}
