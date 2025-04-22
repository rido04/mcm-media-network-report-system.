<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Enums\ThemeMode;
use Filament\Support\Colors\Color;
use App\Filament\Widgets\LogoWidget;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\AdminResource;
use Filament\Http\Middleware\Authenticate;
use App\Filament\Resources\AdMediaResource;
use App\Filament\Resources\PlayLogResource;
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
use App\Filament\Widgets\MediaStatisticFilterWidget;
use Filament\FontProviders\GoogleFontProvider;
use Filament\FontProviders\LocalFontProvider;
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
            ->font(
                'Roboto',
                url: asset('css/font.css'),
                provider: LocalFontProvider::class,
            )
            ->id('admin')
            ->path('admin')
            ->favicon(asset('/storage/image/logo_mcm.png'))
            ->unsavedChangesAlerts()
            ->brandLogo(asset('/storage/image/logo_mcm.png'))
            ->brandLogoHeight('2.5rem')
            ->login(fn () => redirect('/login'))
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
                AdminResource::class, // admin user management
                UserResource::class, // client user management
                MediaStatisticResource::class, // media plan management
                AdminTrafficResource::class, // category management
                DailyImpressionResource::class, // impression management
                AdMediaResource::class, // media display management
                AdPerformanceResource::class, // media storage manaegement
                MediaPlacementResource::class, // media placement management
                PlayLogResource::class, // play log management
                DocumentationResource::class, //documnetation management
            ])
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
                LogoWidget::class, // logo widget
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
