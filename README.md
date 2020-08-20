# Theme Name: onepress-child
- WordPress version: 5.5 
- OnePress version: 2.2.5

This theme is the WordPress theme inherits its parent theme, [One Press](https://en-nz.wordpress.org/themes/onepress/).
The original theme is already cool but I wanted to enhance and change several elements.
My website using this theme is [pippuriric](https://pippuriric.com/). 

I also activate the plugin [Meta Box](https://metabox.io/) for custom fields.

Here is a brief guide to using it.
1. Download parent theme and place at the themes in wp-content folder.
2. Place this child theme at the themes in wp-content folder.
3. From the Appearance-Themes on WordPress admin page, choose "onepress-child".

The points I changed and custormized.
- Logo size (css)
- Section: Hero 
  The limit number of photos on top page (section-hero.php, template-tags.php, customizer.php) 
- Section: Service
  Layouts of content (4 contents locate as 2 rows 2 columns except for mobile layout)(section-service.php) 
- Section: News
  Thumnails' setting (thumnails disappear when "@media screen and (max-width: 940px)" on the original theme) (section-service.php) 
- Footer
  How to describe copyright, the place of footer widgets (footer.php)
- Portfolio page
  Depend on the category, show the different carousel gallery. (templage-portfolio.php, function.php)
  Need to activate [Meta Box](https://metabox.io/).
- MetaBox setting
  Since the new block editor, Gutenberg, became a default editor, the place of custom fields is on the wrong position especially at OnePress. I added css in the header of admin page.(function.php)
  In general, we can not control show/hide of custom fields without an extra package, I added Javascript for hiding MetaBox except template-portfolio.php)(admin.js)
- Other changes...
  
