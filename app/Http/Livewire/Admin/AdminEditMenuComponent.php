<?php

namespace App\Http\Livewire\Admin;

use App\Models\Menu;
use Livewire\Component;

class AdminEditMenuComponent extends Component
{
    public $values;

    public function mount()
    {
        $last_menu = Menu::latest()->first();
        $last_menu_values = json_decode($last_menu->values, true);
        $this->values = $last_menu_values;
    }

    public function updateMenu()
    {
        $menu = new Menu();
        $menu->values = json_encode($this->values);
        $menu->save();
        session()->flash('success_message', 'Menu has been updated successfully!');
    }

    public function addTab()
    {
        array_push($this->values, array('name' => '', 'link' => ''));
    }

    public function removeTab($key)
    {
        unset($this->values[$key]);
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-menu-component');
    }
}
