# GoogleCodePrettify

This MediaWiki extension adds **syntaxhighlight** tag that is implemented using
[Google Code Prettify](http://google-code-prettify.googlecode.com/svn/trunk/README.html) library.

## Requirements

* MediaWiki 1.17 or above.

## Installation

Clone extension repository to <tt>extensions/GoogleCodePrettify</tt> directory.

```bash
cd $MEDIAWIKI_ROOT
git clone git://github.com/Undev/MediaWiki-GoogleCodePrettify.git extensions/GoogleCodePrettify
```

Add to <tt>LocalSettings.php</tt> before trailing <tt>?&gt;</tt> this code:

```perl
require_once( "$IP/extensions/GoogleCodePrettify/GoogleCodePrettify.php" );
```

That's all.

## syntaxhighlight tag

Google Code Prettify automatically recognizes language of source code. But you can set it using *lang* attribute.

## class attribute

You can add additional CSS class names to generated **pre** tags using *class* attribute. This is useful, for example, to add *mw-collapsible* class.

## Configuration

### Enable handling of **source** tag.

Handling of **source** tag disabled by default and is not recommended.

You can override this behavior by setting global <tt>$wgGoogleCodePrettifyAllowSourceTag</tt> variable to <tt>true</tt>.

### Enable handling of **shl** tag.

Handling of **shl** tag disabled by default.

You can override this behavior by setting global <tt>$wgGoogleCodePrettifyAllowShlTag</tt> variable to <tt>true</tt>.

### Additional languages

By default GoogleCodePrettify enables core languages plus css, sql and yaml.

You can add or remove supported languages by changing of global <tt>$wgGoogleCodePrettifyAdditionalLanguages</tt> array variable.

## License

Licensed under MIT License.

## Links

* [Home page](http://www.mediawiki.org/wiki/Extension:GoogleCodePrettify)
* [GitHub Repository](https://github.com/Undev/MediaWiki-GoogleCodePrettify)

