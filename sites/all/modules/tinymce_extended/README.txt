TinyMCE Extended is designed to use the hooks in the wysiwyg module and the
extended_valid_elements argument to allow the TinyMCE editor to use extra
bits of HTML markup.

This module was written as a quick and dirty fix to allow the use of <iframe>
to include Google Maps into Drupal nodes without having to install the various
Gmap modules which have lots more functionality but are overkill for most
copy/paste bloggers.

See discussion here: http://drupal.org/node/544032

Happy to turn this into an official Drupal module if there's enough demand,
although seems overkill for one editor and one function. Comments & feedback
welcome:

http://bit.ly/6UoRqz

### SECURITY WARNING:

N.B. This does open security holes on your website as all sorts of good and
bad code can be called into your site pages using iframes. Make sure the
profile that has access to iframes is limited to trusted users only.

** DO NOT ENABLE THIS OPTION ON PROFILES AVAILABLE TO INSECURE USERS **

For better fine-grained control of input formats, check out the Better Formats
module:

http://drupal.org/project/better_formats

Dependencies
------------

 * Wysiwyg
 * TinyMCE library installed
 * TinyMCE profile enabled

Install
-------

Can't stress this enough, DO NOT LET ANONYMOUS users have this type of access,
otherwise you're asking for trouble. Your site could potentially host all sorts
of nasties that would infect other sites.

The best option is to create a new profile, specifically for the most trusted
users and only enable this option for them, here:

Administer -> Site configuration -> Input formats

1) Copy the tinymce_extended folder to the modules folder in your installation.

2) Enable the module using Administer -> Site building -> Modules
   (/admin/build/modules).

3) Enable the function in wysiwyg's TinyMCE profile. Go to Administer -> Site
   Configuration -> Wysiwyg and click 'Edit' for the TinyMCE profile that you
   want to access <iframe> tags. Expand the 'Buttons and plugins' option and 
   tick the option for 'Iframe Fix', which should be near the bottom.
   
4) If your site has heavy caching, it might be worth clearing the cache, to
   make sure it's all working. Go to Administer -> Site Configuration ->
   Performance and click on the 'Clear cached data' button near the bottom of 
   the page.

