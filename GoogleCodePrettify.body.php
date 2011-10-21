<?php

class GoogleCodePrettify {
  private static $prettified = false;
  
  public static function parserHook($text, $args = array(), $parser) {
    $pre_classes = '';
    if (isset($args['lang']) && $args['lang']) {
      $lang = $args['lang'];
      $pre_classes .= " lang-$lang";
    }
    self::$prettified = true;

    return "<pre class=\"prettyprint$pre_classes\">$text</pre>";
  }

  public static function beforePageDisplay(&$wgOut, &$sk) {
    if (self::$prettified) {
      $wgOut->addModules('ext.GoogleCodePrettify');
    }

    // Continue
    return true;
  }
}
