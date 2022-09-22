# REMIND - Typo3 Content Extension

[travis-img]: https://img.shields.io/travis/com/remindgmbh/rmnd-content?style=flat-square
[codecov-img]: https://img.shields.io/codecov/c/github/remindgmbh/rmnd-content?style=flat-square
[php-v-img]: https://img.shields.io/packagist/php-v/remind/rmnd-content?style=flat-square
[github-issues-img]: https://img.shields.io/github/issues/remindgmbh/rmnd-content.svg?style=flat-square
[contrib-welcome-img]: https://img.shields.io/badge/contributions-welcome-blue.svg?style=flat-square
[license-img]: https://img.shields.io/github/license/remindgmbh/rmnd-content.svg?style=flat-square
[styleci-img]: https://styleci.io/repos/393364751/shield

[![travis-img]](https://travis-ci.com/github/remindgmbh/rmnd-content)
[![codecov-img]](https://codecov.io/gh/remindgmbh/rmnd-content)
[![styleci-img]](https://github.styleci.io/repos/393364751)
[![php-v-img]](https://packagist.org/packages/remind/rmnd-content)
[![github-issues-img]](https://github.com/remindgmbh/rmnd-content/issues)
[![contrib-welcome-img]](https://github.com/remindgmbh/rmnd-content/blob/master/CONTRIBUTING.md)
[![license-img]](https://github.com/remindgmbh/rmnd-content/blob/master/LICENSE)


## installation

Use comoser to install the extension using `composer install remind/typo3-content`.

Does not require any typoscript at the moment. TSConfig is imported automatically.

Add the following to your site config for backend layouts to work:

```
imports:
  - { resource: "EXT:rmnd_content/Configuration/Site/settings.yaml" }
```

## dependencies

Besides typo3 the only required dependency is [content-defender](https://extensions.typo3.org/extension/content_defender). It is used in the default backend layout.



## backend layouts

### default

The default layout consists of 1 column with 3 rows. Besides the main content (colPos = 0) there is also one column for content above the breadcrumbs (colPos = 1) and the footer (colPos = 10).

The [content defender](https://extensions.typo3.org/extension/content_defender) extension is used to only allow exactly one footer_content content element in the footer column. The footer_content content element can not be used in the other columns.



## TCA

### tt_content

#### rmnd_content_items

Field of type inline. Basically `rmnd_content_items` acts like tt_content without a `colPos`. Used for `accordion`, `header_slider` and `tabs`. See one of these definition on how to use items and override the showitem definition.

#### header_layout

Values for text, H1-H6 and hidden.

#### background_color

A background color for all content elements. Choice between `none`, `primary`, `secondary`, `accent`, `white` and `black`.

#### background_full_width

Only visible if `background_color` is other than `none`. Used to extend the background color to full width instead of the content container only.

#### space_before_inside

Addition to `space_before`. Space before the content element, but inside the background color. Only available if `background_color` is other than none.

#### space_after_inside

Similar to `space_before_inside`.

### pages

#### overview_label

An `overview_label` field is added to the page TCA. The field should be used to customize the label for the overview pages.



## content elements

### accordion

Uses `rmnd_content_items`, items consist of text (header, subheader, bodytext) only.

### footer_content

Basic definition without any actual content fields. Add a flexform in your provider extension to use `footer_content`:

```php
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:provider_extension/Configuration/FlexForms/FooterContent.xml',
    'footer_content'
);
```

### header_slider

Header Slider content element that uses `rmnd_content_items`. Consists of multiple slides with text and image. Autoplay can be enabled with duration between 500ms and 10000ms.

### tabs

Uses `rmnd_content_items`, items consist of text (header, subheader, bodytext) only.


## QueryExtbase Route Enhancer

QueryExtbase Route Enhancer replaces extbase plugin query parameters with custom names and omits action and controller parameters.

### limitToPages
Required for QueryExtbase route enhancer to work, because without limit all routes would match.

### defaults
Behave the same as described [here](https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ApiOverview/Routing/AdvancedRoutingConfiguration.html#enhancers).

### namespace, extension, plugin, \_controller
Behave the same as described [here](https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ApiOverview/Routing/AdvancedRoutingConfiguration.html#extbase-plugin-enhancer).

### \_arguments
Replace the default query parameter name with a custom one. Key is the name, value the old. For Example `tag: overwriteDemand/tags`.

### aspects
Aspects with the suffix `Label` should use `LocaleModifier` to replace the query parameter name with localized names. So if a query parameter with the argument `page: currentPage` and an Aspect with the key `pageLabel` exists, the localized names would be used.

### example for News Extension

```
  News:
    limitToPages: [20]
    type: QueryExtbase
    extension: News
    plugin: Pi1
    _controller: 'News::list'
    defaults:
      page: '1'
    _arguments:
      page: currentPage
      category: overwriteDemand/categories
    aspects:
      page:
        type: StaticRangeMapper
        start: '1'
        end: '5'
	  pageLabel:
        type: LocaleModifier
        default: page
        localeMap:
          -
            locale: 'de_DE.*'
            value: seite
      category:
        type: PersistedAliasMapper
        tableName: sys_category
        routeFieldName: slug
	  categoryLabel:
        type: LocaleModifier
        default: category
        localeMap:
          -
            locale: 'de_DE.*'
            value: kategorie

```
