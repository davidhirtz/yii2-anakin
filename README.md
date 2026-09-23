# yii2-anakin

The [Anakin](https://www.anakin.co/) admin theme for [yii2-skeleton](https://github.com/davidhirtz/yii2-skeleton):
a stylesheet layered over the skeleton's admin CSS, the Anakin logo in the navbar and the aside, a themed
dashboard, a mail layout and a default contact address. It depends on `davidhirtz/yii2-skeleton` alone and has
no module, no database tables and no console commands.

## Installation

```bash
composer require davidhirtz/yii2-anakin
```

The bundle bootstraps itself through `extra.bootstrap` (`Hirtz\Anakin\Bootstrap`). There is nothing to migrate.
Put the project's own files where the theme looks for them:

| File                                 | Used by                                                         |
|--------------------------------------|-----------------------------------------------------------------|
| `web/images/admin/logo.svg`          | The dashboard logo (`AnakinAssetBundle::DEFAULT_LOGO_URL`)      |
| `web/images/mail/logo.svg`           | The mail header logo (`AnakinMailAssetBundle::MAIL_LOGO_URL`); falls back to the admin logo |
| `web/images/favicons/favicon.svg`    | The admin favicon                                               |

Each is optional: a missing logo renders nothing.

## Configuration

`Bootstrap` registers, in this order, all of it overridable from `config/web.php`:

- The `@anakin` alias (the bundle's `src/`) and the alias `@skeleton/../resources/mail/layouts/html`, re-pointed to
  `resources/mail/layouts/html.php`, so the skeleton mailer's `htmlLayout` renders the Anakin layout.
- The `anakin` message source (`messages/`, `forceTranslation`), unless the project configured one.
- `params.email` defaults to `hello@anakin.co`, the sender of the skeleton's account mails and the address on
  the error page. A project sets its own in `config/params.php`.
- `Hirtz\Skeleton\Assets\AdminAssetBundle::$faviconOptions` pointing at `/images/favicons/favicon.svg`
  (`sizes` `any`, `type` `image/svg+xml`).
- `view.theme.pathMap` mapping the skeleton's `resources/views/admin/dashboard` to the bundle's
  `resources/views/dashboard`.
- Container definitions binding `Hirtz\Skeleton\Modules\Admin\Widgets\Navs\NavBar` to
  `Modules\Admin\Widgets\Navs\AnakinNavBar` and `…\AsideMenu` to `AnakinAsideMenu`, only where the container has
  none. A project's own definition for either class wins.
- `Assets\AnakinAssetBundle` on every action of the admin module.

The bundle has no module, so there are no `modules.<id>.*` flags. Its options live on the two asset bundles,
set through `components.assetManager.bundles`:

| Bundle                     | Property / method              | Default                          | Meaning                                                        |
|----------------------------|--------------------------------|----------------------------------|----------------------------------------------------------------|
| `Assets\AnakinAssetBundle` | `$logoAttributes`              | `['style' => ['height' => '6rem']]` | Attributes of the dashboard logo `<img>`                    |
| `Assets\AnakinAssetBundle` | `setLogoUrl(string\|false\|null)` | `null`                        | `null` uses `/images/admin/logo.svg` if the file exists, `false` renders no logo, a string is used as is |
| `Assets\AnakinMailAssetBundle` | `$showAnakinLogo`          | `true`                           | Renders the Anakin logo below the mail body                    |
| `Assets\AnakinMailAssetBundle` | `$logoWidth`               | `'250px'`                        | CSS width of the mail header logo                              |
| `Assets\AnakinMailAssetBundle` | `setLogoUrl(string\|false\|null)` | `null`                     | `null` uses `/images/mail/logo.svg`, then the admin logo; the URL is made absolute with `urlManager.hostInfo` |

```php
'components' => [
    'assetManager' => [
        'bundles' => [
            \Hirtz\Anakin\Assets\AnakinAssetBundle::class => [
                'logoAttributes' => ['style' => ['height' => '4rem']],
            ],
            \Hirtz\Anakin\Assets\AnakinMailAssetBundle::class => [
                'showAnakinLogo' => false,
                'logoWidth' => '180px',
            ],
        ],
    ],
],
```

`AnakinMailAssetBundle` registers no CSS or JS; it only carries the mail layout's options. Since the mail logo URL
is absolute, a console command sending mail needs `urlManager.hostInfo`; without it the layout renders no
header logo.

## The theme

- `AnakinNavBar` renders the inline SVG logo before the navbar items; `AnakinAsideMenu` renders it again as the
  aside header through `AnakinLogo::make()->useHref()`, referencing the navbar's definition. The logo links to
  the dashboard for a logged-in user.
- The dashboard view greets the user (`ANAKIN_DASHBOARD_HEADER`), shows the project logo through
  `AnakinDashboardLogo`, the skeleton's migration, directory, environment and Sentry alerts, the dashboard
  panels and the Anakin contact card (`ANAKIN_DASHBOARD_CONTACT`).
- The mail layout inlines its styles, loads the `ATC Overlook` and `Bebas Neue` fonts from
  `https://www.anakin.co/mail/` and forces a light colour scheme.
- The stylesheet is built from `resources/assets/src/css/anakin.scss` with `npm run build` inside the bundle,
  which needs the skeleton's `node_modules`; the built `resources/assets/dist/css/anakin.css` is committed, so a
  project installing the bundle builds nothing.

Messages live in `messages/<lang>/anakin.php` for `de`, `en-US`, `fr` and `pt`.
