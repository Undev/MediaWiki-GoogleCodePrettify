<?php
# Alert the user that this is not a valid entry point to MediaWiki if they try to access the file directly.
if (!defined('MEDIAWIKI')) {
  echo <<<EOT
To install GoogleCodePrettify extension, put the following line in LocalSettings.php:
require_once( "\$IP/extensions/GoogleCodePrettify/GoogleCodePrettify.php" );
EOT;
  exit(1);
}

$dir = dirname( __FILE__ ) . '/';

$wgAutoloadClasses['GoogleCodePrettify'] = $dir. 'GoogleCodePrettify.body.php';
$wgExtensionMessagesFiles['GoogleCodePrettify'] = $dir. 'GoogleCodePrettify.i18n.php';

if (! isset($wgGoogleCodePrettifyAdditionalLanguages)) {
  $wgGoogleCodePrettifyAdditionalLanguages = array(
    'css',
    'sql',
    'yaml'
  );
}
if (! isset($wgGoogleCodePrettifyAllowSourceTag)) {
  $wgGoogleCodePrettifyAllowSourceTag = false;
}

function efGoogleCodePrettify_Scripts() {
  global $wgGoogleCodePrettifyAdditionalLanguages;
  $scripts = array('google-code-prettify/prettify.js');
  foreach ($wgGoogleCodePrettifyAdditionalLanguages as $language) {
    $scripts[] = "google-code-prettify/lang-$language.js";
  }
  $scripts[] = 'init.js';
  return $scripts;
}

/**
 * Register parser hook
 */
function efGoogleCodePrettify_Setup( &$parser ) {
  global $wgGoogleCodePrettifyAllowSourceTag;
  global $wgGoogleCodePrettifyAllowShlTag;
  if ($wgGoogleCodePrettifyAllowSourceTag) {
    $parser->setHook('source', array('GoogleCodePrettify', 'parserHook'));
  }
  if ($wgGoogleCodePrettifyAllowShlTag) {
    $parser->setHook('shl', array('GoogleCodePrettify', 'parserHook'));
  }
  $parser->setHook('syntaxhighlight', array('GoogleCodePrettify', 'parserHook'));
  return true;
}

$wgExtensionCredits['other'][] = array(
  'path' => __FILE__,
  'name' => 'GoogleCodePrettify',
  'author' => 'Akzhan Abdulin',
  'url' => 'http://www.mediawiki.org/wiki/Extension:GoogleCodePrettify',
  'version' => '0.4',
  'descriptionmsg' => 'google-code-prettify-description'
);

// Register parser hook
$wgHooks['ParserFirstCallInit'][] = 'efGoogleCodePrettify_Setup';
// Register before display hook
$wgHooks['BeforePageDisplay'][] = 'GoogleCodePrettify::beforePageDisplay';

$wgResourceModules['ext.GoogleCodePrettify'] = array(
  'localBasePath' => dirname(__FILE__),
  'remoteExtPath' => 'GoogleCodePrettify',
  'styles' => array('google-code-prettify/prettify.css'),
  'scripts' => efGoogleCodePrettify_Scripts()
);

