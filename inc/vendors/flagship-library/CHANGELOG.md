# Changelog for Flagship Library

## 1.4.1

- Fixed a fatal error by making Flagship_Library::$dir public rather than protected.
- Fixed an undefined variable in the author box admin settings.

## 1.4.0

This is a fairly significant update. The entire library structure was rewritten, primarily to reduce the overall memory footprint of the library. Backwards compatibility has been maintained, but quite a few functions have been deprecated and replaced. You'll find them in the `functions/deprecated.php` file and you can expect them to be removed sometime in the near future. Many of these functions were deprecated because of internal refactoring, but some were removed because new functions in Hybrid Core 2.1.0 will be replacing them. You shouldn't notice any significant changes in functionality for existing features and extensions. It should be noted that it's no longer necessary to `add_theme_support( 'title-tag' )` as Hybrid Core 2.1.0 will add it by default.

In addition to cleanup and refactoring, this release also added a custom format selector for the WordPress editor, a new Author Box extension and improved the way our template files are handled in existing extensions. Moving forward, any part of the library which handles front-end output will use a default template which can be overridden by moving it into your theme or child theme within a `flagship` directory. For more specific instructions about this, see the template files themselves in the `templates` directory. We've also added a few new helper functions which are as follows:

- flagship_customizer_link
- flagship_get_customizer_link
- flagship_credit_link
- flagship_add_menu_atts
- flagship_add_styleselect
- flagship_disable_styleselect
- flagship_tiny_mce_formats

If you would like to use the new Author Box extension, you can `add_theme_support( 'flagship-author-box' )` in your theme's setup function. This will enable the display of author boxes on single posts by default but you can also have more granular control of the display of individual author's posts by editing their user profile from within the WordPress admin panel. For more information on the individual features and extensions, check the [Flagship Library wiki](https://github.com/FlagshipWP/flagship-library/wiki/).

## 1.3.0

This is mostly a maintenance release, but it does add a few new features and improve some of our existing functions within the library. The following functions were added:

- flagship_post_navigation
- flagship_get_post_navigation
- flagship_posts_navigation
- flagship_get_posts_navigation
- flagship_attr_nav
- flagship_widget_menu_wrap
- flagship_widget_menu_args

The `flagship_header_menu_args` function was deprecated and will be removed in a future release. For more information on using the new functions, see the inline code documentation or check out how they're being used in the latest version of [Compass](https://github.com/FlagshipWP/compass).

The `flagship_get_entry_published` function had some additional arguments added to make it easer to use a different method of determining the published date, such as `get the_modified_date`.

We also added support for the new WordPress 4.1 `title-tag` feature by only outputting `the_title` markup on older versions of WordPress. Themes which integrate the Flagship Library should now use `add_theme_support( 'title-tag' )` within their setup function.

## 1.2.1

Fixed an incorrect textdomain that made it in during development.

## 1.2.0

This release adds a few helper classes for working with the WordPress customizer and makes some under-the-hook improvements to the existing extensions and classes. The following classes were added:

- Flagship_Customizer_Base
- Flagship_Style_Builder

The customizer base is an abstract class designed to make registering customizer options within a theme a bit less labor-intensive. It contains data sanitizaiton methods and some default hooks to register your customizer options and assets. All of our existing customizer classes have been updated to use this base class to reduce duplicate code.

The style builder is an interface for building and registering custom CSS based on user selections within the customizer. It's based on the style builder used in the Make theme by The Theme Foundry.

Other enhancements include:

- Added SVG logo support
- Fixed n bug with asset URLs on Windows installations
- Fixed a display bug which caused the site title to be hidden by default
- Escaped all instances of the library asset URI
- General code cleanup

## 1.1.0

Major backwards-compatible rewrite. All internal files were re-structured and organized for a more future-friendliness. Extensions were added in a modular way so that theme authors can take advantage of them if they choose to do so. In addition to the restructuring and cleanup, we also added or improved the following features:

- Breadcrumb Display Extension
- Site Logo Extension
- Footer Widgets Extension

## 1.0.0

First public release.
