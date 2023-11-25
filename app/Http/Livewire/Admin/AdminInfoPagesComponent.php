<?php

namespace App\Http\Livewire\Admin;

use App\Models\InfoPage;
use Livewire\Component;
use Livewire\WithPagination;

class AdminInfoPagesComponent extends Component
{
    use WithPagination;

    public $info_page_id;

    public function deleteInfoPage()
    {
        $info_page = InfoPage::find($this->info_page_id);
        $info_page->delete();
        session()->flash('success_message', 'Info Page has been deleted successfully!');
    }

    public function render()
    {
        $info_pages = InfoPage::orderBy('name', 'ASC')->paginate(5);
        return view('livewire.admin.admin-info-pages-component', ['info_pages' => $info_pages]);
    }
}
