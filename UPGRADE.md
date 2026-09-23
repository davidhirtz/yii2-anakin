# Upgrading to 3.0

## Requirements

- PHP `^8.3`
- `davidhirtz/yii2-skeleton` `^3.0`
- The bundle has no database tables and no migrations. Nothing to run after `composer update`.

## Renames

### Namespaces

| v2                           | v3              |
|------------------------------|-----------------|
| `davidhirtz\yii2\anakin\`    | `Hirtz\Anakin\` |
| `davidhirtz\yii2\anakin\assets\` | `Hirtz\Anakin\Assets\` |

### Classes

| v2                          | v3                                |
|-----------------------------|-----------------------------------|
| `assets\AnakinAsset`        | `Assets\AnakinAssetBundle`        |
| `assets\AnakinMailAsset`    | `Assets\AnakinMailAssetBundle`    |
| `Bootstrap`                 | `Bootstrap` (unchanged)           |

New in 3.0: `Modules\Admin\Widgets\Navs\AnakinNavBar`, `AnakinAsideMenu`, `AnakinLogo` and
`AnakinDashboardLogo`.

### Constants and properties

| v2                                       | v3                                                 |
|------------------------------------------|----------------------------------------------------|
| `AnakinAsset::DEFAULT_LOGO_URL`          | `AnakinAssetBundle::DEFAULT_LOGO_URL` (`final`)    |
| `AnakinMailAsset::DEFAULT_LOGO_URL`      | `AnakinMailAssetBundle::MAIL_LOGO_URL` (`final`)   |
| `AnakinAsset::$_logoUrl` (protected)     | private; use `getLogoUrl()` / `setLogoUrl()`       |
| `AnakinAsset::$publishOptions`           | removed (the source directory holds only built files) |

`$logoAttributes`, `getLogoUrl()`, `setLogoUrl()`, `AnakinMailAsset::$showAnakinLogo` and `$logoWidth` keep
their names on the renamed classes.

### Files and paths

| v2                                            | v3                                                |
|-----------------------------------------------|---------------------------------------------------|
| `src/views/layouts/mail.php`                  | `resources/mail/layouts/html.php`                 |
| `src/views/dashboard/index.php`               | `resources/views/dashboard/index.php`             |
| `src/messages/<lang>/anakin.php`              | `messages/<lang>/anakin.php`                      |
| `src/assets/anakin/css/admin.min.css`         | `resources/assets/dist/css/anakin.css`            |
| `src/assets/anakin/scss/`                     | `resources/assets/src/css/anakin.scss`            |
| `@anakin/views/layouts/mail` (alias target)   | `@anakin/../resources/mail/layouts/html`          |
| `/images/favicons/favicon-32x32.png` (favicon) | `/images/favicons/favicon.svg`                   |

### Message keys

The `anakin` category is keyed and runs with `forceTranslation`. The English texts are no longer keys:

| v2                                   | v3                         |
|--------------------------------------|----------------------------|
| `Hello {name}, good to` + `have you back!` | `ANAKIN_DASHBOARD_HEADER` (`{user}`) |
| `Need a hand?`                       | `ANAKIN_DASHBOARD_CONTACT` |
| `Skype with ANAKIN`                  | removed                    |
| `What do you want <br>to do today?`  | removed                    |

Shipped languages are `de`, `en-US`, `fr` and `pt`; `ru`, `zh-CN` and `zh-TW` are gone.

### CSS

`anakin.css` is an override layer on the skeleton's `admin.css`, not a rebuilt copy of it, so every class the v2
theme restyled now comes from the skeleton. The theme's own classes are `.anakin-navbar`, `.anakin-aside`,
`.anakin-logo-wrap` and `.anakin-logo`. The v2 `home-*` dashboard classes are no longer styled.

## Configuration

The bootstrap sets the same things as before, all of them overridable: `params.email` (default
`hello@anakin.co`), the favicon on `Hirtz\Skeleton\Assets\AdminAssetBundle::$faviconOptions`, the mail layout
alias, the dashboard `view.theme.pathMap` entry and the `anakin` message source.

The favicon default changed to SVG. A project keeping its PNG sets the options itself:

```php
'components' => [
    'assetManager' => [
        'bundles' => [
            \Hirtz\Skeleton\Assets\AdminAssetBundle::class => [
                'faviconOptions' => [
                    'href' => '/images/favicons/favicon-32x32.png',
                    'sizes' => '32x32',
                    'type' => 'image/png',
                ],
            ],
        ],
    ],
],
```

The bootstrap no longer empties `AdminAssetBundle::$css` and no longer touches the TinyMCE skin bundle. A project
that re-added the skeleton CSS by hand removes that.

New: the navbar and the aside are replaced through the container. The bootstrap binds
`Hirtz\Skeleton\Modules\Admin\Widgets\Navs\NavBar` to `AnakinNavBar` and `…\AsideMenu` to `AnakinAsideMenu` only
when the container has no definition for them, so a project's own definition wins:

```php
'container' => [
    'definitions' => [
        \Hirtz\Skeleton\Modules\Admin\Widgets\Navs\NavBar::class => \App\Widgets\NavBar::class,
    ],
],
```

## Code changes

### Asset bundle references

Replace `davidhirtz\yii2\anakin\assets\AnakinAsset` with `Hirtz\Anakin\Assets\AnakinAssetBundle` and
`AnakinMailAsset` with `AnakinMailAssetBundle`, including in `assetManager.bundles` keys. A subclass overriding
`DEFAULT_LOGO_URL` cannot: both constants are `final`. Ship the file at the constant's path or call
`setLogoUrl()`.

### Mail logo URL

`AnakinMailAssetBundle::getLogoUrl()` now answers an absolute URL built from `urlManager.hostInfo`, falls back
to the admin logo (`/images/admin/logo.svg`) when `/images/mail/logo.svg` is missing, and answers `false` when
no host is configured. A console command sending mail needs `urlManager.hostInfo` for the logo to render; the
v2 layout built the URL with `Url::to($logo, true)` at render time.

### Mail layout

The layout no longer publishes fonts: `ATC Overlook` and `Bebas Neue` load from `https://www.anakin.co/mail/`,
as does the Anakin footer logo. A project that copied the v2 layout to reach `$asset->baseUrl` drops that;
`$asset->showAnakinLogo` and `$asset->logoWidth` are read as before.

### Dashboard view

A project overriding `@anakin/views/dashboard` re-points its `pathMap` to
`@anakin/../resources/views/dashboard` and rewrites the view: the controller passes no `$panels`, the
`Nav::widget()` API is gone, and the view renders `Hirtz\Skeleton\Modules\Admin\Widgets\Navs\DashboardHeader`,
`AnakinDashboardLogo`, the skeleton's `MigrationAlert`, `DirectoryAlert`, `EnvironmentAlert` and
`SentryAlert`, then `Hirtz\Skeleton\Widgets\Panels\Dashboard`.

### Logo widgets

The aside logo is `AnakinAsideMenu::getHeader()`, which renders `AnakinLogo::make()->useHref()`; the navbar
inlines the SVG through `AnakinNavBar::renderContent()`. A project needing a different logo overrides
`AnakinLogo::getLogo()` and re-binds the two nav classes in the container.

## Removed

- The TinyMCE skin (`TinyMceSkinAssetBundle::$sourcePath`) and editor `content_css` overrides; the skeleton's TinyMCE styling applies
- The published `fonts/`, `images/flags/`, `transparent.svg` and `bg.png` assets
- The Skype dashboard item and the "What do you want to do today?" line
- The `ru`, `zh-CN` and `zh-TW` message files
