<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Enums\ThemeMode;
use Filament\Support\Colors\Color;
use App\Filament\Resources\UserResource;
use Filament\Http\Middleware\Authenticate;
use App\Filament\Resources\AdMediaResource;
use App\Filament\Resources\MediaPlanResource;
use App\Filament\Resources\TrafficStatResource;
use Illuminate\Session\Middleware\StartSession;
use App\Filament\Resources\AdminTrafficResource;
use Illuminate\Cookie\Middleware\EncryptCookies;
use App\Filament\Resources\AdPerformanceResource;
use App\Filament\Resources\DocumentationResource;
use Filament\Http\Middleware\AuthenticateSession;
use App\Filament\Resources\MediaPlacementResource;
use App\Filament\Resources\MediaStatisticResource;
use App\Filament\Resources\DailyImpressionResource;
use App\Filament\Resources\PlayLogResource;
use App\Filament\Widgets\MediaStatisticFilterWidget;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('MCM Media Networks')
            // ->viteTheme('resources/css/filament/admin/theme.css')
            ->login()
            ->authMiddleware([
                'role:admin', // tambahan role check
                ])
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
                UserResource::class,
                MediaStatisticResource::class,
                AdminTrafficResource::class,
                DailyImpressionResource::class,
                AdMediaResource::class,
                AdPerformanceResource::class,
                MediaPlacementResource::class,
                // MediaPlanResource::class,
                PlayLogResource::class,
                DocumentationResource::class,
            ])
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
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
