// $Id: README.txt,v 1.3.2.1 2008/12/05 13:41:22 tobiassjosten Exp $


Simplenews Template
===================

Simplenews Template is a Drupal module that extends the Simplenews module by
providing a themable template with configurable header, footer and style.
Header, footer and style are configurable for each newsletter independently.

Simplenews Template can with advantage be used in conjunction with
RelatedContent <http://drupal.org/project/relatedcontent>.

Developed by

  * Thomas Barregren <http://drupal.org/user/16678>

Sponsored by

  * Spoon Media <http://www.spoon.com.au/>
  * Webbredaktören <http://www.webbredaktoren.se/>


Requirements
------------

To install Simplenews Template you need:

  * Drupal 5.x
  * Simplenews
  * Mime Mail
  * PHPTemplate based theme


Installation
------------

Install Simplenews Template as follows:

  1. Download, install and configure the Mime Mail module.
     See http://drupal.org/project/mimemail.

  2. Download, install and configure the Simplenews module.
     See http://drupal.org/project/simplenews.

  3. Download the latest stable version of Simplenews Template.
     See http://drupal.org/project/simplenews_template.

  4. Unpack the downloaded file into sites/all/modules or the modules directory
     of your site.

  5. Go to Administer » Site building » Modules and enable the module.
  
  6. OPTIONAL: To enable automatic insertion of the Simplenews Template style
     definitions into HTML-tags of e-mails, download the Emogrifier from
     http://www.pelagodesign.com/sidecar/emogrifier/ and extract the file
     emogrifier.php file into the Simplenews Template folder. More information
     below.


Configuration
-------------

There is no configuration for the Simplenews Template module itself.


Usage
-----

Header, footer and style is setup for each newsletter individually as follows:

  1. If not already existing, go to admin/content/newsletters/types and add at
     least one newsletter.

  2. Go to admin/content/simplenews/types, and select the newsletter to be
     configured.

  3. Fill out the text area with the content to be shown at the beginning of
     each issue of the newsletter. Leave blank to not include a header. Do not 
     forget to choose appropriate input format.

  4. Locate and open the collapsible section called Footer. Fill out the text 
     area with the content to be shown at the end of each issue of the 
     newsletter. Leave blank to not include a footer. Do not forget to choose
      appropriate input format.

  5. Locate and open the collapsible section called Style. Fill out the text 
     field called Body background color with any valid HTML color value,
     e.g. #ff00ff and fuchsia.

  6. Fill out the text area called CSS with style sheet rules valid within the
     HTML tags <style type="text/css">...</style>,
     e.g. div.message { color: red }.


Emogrifier
----------

Some e-mail clients, notably Microsoft Outlook 2007 and Google Gmail, discharge
CSS defintions within <style> tags. The solution is to put the style definitions
into the e-mail HTML-tags. Simplenews Template can do this automagically
if Emogrifier <http://www.pelagodesign.com/sidecar/emogrifier/> is installed
as described above.

Emogrifier supports not all CSS2 selectors, e.g. including pseudo selectors. All
CSS1 selectors works.

Emogrifier parses the CSS selectors in order. Later selectors will therefore
override earlier selectors that apply to the same element.

Notice that even with Emogrifier certain e-mail clients will ignore certain CSS
properties. For more information, see http://www.email-standards.org/.

The 15 August 2008 version of Emogrifier has a minor bug, which is easily fixed
by replacing $body with $html on lines 35 and 38. Alternatively, you can apply
following patch:

  --- emogrifier.php	2008-08-15 13:33:22.000000000 +0200
  +++ emogrifier.php	2008-10-19 16:51:00.000000000 +0200
  @@ -32,10 +32,10 @@ class Emogrifier {
   	public function emogrify() {
   	    // process the CSS here, turning the CSS style blocks into inline css
   		$unprocessableHTMLTags = implode('|',$this->unprocessableHTMLTags);
  -		$body = preg_replace("/<($unprocessableHTMLTags)[^>]*>/i",'',$this->body);
  +		$html = preg_replace("/<($unprocessableHTMLTags)[^>]*>/i",'',$this->html);
   
   		$xmldoc = new DOMDocument();
  -		$xmldoc->loadHTML($body);
  +		$xmldoc->loadHTML($html);
   
   		$xpath = new DOMXPath($xmldoc);

The bug is reported to the creator of Emogrifier and will eventually be fixed.
