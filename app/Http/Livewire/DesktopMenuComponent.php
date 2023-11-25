<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use Livewire\Component;

class DesktopMenuComponent extends Component
{
    public function render()
    {
        $last_menu = Menu::latest()->first();
        $last_menu_values = json_decode($last_menu->values, true);
        return view('livewire.desktop-menu-component', [
            'last_menu_values' => $last_menu_values,
        ]);
    }
}
