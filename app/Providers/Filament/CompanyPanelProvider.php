<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\DocumentationWidget;
use Dom\Document;
use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use CompanyTabsWidget;
use Filament\PanelProvider;
use Filament\Enums\ThemeMode;
use Filament\Support\Colors\Color;
use Filament\Forms\Components\Select;
use App\Filament\Widgets\MediaPlanTable;
use App\Filament\Widgets\MediaStatChart;
use Filament\Forms\Components\TextInput;
use Filament\Http\Middleware\Authenticate;
use App\Filament\Widgets\CommuterlineChart;
use App\Filament\Widgets\AdPerformanceChart;
use App\Filament\Widgets\PlayLogTableWidget;
use App\Filament\Widgets\ActiveAdMediaWidget;
use App\Filament\Widgets\JakartaTrafficChart;
use App\Filament\Widgets\MediaPlanTableWidget;
use App\Filament\Widgets\TransjakartaUserChart;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use App\Filament\Widgets\MediaStatisticTableWidget;
use App\Filament\Widgets\DocumentationGalleryWidget;
use App\Filament\Widgets\MediaStatisticFilterWidget;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Company\Widgets\MediaStatisticOverview;
use Filament\Http\Middleware\DisableBladeIconComponents;
use App\Filament\Company\Resources\MediaStatisticResource;
use App\Filament\Widgets\DashboardTabsWidget;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Filament\Forms\Components\DatePicker as DateRangePicker;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class CompanyPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('company')
            ->path('company')
            ->login()
            ->sidebarCollapsibleOnDesktop()
            ->authMiddleware([
                'role:company', // role check
            ])
            ->brandName('MCM Client')
            ->defaultThemeMode(ThemeMode::Dark)
            ->colors([
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'primary' => Color::Indigo,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->resources([
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
                // MediaStatisticTableWidget::class, // widget table
                CommuterlineChart::class, // commuterline User chart widget
                TransjakartaUserChart::class, // Transjakarta user chart
                JakartaTrafficChart::class, //Jakarta Traffic chart widget
                ActiveAdMediaWidget::class, // active ad media widget
                AdPerformanceChart::class, // ad performance chart widget
                // MediaPlanTableWidget::class, // media plan table widget
                // PlayLogTableWidget::class, // play log table widget
                // DocumentationWidget::class,
                // DocumentationGalleryWidget::class,
                DashboardTabsWidget::class,
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
