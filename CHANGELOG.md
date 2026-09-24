## Unreleased

- Added `Bootstrap::MEDIA_AVIF_QUALITY`: with `yii2-media` installed, its AVIF transformations default to quality 80

## 3.0.0 (September 23, 2026)

- Renamed the namespace `davidhirtz\yii2\anakin\` to `Hirtz\Anakin\` and the directories to StudlyCase; requires PHP 8.3+ and `davidhirtz/yii2-skeleton` 3.0
- Renamed `assets\AnakinAsset` to `Assets\AnakinAssetBundle` and `assets\AnakinMailAsset` to `Assets\AnakinMailAssetBundle`; the mail logo path is `AnakinMailAssetBundle::MAIL_LOGO_URL` instead of an overridden `DEFAULT_LOGO_URL`, both constants are `final`, and `$_logoUrl` is private
- Moved the mail layout to `resources/mail/layouts/html.php`, the dashboard view to `resources/views/dashboard/index.php` and the messages to `messages/`; the stylesheet is built from `resources/assets/src/css/anakin.scss` into `resources/assets/dist/css/anakin.css` and loads as an override layer after the skeleton's `admin.css` instead of replacing it
- Removed the TinyMCE skin and `content_css` overrides, the published fonts and flag images, the Skype dashboard item and the `ru`, `zh-CN` and `zh-TW` message files
- Replaced the English message texts with the keys `ANAKIN_DASHBOARD_HEADER` and `ANAKIN_DASHBOARD_CONTACT`, translated with `forceTranslation`
- Changed the default favicon to `/images/favicons/favicon.svg` (was `favicon-32x32.png`); the mail layout loads its fonts and the Anakin footer logo from `https://www.anakin.co/mail/`
- Changed `AnakinMailAssetBundle::getLogoUrl()` to fall back to the admin logo and to answer an absolute URL, or `false` when the URL manager has no host
- Added `Modules\Admin\Widgets\Navs\AnakinNavBar` and `AnakinAsideMenu`, bound to the skeleton's `NavBar` and `AsideMenu` through the container unless a project defines them, plus `AnakinLogo` and `AnakinDashboardLogo`
- Changed the dashboard view to render the skeleton's `Widgets\Panels\Dashboard` and the migration, directory, environment and Sentry alerts

## 2.2.2 (Nov 8, 2025)

- Added `HexColorInputWidget` and enhanced display for optional color fields

## 2.2.1 (Oct 21, 2025)

- Fixed static analysis issue

## 2.2.0 (Oct 20, 2025)

- Requires PHP 8.3+
- Added Russian language support

## 2.1.9 (Jan 24, 2024)

- Changed `Bootstrap` I18N configuration

## 2.1.8 (Nov 30, 2024)

- Forced strict types in all PHP files
- Updated dependencies
- 
## 2.1.7 (Oct 2, 2024)

- Added `.text-invalid` CSS class

## 2.1.6 (Sep 4, 2024)

- Forced light mode only in email templates

## 2.1.5 (Mar 11, 2024)

- Added `color` input support

## 2.1.4 (Feb 29, 2024)

- Changed CSS definition `input:-webkit-autofill`

## 2.1.3 (Jan 29, 2024)

- Fixed `Mailer::$htmlLayout` path

## 2.1.2 (Jan 9, 2024)

- Fixed tests

## 2.1.1 (Jan 9, 2024)

- Updated TinyMCE CSS

## 2.1.0 (Dec 21, 2023)

- Added Codeception test suite
- Added GitHub Actions CI workflow

## 2.0.4 (Nov 6, 2023)

- Fixed a bug where the `AnakinAsset` was not registered

## 2.0.3 (Nov 6, 2023)

- Fixed dashboard index view

## 2.0.2 (Nov 6, 2023)

- Changed bootstrap order to allow overriding favicon options in `config/web.php`
- Moved `AdminButton` class to `Hirtz\Skeleton\Widgets\AdminButton`

## 2.0.1 (Nov 5, 2023)

- Moved `Bootstrap` class to base package namespace for consistency

- ## 2.0.0 (Nov 3, 2023)

- Moved source code to `src` folder