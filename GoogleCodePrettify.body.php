<?php

class GoogleCodePrettify {
  private static $prettified = false;
  
  public static function parserHook($text, $args = array(), $parser) {
    $code_attributes = '';
    if (isset($args['lang']) && $args['lang']) {
      $lang = $args['lang'];
      $code_attributes += " class=\"language-$lang\"";
    }
    self::$prettified = true;

    return "<pre class=\"prettyprint\"><code$code_attributes>$text</code></pre>";
  }

  public static function beforePageDisplay(&$wgOut, &$sk) {
    if (self::$prettified) {
      $wgOut->addModules('ext.GoogleCodePrettify');
    }

    // Continue
    return true;
  }
}
