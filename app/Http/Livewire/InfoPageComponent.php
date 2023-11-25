<?php

namespace App\Http\Livewire;

use App\Models\InfoPage;
use App\Models\InfoPageTemplate;
use Livewire\Component;

class InfoPageComponent extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $info_page = InfoPage::where('slug', $this->slug)->first();
        if (!$info_page) {
            abort(404);
        }
        $info_page->values = json_decode($info_page->values, true);
        $info_page_template = InfoPageTemplate::where('id', $info_page->info_page_template_id)->first();
        return view(
            'livewire.info-page-component',
            [
                'info_page' => $info_page,
                'info_page_template' => $info_page_template,
            ]
        );
    }
}
