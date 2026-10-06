# filament-kit

Small reusable Filament helpers for Laravel apps. One Composer package; add new macros under `src/` (e.g. `Select/`, `Tables/`).

**No Packagist account required.** Install from GitHub via Composer VCS.

## Requirements

- PHP 8.2+
- Filament Forms 5
- Laravel 11 / 12 / 13

## Install (GitHub VCS)

In your app `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/adityad1997/filament-kit"
    }
  ],
  "require": {
    "adityad1997/filament-kit": "^1.0"
  }
}
```

Then:

```bash
composer update adityad1997/filament-kit
```

The service provider is auto-discovered.

## Prefill create-option from select search

For relationship `Select`s with `createOptionForm()`, remember the last search query and fill that field when the “+” modal opens.

Call **after** `->relationship(...)->searchable()`:

```php
use Filament\Forms\Components\Select;

Select::make('project_id')
    ->relationship('project', 'name')
    ->searchable()
    ->prefillCreateOptionFromSearch('name')
    ->createOptionForm([
        // TextInput::make('name')...
    ])
    ->createOptionUsing(fn (array $data): int => /* create & return key */);
```

Uses session storage keyed by Livewire component id + field state path. Prefill reflects the last **server** search (after the select’s debounce).

## License

MIT
