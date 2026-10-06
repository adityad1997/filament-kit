<?php

namespace Adityad1997\FilamentKit\Select;

use Filament\Actions\Action;
use Filament\Forms\Components\Select;

class PrefillCreateOptionFromSearch
{
    public static function register(): void
    {
        Select::macro('prefillCreateOptionFromSearch', function (string $field = 'name'): Select {
            /** @var Select $this */
            return $this
                ->getSearchResultsUsing(function (Select $component, ?string $search) use ($field): array {
                    PrefillCreateOptionFromSearch::remember($component, $search);

                    return $component->getSearchResultsFromRelationship($search);
                })
                ->createOptionAction(fn (Action $action): Action => $action->fillForm(
                    function (Select $component) use ($field): array {
                        $value = PrefillCreateOptionFromSearch::pull($component);

                        return filled($value) ? [$field => $value] : [];
                    },
                ));
        });
    }

    public static function remember(Select $component, ?string $search): void
    {
        session([self::sessionKey($component) => trim((string) $search)]);
    }

    public static function pull(Select $component): ?string
    {
        $value = session()->pull(self::sessionKey($component));

        if (! is_string($value)) {
            return null;
        }

        $value = trim($value);

        return $value !== '' ? $value : null;
    }

    protected static function sessionKey(Select $component): string
    {
        return 'filament_kit.select_create_prefill.'.$component->getLivewire()->getId().'.'.$component->getStatePath();
    }
}
