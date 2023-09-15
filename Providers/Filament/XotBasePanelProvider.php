<?php

declare(strict_types=1);

namespace Modules\Xot\Providers\Filament;

use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Illuminate\Support\Str;
use Filament\Pages\Dashboard;
use Filament\Facades\Filament;
use Modules\Xot\Datas\XotData;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;

abstract class XotBasePanelProvider extends PanelProvider
{
    protected string $module;
    protected bool $topNavigation= false;

    public function panel(Panel $panel): Panel
    {
        $moduleNamespace = $this->getModuleNamespace();
        $moduleLow = Str::lower($this->module);
        $xot=XotData::make();
        //$teamClass=$xot->getTeamClass();
        //$teamClass=\Modules\User\Models\Team::class;
        /*
        FilamentView::registerRenderHook(
            'panels::user-menu.before',
            fn (): string =>  Blade::render('@livewire(\'team.change\')'),
        );
        */


        $panel = $panel
            ->default()
            ->login()
            //->registration()
            //->passwordReset()
            //->emailVerification()
            //->profile()
            //->sidebarFullyCollapsibleOnDesktop()
            ->maxContentWidth('full')
            ->topNavigation($this->topNavigation)
            //->navigation(false)
            //->tenant($teamClass)
            //->tenant($teamClass,ownershipRelationship:'users')
            //->tenant($teamClass)
            ->id($moduleLow.'::admin')
            ->path($moduleLow.'/admin')
            ->colors([
                //'primary' => Color::Teal,
            ])
            /*
            ->userMenuItems([
                MenuItem::make()
                    ->label('Settings')
                    //->url(fn (): string => Settings::getUrl())
                    ->icon('heroicon-o-cog-6-tooth'),
                // ...
            ])
            ->navigationItems([
                NavigationItem::make('Analytics')
                    ->url('https://filament.pirsch.io', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-presentation-chart-line')
                    ->group('Reports')
                    ->sort(3),
                NavigationItem::make('dashboard')
                    ->label(fn (): string => __('filament-panels::pages/dashboard.title'))
                    ->url(fn (): string => Dashboard::getUrl())
                    ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.dashboard')),
                // ...
            ])
            */
            ->discoverResources(in: base_path('Modules/'.$this->module.'/Filament/Resources'), for: sprintf('%s\Filament\Resources', $moduleNamespace))
            ->discoverPages(in: base_path('Modules/'.$this->module.'/Filament/Pages'), for: sprintf('%s\Filament\Pages', $moduleNamespace))
            ->pages([
                // Dashboard::class,
            ])
            ->discoverWidgets(in: base_path('Modules/'.$this->module.'/Filament/Widgets'), for: sprintf('%s\Filament\Widgets', $moduleNamespace))
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
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
                Authenticate::class,
            ]);

        /*
        $adminPanel = Filament::getPanel('admin');

        $adminPanel
         ->navigationItems([
             NavigationItem::make('Jobs')
                 ->url($panel->getUrl(), shouldOpenInNewTab: false)
                 ->icon('heroicon-o-users')
                 ->group('Modules')
                 ->sort(3),
         ]);
        */





        return $panel;
    }

    protected function getModuleNamespace(): string
    {
        return config('modules.namespace').'\\'.$this->module;
    }
}