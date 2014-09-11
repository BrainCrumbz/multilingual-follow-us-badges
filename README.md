#Multilingual Follow Us Badges

A WordPress plugin to extend *WPsite Follow Us Badges* plugin and make it support localisation in multilingual sites. 

Currently supports multilingual WordPress sites enabled by *Polylang* plugin. 

##Install

This plugin needs to be installed side by side with *WPsite Follow Us Badges* and *Polylang* plugin. Take a copy from this repo and place it under usual WordPress plugin directory, `wp-content\plugins`.

In order to make things work, a single file in original *WPsite Follow Us Badges* plugin has to be modified. That file is named `wpsite-follow-us-badges.php` and is located in root plugin directory.  
You can grab a copy already modified for you from our forked repo [here on GitHub] [fork]. Just copy and paste that over the original file. For the curious out there, this step is needed in order to create some *extension points* inside the original plugin.

We'll make our best to keep our forked repo in synch with the original one from the author. In worst case, the added extension points are flagged in source code with the `// EXTEND` comment so that you can easily spot them and reproduce on your own.

##Compatibility

Plugin has been tested with:

 * WordPress v3.9.2
 * WPsite Follow Us Badges v1.4.2
 * Polylang v1.5.4

##Author

[BrainCrumbz] [website] - [@BrainCrumbz] [twitter]

##Credits 

[*WPsite Follow Us Badges*] [wpsite] plugin created by WPsite.

[*Polylang*] [polylang] plugin created by Frédéric Demarle.

##Copyright and license

Copyright (C) 2014 [BrainCrumbz] [website].

Released under the GPLv2 License. See the [bundled LICENSE] [license] file for details.

##Fork it

Your contributions are always welcome!

[twitter]: http://twitter.com/BrainCrumbz
[website]: http://www.braincrumbz.com
[wpsite]: http://www.wpsite.net/social-media-follow-us-badges
[polylang]: http://polylang.wordpress.com/
[license]: ./LICENSE
[fork]: https://github.com/BrainCrumbz/wpsite-follow-us-badges
