<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Filament\Navigation\NavigationItem;


class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('app')
            ->path('/')
            ->login()
            ->colors([
                'primary' => "#3AC1BD",
                'gray' => Color::Slate,
                'dark-gray' => Color::Gray
            ])
            ->brandLogo(asset("img/logo.svg"))
            ->darkModeBrandLogo(asset("img/logo-light.svg"))
            ->brandLogoHeight("35px")
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')

            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')

            ->maxContentWidth("full")
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
                Authenticate::class,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->sidebarFullyCollapsibleOnDesktop()
            ->databaseNotifications()
            ->readOnlyRelationManagersOnResourceViewPagesByDefault(false)
            ->navigationItems([
                NavigationItem::make('E-Çırak Sistemi')
                    ->url('https://ecirak.com/', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-star')
                    ->group('Linkler'),
                NavigationItem::make('Sevk Sistemi')
                    ->url('https://mbys2.saglik.gov.tr/Account/Login?ReturnUrl=http%3A%2F%2Fmbys2.saglik.gov.tr%2F', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-star')
                    ->group('Linkler'),
                NavigationItem::make('Tınaztepe Sistemi')
                    ->url('https://hbys.tinaztepe.com/', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-star')
                    ->group('Linkler'),


            ]);
    }
}
