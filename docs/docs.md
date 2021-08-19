# What is ProjectZero?
ProjectZero is a free, open source theme for WordPress.  It has been designed for WordPress developers to make site creation easier.  It offers a basic framework and rudimentary set of files to allow a theme to be deployed almost instantly, as well as encouraging theme development from new developers.

It can also be used by the experienced developers to make site creating easier (that’s what we use it for anyway), and is a useful tool to deploy new themes with minimal effort.

# Installation
There are two ways you can download and install the theme: Download the theme directly or fork the repo on GitHub.

## Download the theme directly
To download the latest version of ProjectZero, view our <a href="https://github.com/cocodedesigns/project-zero/releases/latest/" target="_blank" rel="nofollow">Releases page on GitHub</a>.

## Fork the repo on GitHub
To fork the `project-zero` repo, log into your GitHub account and visit <a href="https://gitub.com/cocodedesigns/project-zero/">the project repo</a>.

[image - screenshot]

Click "Fork" at the top of the page.

[image - screenshot]

From here, change the repo information to reflect your project.

[image - screenshot]

# WP Theme Structure
The files included in the theme adhere to the <a href="https://developer.wordpress.org/themes/basics/template-hierarchy/" target="_blank" rel="nofollow">Template Hierarchy <span class="icon icon-popup"></span></a>.

[image - graphic from wp.org]

The files included in this blank theme are:

* `404.php`
* `archive.php`
* `comments.php`
* `footer.php`
* `functions.php`
* `header.php`
* `index.php`
* `page.php`
* `screenshot.php`
* `search.php`
* `searchform.php`
* `sidebar.php`
* `single.php`
* `style.css`

To make editing styles easier, we have used `css/main.css` as our main stylesheet, rather than `style.css`.  For responsive websites, we have moved desktop, tablet and mobile specific styles to `css/desktop.css`, `css/tablet.css` and `css/mobile.css` respectively.  There is also a `css/admin.css` stylesheet for admin specific styles.

The code for the author information box can be found in `inc/author-box.php` and the post meta information can be found in `inc/meta.php`.  `inc/functions/page-nav.php` contains the `blogPagination()` function, which can be found in post archives.  `inc/functions/sidebars.php` calls the blog and footer sidebars, and both files are called by `functions.php`.

# Custom Front Page

By default, WordPress makes your blog archive page the home page for the blog.  You can change the settings to set a static page as your home page.  WordPress also comes with the functionality of setting a specific template for your front page.  You can save a file called `front-page.php` in your theme's root folder, and WordPress will set this as your front page's template.

# Includes
To help make production easier, we have included these scripts.  They help with releasing your theme and helping to set up staging or production sites.

## TGMPA
TGM Plugin Activation was created by TGMPA and is used to request important plugins from the WordPress directory, from your own server, or bundled with the theme itself.  Details and documenttion can be found at [LINK TO TGMPA]

## PUC
Plugin Update Checker was created by [] and is used to check for updates to themes.  You can use GitHub as your release server, or you can create your own update server using a simple piece of JSON code.  Details and documentation can be found at [LINK TO PUC]

## WPAN
WordPress Admin Notification was created by [] and is used to display custom notifications within the admin area.  You can use this to notify users to check your documentation, or to thank them for installing your theme.  Details about the project and documentation can be found at [LINK TO WPAN]

## FontAwesome
FontAwesome is developed by [] and is a popular icon font.  We have included the ability for the icons to be inclded in `functions.php`. While we have called it using FontAwesome's CDN, you can save your own local copy if it works for you.

To enable FontAwesome, you will need to uncomment the line
`\\ wp_enqueue_script('fontawesome-js', 'https://kit.fontawesome.com/MY-KIT-ID-NUMBER.js', array(), '0.0.0');`

To use FontAwesome in your theme from a remote CDN, you will need to have an account with FontAwesome.  To register for FREE, visit https://fontawesome.com/start and get your free FontAwesome kit.  Once you have the right code, uncomment the `wp_enqueue_script` function, replace the script URL with your own, and save the file.

You should use only one copy of FontAwesome to avoid conflicts, so if you use a local copy, you will need to remove the request for the copy from your theme.  If you are using a specific version of FontAwesome, it is recommended to change the `0.0.0` variable at the end of the function to your version number (eg. `5.10.1`).  This will make further development easier.  Otherwise, you can delete the number altogether.

# Push to GitHub
With the Plugin Update Checker, you can use GitHub as your release server.  In `functions.php`, you will see the following code:

`  require_once STYLESHEETPATH . '/inc/functions/puc/plugin-update-checker.php';
  $checkTheme = Puc_v4_Factory::buildUpdateChecker(
	  $mytheme->get('ThemeURI'), // This can be any public repo on GitHub, or any file on your own server, defaults to the Theme URI value in style.css
    __FILE__,
    $mytheme->get('TextDomain'), // Uses the 'Text Domain' string as defined in style.css
  );
  // Enables releases via GitHub
  $checkTheme->getVcsApi()->enableReleaseAssets();`

To make it easier to call your repository, we have used the 'Theme URI' header in your `style.css` file to save your GitHub repo (in the format of `https://githib.com/{USER NAME}/{REPO-NAME}/`).  We have also used the 'Text Domain' header to save your theme's unique slug (usually the same as `{REPO-NAME}`).

The script comes with the ability to select a different branch for your stable release branch.  By default it will select the main/master branch, but you can override this by adding this line after the function:

`$checkTheme->setBranch('stable-branch-name');`

It also allows you to push out updates from private repositories.  To do this, GitHub requires a personal access token, which you can generate in your account settings.  Go to <strong>Settings &gt; Developer Settings &gt; Personal access tokens</strong> to generate a token.  Once it has been generated, add this line after the function:

`$checkTheme->setAuthentication('your-token-here');`

*** Note that, if you develop a theme for the WordPress Theme Directory, using any other release server will be against their terms of service.  You will only be able to use Plugin Update Checker to release your own themes, or to push out themes for development purposes.

# Custom Logo
# Footer sidebar
# Main sidebar
# Links
# Roadmap