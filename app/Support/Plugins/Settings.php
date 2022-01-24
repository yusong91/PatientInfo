<?php

namespace Vanguard\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Vanguard\Support\Sidebar\Item;
use Vanguard\User;

class Settings extends Plugin
{
    public function sidebar()
    {
        $general = Item::create(__('General'))
            ->route('settings.general')
            ->active("settings")
            ->permissions('settings.general');

        $authAndRegistration = Item::create(__('Auth & Registration'))
            ->route('settings.auth')
            ->active("settings/auth")
            ->permissions('settings.auth');

        $notifications = Item::create(__('Notifications'))
            ->route('settings.notifications')
            ->active("settings/notifications")
            ->permissions(function (User $user) {
                return $user->hasPermission('settings.notifications');
            });

        $place = Item::create(__(\Lang::get('Place')))
            ->route('location.index')
            ->active("settings/location")
            ->permissions('location.index');

        $commonCode = Item::create(__(\Lang::get('label.common-codes')))
            ->route('common-codes.index')
            ->active("settings/common-codes")
            ->permissions('common-codes.index');

        return Item::create(__(\Lang::get('Setting')))
            ->href('#settings-dropdown')
            ->icon('fas fa-cogs')
            ->permissions(['settings.general', 'settings.auth', 'settings.notifications'])
            ->addChildren([
                $general, 
                $authAndRegistration,
                $notifications,
                $place,
                $commonCode
            ]);

    }
}
