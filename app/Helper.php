<?php

namespace App;

use Route;

class Helper
{
  public static function activeLi($routes)
  {
    if (is_string($routes)) {
      return Route::currentRouteNamed($routes) ? 'active' : '';
    } elseif (is_array($routes)) {
      $active = false;
      foreach ($routes as $route) {
        if (Route::currentRouteNamed($route)) {
          $active = true;
          break;
        }
      }
      return $active ? 'active' : '';
    } else {
      return '';
    }
  }
}