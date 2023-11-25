<?php

namespace App\Http\Livewire\Admin;

use App\Models\InfoPage;
use App\Models\InfoPageTemplate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddInfoPageComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $image;
    public $values;
    public $info_page_template_id;
    public $info_page_template_component_name;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'image' => 'required|max:255',
            'info_page_template_id' => 'required',
        ]);
    }

    public function addInfoPage()
    {
        $this->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'image' => 'required|max:255',
            'info_page_template_id|max:255' => 'required',
        ]);
        $info_page = new InfoPage();
        $info_page->name = $this->name;
        $info_page->slug = $this->slug;
        $info_page->info_page_template_id = $this->info_page_template_id;
        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('info-pages', $imageName);
        $info_page->image = $imageName;
        if ($this->info_page_template_component_name) {
            $info_page->values = json_encode($this->values[$this->info_page_template_component_name]);
        }
        $info_page->save();
        session()->flash('success_message', 'Info Page has been created successfully!');
    }

    public function changeTemplate($value)
    {
        $info_page_template = InfoPageTemplate::where('id', $value)->first();
        if ($info_page_template) {
            $this->info_page_template_component_name = $info_page_template->component_name;
        } else {
            $this->info_page_template_component_name = '';
        }
    }

    public function render()
    {
        $templates = InfoPageTemplate::orderBy('name', 'ASC')->get();
        return view(
            'livewire.admin.admin-add-info-page-component',
            [
                'templates' => $templates
            ]
        );
    }
}
