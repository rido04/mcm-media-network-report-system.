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
            ->colors([
                'gray' => [
                    50 => '#f9fafb',
                    100 => '#f3f4f6',
                    200 => '#e5e7eb',
                    300 => '#d1d5db',
                    400 => '#9ca3af',
                    500 => '#6b7280',
                    600 => '#4b5563',
                    700 => '#374151',
                    800 => '#1f2937',
                    900 => '#111827',
                    950 => '#030712', // Tambahkan ini
                ],
                'primary' => [
                    50 => '#f0f9ff',
                    100 => '#e0f2fe',
                    200 => '#bae6fd',
                    300 => '#7dd3fc',
                    400 => '#38bdf8',
                    500 => '#0ea5e9',
                    600 => '#0284c7',
                    700 => '#0369a1',
                    800 => '#075985',
                    900 => '#0c4a6e',
                    950 => '#082f49'
            ]
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
