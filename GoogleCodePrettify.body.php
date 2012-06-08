<?php

class GoogleCodePrettify {
  
  public static $prettified = false;
  
  public static function parserHook($text, $args = array(), $parser) {
    $pre_classes = '';
    if (isset($args['lang']) && $args['lang']) {
      $lang = $args['lang'];
      $pre_classes .= " lang-$lang";
    }
    if (isset($args['class']) && $args['class']) {
      $pre_classes .= ' '. $args['class'];
    }
    self::$prettified = true;

    return "<pre class=\"prettyprint$pre_classes\">$text</pre>";
  }

  public static function beforePageDisplay(&$wgOut, &$sk) {
    $wgOut->addModules('ext.GoogleCodePrettify');
    // Continue
    return true;
  }
}
