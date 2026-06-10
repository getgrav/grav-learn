---
title: Typhoon
description: Learn how to use the full power of Typhoon
taxonomy:
    category: docs
---

# Typhoon

![Header](typhoon-header.jpg?class=border-bottom)

> [!IMPORTANT]
> Premium products require the free [License Manager](../license-manager) plugin. Install it and add your product license before installing this product.

## Installation

First ensure you are running the latest version of **Grav 1.7** (`-f` forces a refresh of the GPM index).

```
$ bin/gpm selfupgrade -f
```

The Typhoon theme makes use of some other plugins to work at it's full capacity: **color-tools**, **svg-icons**, **shortcode-core**.  These are available via GPM, and because the plugin has dependencies you just need to proceed and install the Typhoon theme, and confirm when prompted to install the others:

```
$ bin/gpm install typhoon
```

You can also install the theme via the **Themes** section in the admin plugin.

## Upgrading

Due to the nature of this theme, we don't recommend modifying this theme directly, you should always create a **copy** of the theme as [outlined in the "Create a Custom Theme from Typhoon secttion below](#create-a-custom-theme-from-typhoon).  This is because when you **upgrade** a theme, all the theme files that are contained in the new package will overwrite any changes you have made.  By creating a custom theme from Typhoon, you can still update Typhoon without fear of impacting your modifications, and then easily compare the changes with your custom theme to see what's changed, and then manually merge over any changes with a diff/merge tool.

### IMPORTANT: Upgrading Typhoon 2.x to Typhoon 4+

When upgrading from Typhoon 2.x to Typhoon 4+, the changes are significant and while there are some new files in the latest version, so some manual cleanup is required.

Typhoon 4 has been completely overhauled for TailwindCSS 4 due to the fundamental architectural changes made in the framework.  As such after upgrading form Typhoon 2.x to Typhoon 4+, you will have some extra files that are no longer needed and can be removed.  

**Manually remove these files:**

* `/postcss.config.js` (moved to vite for Tailwind build)
* `/tailwind.config.js` (moved to `/css/site.css` for Tailwind4 css-variable based config)
* `/tailwind-full.config.js` (unused)
* `/css/custom/bugs.css` (no longer needed as safari doesn't need this fix any longer)
* `/css/custom/dark.css` (moved dark styling into `/css/custom/typography.css`)
* `/css/custom/social.css` (changed to css-variables and moved remaining to `/css/custom/typography.css`)
* `/js/alpine.js` (replaced with latest `/js/alpine.js.min`)

### Upgrading an Existing Typhoon 2.x Theme to TailwindCSS 4+

If you have already created you own custom theme in the past with Tailwind, and you are interested in upgrading it to TailwindCSS 4+, I've written a clean and concise blog post entitled: [TailwindCSS 4.0 upgrade for Typhoon Premium Theme](https://getgrav.org/blog/tailwindcss4-upgrade-for-typhoon-premium-theme) that covers this subject in detail.

## Skeleton Packages

Looking for Typhoon skeleton packages to get you started? You can **download them directly from GitHub** and follow the instructions in the `README.md` file of each repository.

<div class="premium__skeletons">
    <a href="https://github.com/trilbymedia/grav-skeleton-typhoon-onepage" target="_blank">
        <figure>
            <img alt="One-Page Skeleton" src="{{ page.media['onepage.jpg'].url }}" />
            <figcaption>One-Page Skeleton</figcaption>
        </figure>
    </a>
    <a href="https://github.com/trilbymedia/grav-skeleton-typhoon-blog" target="_blank">
        <figure>
            <img alt="Blog Skeleton" src="{{ page.media['blog.jpg'].url }}" />
            <figcaption>Blog Skeleton</figcaption>
        </figure>
    </a>
    <a href="https://github.com/trilbymedia/grav-skeleton-typhoon-rockets" target="_blank">
        <figure>
            <img alt="Rockets Skeleton" src="{{ page.media['rockets.jpg'].url }}" />
            <figcaption>Rockets Skeleton</figcaption>
        </figure>
    </a>
</div>

The quickest way to download the files is to simply click the green **Code** button then click the **Download ZIP**.

![Download ZIP](download-zip.png?classes=image-shadow)

## Configuration

There are many configuration options for the Typhoon theme. They are broken out into organized sections, but there's also several layers in how they can be overridden.  For example, the theme itself has a set of 'default' values that dictate the values site-wide.  Then, you can override many of these settings on a per-page level.  If this is done on a parent page, that has children, the children will inherit the overrides of the parent, but you can also override them still further in the children.  This provides a very flexible architecture, and a simple example of this would be the possibility of configuring a primary color which is unique per top-level page.

### Theme Level Configuration

#### Theme Defaults

![Theme Defaults](theme-defaults.png?class=image-shadow)

Typhoon comes out-of-the box with both light and dark themes.  

* **Theme** → You can configure Typhoon to use the current `System` setting (i.e. if your desktop computer is set to a specific option already, or automatically show light or dark theme depending on the time of day), `Light` or `Dark`.

* **User Selector** → Enables or disables the selector for overriding the theme setting in the footer of the site.

* **Remember Selection** → When enabled will use local storage to ensure the preferred user setting for theme is remembered between visits. When disabled, it will only remember for the current session.

* **Append Site Title to HTML Title** → Convenience option to automatically add the configured Meta Site Title to the HTML title element on all pages.

#### Default Colors

![Default Colors](default-colors.png?class=image-shadow)

There are various color configuration options. This section will configure the default colors that are used throughout the site.

* **Text Color** → This is the color which is used for the main textual content.  It can be any valid tailwind color, e.g. text-primary | text-gray-800 | text-blue-700 etc.  You can consult the [Available Colors Classes](#available-classes) document for more information, or check out the [Tailwind Docs](https://tailwindcss.com/docs/text-color?target=_blank).

* **Primary Color** → This is the primary accent color used throughout the site. It's commonly used for headers, links, and background colors where contrast is required. This should be a valid HEX color.

* **Lighter Brightness** → The primary color has a `lighter` variant (e.g. `text-primary-lighter`).  How much lighter this actually is depends on this value.

* **Darker Brightness** → The primary color has a `darker` variant (e.g. `text-primary-darker`).  How much darker this actually is depends on this value.


#### Layout Defaults

![Layout Defaults](layout-defaults.png?class=image-shadow)

These options provide a level of control over the structure of your layout by utilizing Tailwind classes.

* **Body Classes** → These classes let you set a `<body>` tag level class that will be used on every page. These can be set or overridden per-page.

* **Wrapper Classes** → Wrapper classes control the maximum width of the container, and the padding that should be used.  Tailwind is a mobile-first framework, so default values are for smallest viewport, and larger viewports are prefixed by their breakpoint. e.g. `md:px-6 px-4` means a default padding of 4 for smaller sizes, and 6 for medium breakpoints and above.

* **Section Classes** → Controls the default classes for a section.  A section could be a whole page, or a modular page.

#### Menu Configuration

![Menu Configuration](menu-configuration.png?class=image-shadow)

* **Primary Menu Location** → By default the menu is located in the **Header**. However you can also select the **Sidebar** as a the location.

* **Primary Header Levels** → The number of level in the primary menu.  Further nested levels will be shown in a side navigation. Only valid for 'header' primary menu.

* **Display Mobile Navigation** → Display the hambuger menu for mobile navigation on small devices.

* **Icon Classes** → When you use icons in the menus, these classes will define the default behavior.  You can provide extra Tailwind CSS classes to give unique styling at the page level.

* **External URLs in new tab** → By default all external URLs should be opened in a new browser tab rather than the current tab.

##### Menu Login Section

* **Enable Login Menu** → If you have the login plugin enabled you can enable or disable the site-login functionality appearing in the menu.

* **Login Icon** → The **SVGIcon** compatible icon you wish to use for the login menu item.  Leave blank for to remove the icon. Styling is dictated by the **Icon Classes** configuration in the previous section.

* **Logged-in Display** → When the user is logged in, this is displayed with a link to their profile. The default is `username`, but can also be `fullname` or `email`.

* **Logout Icon** → This is the **SVGIcon** compatible icon that is displayed on the right side of the **Logout** dropdown menu option.

##### Menu Langswitcher Section

* **Enable Langswitcher Menu** → If you have the langswitcher plugin enabled and you have multi-language setup for your site, you can enable or disable the langswitcher functionality appearing in the menu.

* **Langswitcher Icon** → The **SVGIcon** compatible icon you wish to use for the langswitcher menu item.  Leave blank for to remove the icon. Styling is dictated by the **Icon Classes** configuration in the previous section.

#### Header Bar Defaults

![Header Bar Defaults](header-bar-defaults.png?class=image-shadow)

* **Fixed Header Bar** → By default Typhoon uses a **static** header that sits at the top of the page and will scroll out of view as the user scrolls down the page.  Typhoon now supports a **fixed** header option that will stick to the top of the browser and over the content as you scroll.

* **Height** → The height of the header bar can be configured with this Tailwind CSS class.

* **Custom Logo** → By default the Grav logo used in the header. You can easily upload your own PNG, JPG, or SVG logo to use instead.  An SVG is particular useful as it provides the ability to be rendered using the header **text** color ensuring the logo looks great on either light, dark, or transparent headers.

* **Strip Logo SVG Style** → When using a custom SVG, this option can be enabled to strip out any custom `<style></style>` tags that are embedded in the SVG file to ensure the header **text** color used.

* **Custom Favicon** → Allows the ability to upload a favicon that will be used across the site rather than the default Grav icon.

* **Background** → This sets the background to be used. By default, this is either **Automatic**, **Light**, **Dark**, **Transparent**, or **Custom**.  Light and Dark use a preconfigured dark or light gradient, while Custom, allows you to configure your own background CSS.

* **Custom Background Style** → When `Background` is set to **Custom**, this CSS style used as the background for the Header bar.

* **Text** → The color the text to be used.  This is either **Automatic**, **Dark** or **Light** whichever provides the most contrast.

* **Primary Header Levels** → By default this is set to `3`.  That means that the main menu supports 3 levels of navigation.  The first is a horizontal menu, and the 2nd and 3rd levels will be dropdown menus.  A 4th level will automatically be available as a side menu.  If you change this value to `1`, you will simply have a row of top-level menu items with no drop down menus.  All other levels of navigation will be displayed as a side menu.
 
 ! A particular page can choose if it's children should be shown in a side-menu even if they are not at that configured level.
 
 #### Hero Defaults
 
 ![Hero Defaults](hero-defaults.png?class=image-shadow)
 
 The Hero is the header section that appears below the logo/menu section at the top of the page.  This can be enabled by default for all pages, or disabled by default, then enabled on a page-by-page basis. The defaults just control the look of the overall hero section, the contents of the hero are always controlled per-page.
 
 * **Display** → Toggle to control if the hero is always displayed per page. This can be overridden per-page.
 
 * **Hero Alignment** → The alignment of the text within the hero section. Options are **Left**, **Center**, or **Right**. 
 
 * **Image** → While you will most likely set a hero image per-page, you can also set a default image to be used when a specific image is not set. Using a stream is a safe bet, this could be `theme://...` to reference a location inside the current theme or `page://...` to reference an image in the user/pages directory structure.
 
 * **Padding Classes** → The padding classes used to provide space in the Hero section. The default provides a variety of padding and generally increases the padding as the responsive breakpoints increase.  These are tailwind padding classes.  More information in the [Tailwind Documentation](https://tailwindcss.com/docs/padding)
  
#### Hero Overlay

![Hero Overlay](hero-overlay.png?class=image-shadow)

These options are used to control an optional overlay that can cover the image and provide some additional contrast for content that resides in the hero section. There are several options available.

* **Overlay** → Choose from the built in values of **Dark**, **Darker**, **Light**, **Lighter**, **Primary**, **None**, and **Custom**. Where **Custom** allows you to set a custom color.

* **Custom Overlay Color** → When using "Custom" option above, you can specify a custom color here.

* **Overlay Gradient Opacity** → The overlay is gradient by default, so provide a start and end opacity (between 0 and 1).

* **Overlay Gradient Direction** → Choose from **Right**, **Bottom**, **Left** and **Top** directions
  
#### Footer

![Footer Modal](footer-modal.png?class=image-shadow)

##### Multi-language Support

To support multi-language, Typhoon now provides the ability to create a dedicated foote module page.  In **Pages** section, simply click the `+ Add` button in the toolbar and select **Add Module**.  In the modal, choose a title, folder name, and select the parent page.  Make sure you select **Footer** in the modluar template.  This page will be used for all Footer content, and the theme-level configuration will be ignored.

![Footer](footer.png?class=image-shadow)

* **Page Route for Footer data** →  If you have created a Footer module page, you can provide the route to that page in this field.  If the page is found, and it's confirmed to be a `modular/footer` page type, it will be used for all footer configuration.  The section below will be ignored.

The footer appears at the bottom of every page and is by default consists of 3 sections:

* **Menu** → A footer menu to link to specific pages that are not considered primary menu items.  These could be Terms and Conditions, a Privacy Policy, an FAQ, or perhaps another link to a Contact page.  The link itself should be a Grav route if local, (e.g. `/contact-us`), or a full URL to an external page (e.g. `https://somesite.com/terms-and-conditions`)

* **Social Links** → This is a convenient place to put social media links. The admin provides options for:
  * Github
  * Twitter
  * Facebook
  * Instagram
  * LinkedIn
  * Pinterest
  * YouTube
  * Vimeo
  * 500px
  * Gitbook

* **Footer Copyright** → This is the content that sits at the very bottom of your footer. It can be markdown, use Grav shortcodes, or just be plain HTML.

#### Notices

![Notices Modal](notices-modal.png?class=image-shadow)

##### Multi-language Support

To support multi-language, Typhoon now provides the ability to create a dedicated notices module page.  In **Pages** section, simply click the `+ Add` button in the toolbar and select **Add Module**.  In the modal, choose a title, folder name, and select the parent page.  Make sure you select **Notices** in the modluar template.  This page will be used for all Notices content, and the theme-level configuration will be ignored.

![Notices](notices.png?class=image-shadow)

* **Page Route for Notices data** →  If you have created a Notices module page, you can provide the route to that page in this field.  If the page is found, and it's confirmed to be a `modular/notices` page type, it will be used for all notices configuration.  The section below will be ignored.

You can create multiple notices for your site and they can be configured as follows:

* **Notices Content** → A notice can be plain text, or contain HTML or Markdown.

* **Enabled** → A quick way to enable/disable a particular notice without deleting it.

* **Only Homepage** → Enable this to only show the notice on the homepage.  If set to **No** it will display on every page.

* **Type** → By default there are 4 types available: **Alert** (blue), **Critical** (red), **Note** (yellow), and **Success** (green)

* **Learn More Link** → If provide a "Learn More" link will be added and linked to the value provided here.  It can be a local route, or an external URL.

### Page Level Configuration

Typhoon offers override capabilities for most of the default configuration at a page level.  When Typhoon renders a Twig template and looks for a certain variable, it checks the current page first, then if that variable is not defined on the current page, checks the page's parent, all the way up to the root of the page structure.  If that variable is still not found, the default value from the theme is used.

This allows very powerful configuration options that means you can set specific configurations for a certain section of your site, and then override a specific page in that section if needed.  The rest of the site is going to still use the default values.

### Hero Options

#### Hero Content

Each standard page type has a new tab called **Hero** that lets you configure Hero-specific settings.  At the top of this tab is a section called **Hero Content**, and this is where you control what content shows in your Hero for this page.  If no content is provided, the default fallback is to simply show your page's current **Title** on top of the default image.  The overlay will default to the theme's default values.

![Hero Content](hero-content.png?class=image-shadow)

This section lets you control the following:

* **Subtitle** → The text that displays **above** the main hero title

* **Title Text** → The main hero title text

* **Title Color** → A specific title color. If not set, will default to white on a dark overlay, and black on a light overlay.  You can consult the [Available Colors Classes](#available-classes) document for more information, or check out the [Tailwind Docs](https://tailwindcss.com/docs).

* **Title 2 Text** → A second row of text, works best with a different color. Defaults to same color as main Title.

* **Title 2 Color** → Same as Title Color, for the second Title.

* **Default Text** → Override the automatically selected color for the Hero section. Values include **Auto**, **Light**, and **Dark**

* **Hero Text** → A short hero text paragraph that can be marked-up using Markdown syntax.
  !! If you want to style an hyperlink you can use TailwindCSS classes. For example: `[Typhoon Theme](https://getgrav.org/premium/typhoon?classes=bg-black,bg-opacity-50,hover:text-orange-300,p-1,px-2,rounded,text-orange-500)`

* **Buttons** → One or more optional buttons are available each with their own settings:
    * **Text** → The text to display in the button
    * **Link** → A valid link, either a Grav page route (e.g. `/somepath/somepage`) or an full URL (e.g. `http://somesite.com/somepage`)
    * **Classes** → A string of valid tailwind classes for button color/style

The examples in the screenshot above will result in the following hero:

![Hero Frontend](hero-frontend.jpg?class=image-shadow)

A more full featured example would be:

![Hero Full Featured](hero-full-featured.jpg?class=image-shadow)

#### Hero Settings & Overlay

You have full control over the **Hero Settings**, and the **Hero Overlay** at a page level. You can override any of the default settings here.  See the "Theme Level Configuration" for more information on these settings.


### Advanced Typhoon Options

Typhoon allows you to set some advanced options at the page level. These are located in the **Advanced** tab of standard content pages.

![Page Advanced](page-advanced.png?class=image-shadow)

Most of these options are exactly the same as the ones available in the theme configuration.

The only important one that is not available in the theme, is the toggle to control where the children will display in the menu.

* **Show Children in Secondary Menu** → If you toggle this option, it will force the children of this page that would traditionally show up in the dropdown menu, to display in the sidebar as secondary menu.  It really is an override of the **Primary Header Levels** setting from the theme.

* **Menu "Before" Icon** → You can now add a custom **SVGIcons** compatible icon **before** the menu entry by providing it here.  For example: `tabler/stars.svg`

* **Menu "After" Icon** → You can now add a custom **SVGIcons** compatible icon **after** the menu entry by providing it here.  For example: `tabler/arrow-right.svg`

* **Menu Icon Classes** → Additional Tailwind CSS classes that can provide unique styling to these specific menu items.

### Modular On-Page Menu

Modular pages in Typhoon can show their own on-page navigation that links to each modular sub-page section. This is a per-page setting and is configured under the **Advanced** tab of a **Modular** page. There are two display modes available, controlled by a pair of toggles.

* **Modular On-Page Menu** → Enables an on-page menu of the sections (modular sub-pages) on this modular page. This is `Off` by default, so you opt-in on a page-by-page basis. When this is `Off`, neither of the two display modes below is rendered.

* **Replace Main Menu** → Controls how the on-page menu is displayed. This option only takes effect when **Modular On-Page Menu** is enabled.
    * **Yes** (default) → The on-page menu **replaces the main header navigation** for this page. This is the original on-page menu behavior and is well-suited to standalone landing pages where the modular page is intended to be self-contained and you do not want the global site navigation competing for attention.
    * **No** → The main header navigation **stays intact**, and a separate sticky **scrollspy bar** slides into view as the visitor scrolls down the page. The active section is automatically highlighted as the visitor passes over each modular sub-page. This is the right choice when you want both global site navigation and section-level navigation visible on the same page.

The scrollspy bar respects the **Fixed Header Bar** setting, so the active scroll position and the bar's slide-in offset are aligned correctly regardless of whether your header is fixed or static.

## Supported Page Types

#### Standard Page Types

Typhoon comes standard with some common page types:

* **Default** → The standard page with an optional hero section, plus content area
* **Modular** → A page that lets you create complex modular pages by building a page from modular sub-child pages. When used, you should setup the Hero as a modular sub-page.
* **Blog** → A blog listing page.  Children should be **Post** type pages.
* **Post** → A blog post entry page.
* **Error** → A simple error page to be used in conjunction with the `error` plugin.

#### Modular Page Types

Typhoon also comes with a variety of modular sub page types. These should be used as children of a **Modular** page. The best way to see these in action is to checkout and install the [typhoon-onepage-site](https://github.com/trilbymedia/grav-skeleton-typhoon-onepage?target=_blank) skeleton.

* **Starter Module** → A starter module that can be used to build other modular page types
* **Hero** → Contains the same options as the Page-level Hero section (should be first if used).
* **Features** → Provides the ability to create a list of features in either Horizontal or Vertical mode
* **Image Block** → A simple block that contains an image and a block of text.  You can set a few options such as **Subtitle**, **Title Color**, **Image** and **Image Alignment**, as well as providing some content.
* **Text Columns** → Another simple modular block that uses CSS columns to display your content in a number of columns.  The columns are reduced based on responsive breakpoints, but you can set a max number for columns.
* **Gallery** → Makes use of the [Lightbox Gallery](https://getgrav.org/premium/lightbox-gallery) plugin to display a grid of images and have them be clickable and launch a lightbox with a title and description then allow navigation between the other images in the gallery.
* **Contact** → A simple contact form. Note: You have to use the **Expert** mode to make modifications to the actual form.

## Theme Modification

### Create a Custom Theme from Typhoon

It is strongly advised to create a new theme based on Typhoon if you want to make any modifications to the Twig templates, CSS etc.  Typhoon makes a fantastic base theme to build your custom theme on top of because it has already been built responsively, and with a powerful navigation system.  These are the most complex and time-consuming aspects of building any theme.

To create your new custom theme, simply install the `devtools` plugin for Grav.  Then from the CLI run the command:

```shell script
bin/plugin devtools new-theme
```

This will then ask you for some information about your new theme.  When it asks you how to create the new theme select **copy** (_STRONGLY RECOMMENDED_) or **Inheritance**, then choose **Typhoon** as the theme to copy/inherit.  Of course this means you must have Typhoon already installed in your Grav installation.  

###### If you chose **copy** (RECOMMENDED)
This will then create a copy of Typhoon but with your new theme name.  From this point forward, make all your changes in the new theme.

###### If you chose **inheritance** (NOT RECOMMENDED)
To configure your theme with the same features as Typhoon in Grav Admin Panel, you must copy the `form:` section of `typhoon/blueprints.yaml` into your new theme `blueprints.yaml` file. It is also recommended copying the `dependencies:` section.

### Modify the CSS

While Typhoon is highly customizable, you will undoubtedly want to make your own tweaks and modifications to the design of the theme. Some of this is done via CSS which is powered by the [TailwindCSS](https://tailwindcss.com/) framework. You will need to familiarize yourself with this framework, but have no fear, it's very well documented and has an active and supportive community.

#### Installing NPM to Compile CSS

99% of everything you need to make modifications is actually already available in Tailwind's utility classes, and you can apply these directly in your Twig templates, or even directly in your content using HTML or shortcodes.  

Depending on your platform, installing NPM is different. So please follow the official [NPM Installation Instructions](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm?target=_blank) to accomplish this. After you have NPM installed you will first need to install the required packages, you can do this by just typing `npm install` in the root of the typhoon theme:

> [!NOTE]
> Replace `typhoon` with your custom theme name if you have already created a custom theme from Typhoon.

 ```shell script
cd user/themes/typhoon
npm install
```

In case you ever want to upgrade the packages (such as to use the latest version of TailwindCSS) run this:

```shell script
npm update
```

###### Additional steps for **inheriting** themes

> [!IMPORTANT]
> If you aren't [creating a custom theme](#create-a-custom-theme-from-typhoon), or you decided to opt for the **copy** option, you can skip this step.

If you chose to inherit from Typhoon when [creating your theme](#create-a-custom-theme-from-typhoon), a few more steps are required for NPM to work properly.

1. From the original Typhoon theme folder, copy the following files into your new theme's folder: `package.json`, `vite.config.ts`
2. Create a new file `css/site.css` in your new theme, with the following content: 
  ```sass
  @import '../../typhoon/css/site.css';
  ```
  You will also be able to add your own CSS declarations and imports in this file, going forward.
3. Finally, run the `npm install` command as explained in the previous section, and you are ready to continue on. 


#### Developing Custom CSS

There are times when you need to step beyond the TailwindCSS-provided utility classes and use your own custom CSS.  This is most likely to occur when you have no ability to change the output and include the required classes.  For these situations, or when you want to make modifications to the core `site.css` file or add your own custom css, you need to recompile the development `build/css/site.css` file.  The best way to do this is to run in a dynamic `dev` mode that automatically recompiles when a change is detected:

> [!NOTE]
> If you are using Windows, we are aware of an issues with Tailwind's JIT and **Powershell**. Please use **WSL** instead of Powershell and you should be able to get compilation working ([WSL Documentation](https://docs.microsoft.com/en-us/windows/wsl/install?target=_blank&rel=noopener%20noreferrer)).

```shell script
npm run dev
```

If you want to do a quick compile that does not watch and simply compiles to a compressed format, simply use:

```shell
npm run prod
```

The custom modifications should be put in the `css/custom/` folder.  If you create a new file you should reference that in the top level `css/site.css` file to ensure it gets picked up and compiled. Best practices for developing custom Tailwind CSS dictates that you should try to use the existing Tailwind classes via the `@apply` directive as much as possible to ensure global configuration trickles down to your custom CSS.

A good example of this approach can be found in the `css/custom/typography.css` file, and here's a short extract from it:

```sass
[x-cloak] {
    @apply hidden;
}

.site-logo {
  img, svg {
    @apply h-full;
  }
}
```

#### Building Tailwind for Production

Prior to JIT support in Tailwind CSS it was essential to compile your CSS for production before using. The `site.css` file is always **purged** and is already optimized to only include the required CSS files.  This means that you no longer have to build a specific production version of your CSS.  You can simply use the default `site.css`. 

However, you still should use `npm run dev` or `npm run prod` to ensure that the site.css always contains the Tailwind CSS classes you are using.

#### Troubleshooting CSS issues

The Tailwind CSS file which is compiled into `build/css/site.css` file is built via the `css/site.css` and is fully configured here.  You can find full information on the TailwindCSS site, but with the latest version 4.0, files that contain CSS classes are automatically found within the theme.  If you have any other locations outside of the theme, you can use the new `@source` command to include them.  By default this looks like:

`css/site.css`
```sass
/* Set extra source folders relateive to the current file */
@source "../../../config";
@source "../../../pages";
@source "../../../plugins/sandbox-support/templates";
```

Feel free to edit or adjust this file to include paths and files that need to be inspected for possible Tailwind CSS classes. 

At the root of your Typhoon theme you can find an `available-classes.md` file that you can consult at any time. This file also allows keeping certain classes upon purge which is used for the build of the production css, even if they have never been used.

> [!NOTE]
> Note: If you change the theme name, you should also change the `typhoon.yaml` and `typhoon.php` section in the purge configuration.

### Modify Twig Templates

Most modifications will take the form of editing the [Twig templates](https://twig.symfony.com/doc/3.x/templates.html) which controls the HTML but also is used for setting the Tailwind utility classes for CSS. These are organized in the `templates/` folder of the theme.

If you have already created a new custom theme based on Typhoon, then you can edit this as you need.  Also, you can override other twig files that come from plugins for example, simply copy the Twig file from the plugin (including any folder structure inside the plugin's templates folder) and copy into your theme's templates folder.  Then you can modify the twig as you need to get the desired result. 

A good example of this can be seen in the `templates/partials/pagination.html.twig` where the `pagination` plugin's existing twig partial, has been copied to Typhoon and modified to make use of Tailwind's CSS utility classes.  No custom CSS was required because all the modifications were made directly by modifying the Twig file.

### Using SVG Icons in Typhoon

If you want to use SVG icons in Typhoon, you can use the **Features** modular sub-page as an example to follow.

In the markdown we have a custom frontmatter variable defined called `features`:

```yaml
features:
    -
        title: 'Markdown Syntax'
        icon: tabler/pencil.svg
    -
        title: 'Twig Templating'
        icon: tabler/template.svg
    -
        title: 'Smart Caching'
        icon: tabler/bolt.svg
...
```

The relevant Twig code (`templates/modular/features.html.twig`) looks like this:

{% verbatim %}
```twig
{% for feature in page.header.features %}
        <div class="flex duration-300 transform hover:scale-105">
        {% if page.header.variation == 'vertical' %}

            <div class="flex flex-col w-full rounded-md group hover:bg-gray-100 dark:hover:bg-gray-800">
                {% if feature.link %}
                <a class="group-hover:text-primary dark:group-hover:text-primary" href="{{ url(feature.link) }}">
                {% endif %}
                    <div class="text-gray-500 group-hover:text-primary rounded-md p-3 text-center">
                            {{ svg_icon(feature.icon, 'w-16 h-16 stroke-current stroke-3/2 mx-auto')|raw }}
                    </div>
```
{% endverbatim %}

Here you can see that we're looping over the `page.header.features` and assigning each entry as a `feature` variable. Then at the bottom of the snippet you will see the `svg_icon()` Twig function called, that passes the name of the icon, and then takes a second argument of a string Tailwind classes to give the correct stroke, color etc.

If you want to target a specific icon directly, or use a different icon set, you can simply change the path, for example:

{% verbatim %}
```twig
{{ svg_icon('brands/codeship.svg', 'w-16 h-16 stroke-current stroke-3/2 mx-auto')|raw }}
```
{% endverbatim %}

Also feel free to play with the Tailwind classes to make the icons a different size, or color, etc.

### Adding a different Title font

A common task is to either change the existing font, or adding a new unique font for just titles (`h1`, `h2`, `h3`, etc.).  This process assumes you have already downloaded a web font you want to use on your local machine.  We Recommend only using `.woff2` files as they are supported by all modern browsers and are better compressed and will ensure the best performance.

1. Enable the **watch** command: `npm run dev`

2. Add your downloaded font to the `fonts/` folder. E.g. `Sora-VariableFont_wght.woff2`

3. Add the `@font-face` definition in the `css/custom/fonts.css` file. Make sure the filename exactly matches the filename of the font file you added:

```css
@font-face {
  font-family: 'Sora var';
  src: url("../../fonts/Sora-VariableFont_wght.woff2?v=3.12") format("truetype");
  font-weight: 100 900;
  font-display: swap;
  font-style: normal;
}
```

4.  In your `site.css` file, look for the `@theme` block where there's an existing `--font-sans` definition.  Below this add another entry for your title font:

```sass
--font-title: 'Sora var', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', 'Roboto', '"Helvetica Neue"', 'Arial', '"Noto Sans"', 'sans-serif', '"Apple Color Emoji"', '"Segoe UI Emoji"', '"Segoe UI Symbol"', '"Noto Color Emoji"';
```

5. Now edit your `css/custom/typography.css` file and add a definition to assign all headers this new `font-title` class. Of course, you can adjust this to use only the heading levels you want:

```css
h1, h2, h3, h4, h5, h6 {
  @apply font-title;
}
```

6. Rebuild if you have not already had a watch started.  `npm run prod`

7. You might find your font is not displaying due to browser cache,  Hold `SHIFT` and and click **Reload** icon.

### Removing Dark mode

If you only want to remove the "dark" mode from Typhoon theme, it requires a few manual steps.  These are best accomplished in a text editor.

edit the `css/site.css` file and comment out (or remove if you are confident!) the following entry:

```js
/* Sets the dark mode to use the .dark class if available */
@custom-variant dark (&:where(.dark, .dark *));
```

Make sure you save this file.  Now you have to remove all the `dark:` class definitions in the custom CSS.  This is a bit of a manual process, so use a good editor like VSCode, PHPStorm, etc.

Do a "find in files" for the `css/` folder and search all files for `dark:`, then one-by-one, remove any of these dark entries. If the CSS entry only has dark entries, then you can remove the whole block.  For example, you can remove this whole section:

```css
.notices a {
  @apply dark:text-gray-100;
  &:hover {
    @apply dark:text-white;
  }
}
```

but this CSS code:

```css
.has-submenu:hover {
    @apply bg-gray-100 dark:bg-gray-800 transition duration-300;
}
``` 

Should just be edited to remove the `dark:` entries only:

```css
.has-submenu:hover {
    @apply bg-gray-100 transition duration-300;
}
``` 

When there are no remaining `dark:` entries left, you should be able to compile the CSS with:

```
npm run prod
```

If you get no errors, then you have successfully removed dark mode from the CSS.

You can optionally remove any `dark:` classes from the `templates/` folder as these will no longer have any effect.  This is not going to cause any errors, but it will save a few bytes of HTML.

### Customizing the Header menu

There are situations where you want to control things above and beyond the built-in capabilties of Typhoon. The Header bar is a prime example of this and one of the most powerful approaches is to simply use CSS to accomplish your goals.

Let's assume you have already used the **devtools** plugin and [created your own theme using the instructions above](#create-a-custom-theme-from-typhoon).  Make sure you are have read the section on [developing custom css](#developing-custom-css) and are in **watch** mode so that any CSS modifications are picked up and compiled.

For this example we'll write some custom CSS to make the **header height smaller** when it's scrolled. 

First let's create a new css file: `css/custom/headerbar.css` and add a reference to this in the `css/site.css` file:

`css/site.css`:
```css
...
@import "./custom/headerbar.css";

@tailwind base;
@tailwind components;
@tailwind utilities;
``` 

Then we now create the custom CSS:

`css/custom/headerbar.css`:
```scss
header.scrolled {
    & > div, & nav > div > ul  {
        @apply h-10;
    }
}
```

This simply looks for the `.scrolled` class to be added to the `<header>` tag, and when that is the case, it applies a smaller `h-10` height (rather than the default `h-16`) the div that is a direct descendent (the one where the `h-16` is applied by default).  We also have to apply the `h-10` to the `<ul>` tag that is inside the `<nav>` tag as this also has the height specified on it.

That's it! The CSS should recompile when you save the file, and then you will see the desired behavior on your site.

### Programatic Menu Items

In Grav, the menu is built automatically by the page structures.  All "visible" pages (this includes pages that are automatically visible by **Numeric Prefix** being enabled, or by `visible` being manually enabled) are included in the menu. Child pages are automatically displayed as dropdown menu items in the menu, and you can override the `menu` text independently of the `title` as needed. WIth the latest version of Typhoon, you can even add custom icons to the menu items.

However, there is often a need to add items to the menu that is beyond the capabilities of pages. Plugins such as **Login** and **Langswitcher** are great examples of dynamic logic that makes sense to be displayed in the menu.  The latest version of Typhoon has support for both **Login** and **Langswitcher** but there's also a new `onSiteThemeMenu()` event available that you can listen to to manipulate and add menu items programatically.  The best way to see how this works is to follow this example.

#### 1. Listen to the `onSiteThemeMenu()` event

In either your custom plugin, or custom theme, you need to listen to the `onSiteThemeMenu()` and create a function where you want to add your custom logic. In this example we will use a custom plugin we've already created with the **DevTools** plugin called `sandbox-support` that has a corresponding `sandbox-support.php` file:

```php
// user/plugins/sandbox-support/sandbox-support.php
public static function getSubscribedEvents()
{
    return [
        'onPluginsInitialized' => [
            ['autoload', 100001],
            ['onPluginsInitialized', 0]
        ],
        'onSiteThemeMenu' => ['onSiteThemeMenu', 0],
    ];
}
```

#### 2. Create a method to handle event

Then in this same plugin configuration class, we need to create a public method to handle the event:

```php
// user/plugins/sandbox-support/sandbox-support.php
public function onSiteThemeMenu($event)
{
    $menu = $event['menu'];
}
```

`$menu` is a PHP `stdClass` of menu items that can be manipulated as you need.

We get the current state of the menu from the event and then we can do things with it. If you use Xdebug, you can put a break point on that line and inspect the output, or you can use Grav's `dump($menu);` method to get some output in your browser.

#### 3. Create a simple menu item

The simplest way to add a new menu item is to instantiate a new `SiteMenuItem` object and set the `title`, `href`, `rawroute`, and `id`:

```php
// user/plugins/sandbox-support/sandbox-support.php
use Grav\Common\Utils;
use Grav\Theme\SiteMenuItem;

...

public function onSiteThemeMenu($event)
{
    $menu = $event['menu'];

    $link = new SiteMenuItem();
    $link->text = 'Custom Link';
    $link->href = Utils::url('/custom-page');
    $link->rawroute = $link->href;
    $link->id = 'custom-page';

    $menu->{$link->id} = $link->toArray();
}
```

#### 4. Create a Dropdown Menu

```php
// user/plugins/sandbox-support/sandbox-support.php
public function onSiteThemeMenu($event)
{
    $menu = $event['menu'];

    $link = new SiteMenuItem();
    $link->text = 'Custom Link';
    $link->href = Utils::url('/custom-page');
    $link->rawroute = $link->href;
    $link->id = 'custom-page';

    $submenu = [];
    foreach ([1,2,3,4,5] as $counter) {
        $sublink = new SiteMenuItem();
        $sublink->text = "Item $counter";
        $sublink->href = Utils::url("/item-$counter");
        $sublink->rawroute = $sublink->href;
        $sublink->id = "item-$counter";
        $sublink->level = 2;
        $submenu[$sublink->id] = $sublink->toArray();
    }
    $link->links = $submenu;

    $menu->{$link->id} = $link->toArray();
}
```

This will produce a dropdown like this:

![Custom Menu Link](custom-menu-link.png?class=image-shadow)

#### 5. Add an icon

You can also add an icon to your menu items.  We'll add a blue icon to our top level menu item:

```php
use Grav\Plugin\SVGIconsPlugin;

...

// user/plugins/sandbox-support/sandbox-support.php
public function onSiteThemeMenu($event)
{
    $menu = $event['menu'];

    $icon_classes = $this->config->get('theme.menu.icon_classes');

    $link = new SiteMenuItem();
    $link->text = 'Custom Link';
    $link->href = Utils::url('/custom-page');
    $link->rawroute = $link->href;
    $link->id = 'custom-page';
    $link->before_icon = SVGIconsPlugin::svgIconFunction('tabler/gift.svg', $icon_classes . ' text-primary');
...
```

This will produce a menu item like this:

![Custom Menu Link](menu-icon.png?class=image-shadow)
