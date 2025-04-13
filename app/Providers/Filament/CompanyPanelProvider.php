<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Company\Widgets\MediaStatisticOverview;
use Filament\Http\Middleware\DisableBladeIconComponents;
use App\Filament\Company\Resources\MediaStatisticResource;
use App\Filament\Widgets\CommuterlineChart;
use App\Filament\Widgets\JakartaTrafficChart;
use App\Filament\Widgets\MediaStatChart;
use App\Filament\Widgets\MediaStatisticFilterWidget;
use App\Filament\Widgets\MediaStatisticTableWidget;
use App\Filament\Widgets\TransjakartaUserChart;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Filament\Forms\Components\DatePicker as DateRangePicker;

class CompanyPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('company')
            ->path('company')
            ->login()
            ->authMiddleware([
                'role:company', // tambahan role check
            ])
            ->brandName('MCM Client')
            ->defaultThemeMode(ThemeMode::Dark)
            ->viteTheme('resources/css/filament/company/theme.css')
            ->colors([
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'primary' => Color::Indigo,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->resources([
                // MediaStatisticResource::class
            ])
            ->discoverPages(in: app_path('Filament/Company/Pages'), for: 'App\\Filament\\Company\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
                MediaStatisticFilterWidget::class, // filter widget for statistic overview
                MediaStatisticOverview::class, // statistic overview widget
                MediaStatChart::class, //total impression widget chart
                MediaStatisticTableWidget::class, // widget table
                CommuterlineChart::class, // commuterline User chart widget
                TransjakartaUserChart::class, // Transjakarta user chart
                JakartaTrafficChart::class, //Jakarta Traffic chart widget
                ])
                ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class
            ]);
    }
}
