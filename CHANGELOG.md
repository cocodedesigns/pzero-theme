# Change Log
All notable changes to this project will be documented in this file.

## [0.3] - 2023-04-09
### Added
* Added `theme.json` file
* Added custom post type template (go to plugin)
* Added custom metabox template (go to plugin)
* Added `single-portfolio.php` and `archive-portfolio.php` for custom post types (CPT file is in `p0-plugin`)
* Added custom taxonomy (categories and tags) (go to plugin)
* Added `template_part` to `index.php` and `archive.php`
* Added alternative layouts for `index.php` and `archive.php` - without sidebar and 3-up grid
* Added Google Fonts ('Roboto') and Font Awesome `v6.3.0`
* Added WordPress-compatible `readme.txt` file
* Added embed files for internal posts

### Updated
* Updated `YahnisElsts/plugin-update-checker` to `v5.0.0`
* Cleaned up `wp_head` and `wp_admin_head` code (moved to `inc/header.php`)

## [0.2.1] - 2021-11-01
### Added
* Added hooks to remove functions that could be exploited

### Changed
* Bug fixes

## [0.2] - 2021-08-16
### Removed
* Removed local FontAwesome instance
* Restored default WordPress comments

### Added
* New default logo, new `screenshot.png` file
* Additional headers for `style.css`, including preview information for WordPress

### Changed
* Improved comments
* Removed unnecessary comments, attributes and variables
* Set `Theme URL` in `style.css` as default GitHub repo URL for `plugin-update-checker`

### Updated
* Updated `YahnisElsts/plugin-update-checker` to v4.11

## [0.1] - 2019-07-04
### Initial commit