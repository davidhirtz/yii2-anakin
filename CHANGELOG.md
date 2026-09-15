## 3.0.0 (in development)

- **The admin logo lives here.** `Modules\Admin\Widgets\Navs\AnakinLogo` replaces the skeleton's `AsideLogo`,
  `NavBarLogo` and `Navs\Traits\LogoTrait`, and `AnakinNavBar` / `AnakinAsideMenu` are bound to the skeleton's
  `Navs\NavBar` / `Navs\AsideMenu` through the container, so a project names neither. The navbar inlines the SVG
  path and the aside references it through `AnakinLogo::useHref()`: the navbar renders outside `#wrap` and
  survives every htmx swap, so the definition the `<use>` needs is always on the page
- The `anakin` message source was registered under `@anakin/messages` — the bundle's messages are one directory
  further up — and without `forceTranslation`, so every `ANAKIN_*` key rendered as itself in English
- **The themed dashboard renders again.** `view.theme.pathMap` named
  `@skeleton/../resources/views/admin/views/dashboard`, a directory that has never existed, so the override was
  dead — which is the only reason nobody hit the view behind it, still calling the removed `Nav::widget([...])`
  API and reading a `$panels` variable the dashboard controller stopped passing when `Widgets\Panels\Dashboard`
  replaced it. The view now renders the skeleton's `MigrationAlert`, `DirectoryAlert` and `EnvironmentAlert`
  beside the dashboard panel, as the view it overrides does — a theme that drops them hides the two conditions
  an admin is meant to act on. Its `home-*` markup is unstyled until `anakin.scss` catches up
- The dashboard view translates through `ANAKIN_DASHBOARD_*` keys instead of English literals, and the greeting
  is one key rather than two half-sentences. `messages/config.php` declares `categories`; without it the message
  command deleted every `anakin.php`, since `sourcePath` never reached `resources/views`
- `anakin.css` is built with esbuild from `resources/assets/src/css/anakin.scss` via the skeleton's shared
  `esbuild.config.js` (`npm run build` / `npm run dev`). It is an override layer loaded after the skeleton's
  `admin.css`, not a rebuilt copy of it as in 2.x
- `Assets\AnakinAssetBundle::$sourcePath` points at the bundle's own `resources/assets/dist`; it inherited the
  skeleton's, so `css/anakin.css` was published from the wrong directory
- Renamed `Assets\AnakinAssetBundle::$_logoUrl` to `$logoUrl`

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