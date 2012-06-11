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

    # Replace all '&', '<,' and '>' with their HTML entitites. Order is
    # important. You have to do '&' first.
    #
    $text = str_replace('&', '&amp;', $text);
    $text = str_replace('<', '&lt;', $text);
    $text = str_replace('>', '&gt;', $text);

    self::$prettified = true;

    return "<pre class=\"prettyprint$pre_classes\">$text</pre>";
  }

  public static function beforePageDisplay(&$wgOut, &$sk) {
    $wgOut->addModules('ext.GoogleCodePrettify');
    // Continue
    return true;
  }
}
