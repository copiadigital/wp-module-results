# wp-module-results

A Copia Digital WordPress module that provides results/search results template functionality.

## Project Structure

```
src/
├── Callbacks/      # Admin callbacks and hooks
├── Fields/         # ACF field definitions
│   └── Partials/   # Reusable field partials
├── Providers/      # Service providers (PSR-4 pattern)
└── View/
    └── Composers/  # View composers for data binding
resources/
├── scripts/        # JavaScript assets
└── views/          # Blade view templates
```

## Tech Stack

- **PHP**: ^8.0 with PSR-4 autoloading (namespace: `Results\`)
- **Node.js**: ^22.12.0
- **CSS**: Tailwind CSS
- **WordPress**: ACF Pro for custom fields

## Development

This module is installed in a WordPress theme's `modules/` directory and loaded via `modules.php`:

```php
require_once get_template_directory() . '/modules/wp-module-results/results.php';
```

Assets are compiled from the parent theme using `yarn build` or `yarn dev`.

## Conventions

- Use service provider pattern for registering functionality
- ACF fields use the `StoutLogic\AcfBuilder` fluent builder
- View composers follow Laravel-style data binding
- Follow PSR-12 coding standards
