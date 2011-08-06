WG Email Obfuscator
===================

Overview
--------
This plugin obfuscates all email addresses into non-readable format for spam robots. It automatically masks the content by filtering `the_content()`.

Install
-------
1. Put the directory in the WordPress plugin directory (`./wp-content/plugins/`)
   
1. Activate the plugin in the Dashboard.

1. You're all set!

Further use
-----------
Since the plugin only automatically obfuscate the post's content, there are helper functions allowing for other strings to be obfuscated as well. To obfuscate a generic string, use `encode_address()` at the `wg_email_obfuscator` object.

Example:
```
$foo = 'taz';
echo $wg_email_obfuscator->encode_address( $foo );
```