<?php

namespace App\Http\Livewire\Admin;

use App\Models\InfoPage;
use App\Models\InfoPageTemplate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditInfoPageComponent extends Component
{
    use WithFileUploads;

    public $info_page_id;
    public $name;
    public $slug;
    public $image;
    public $values;
    public $info_page_template_id;
    public $info_page_template_component_name;
    public $newImage;

    public function mount($info_page_id)
    {
        $info_page = InfoPage::find($info_page_id);
        $info_page_template = InfoPageTemplate::where('id', $info_page->info_page_template_id)->first();
        $this->name = $info_page->name;
        $this->slug = $info_page->slug;
        $this->info_page_template_id = $info_page->info_page_template_id;
        $this->info_page_template_component_name = $info_page_template->component_name;
        $this->image = $info_page->image;
        $this->values[$this->info_page_template_component_name] = json_decode($info_page->values, true);
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'info_page_template_id' => 'required',
        ]);
    }

    public function updateInfoPage()
    {
        $this->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'info_page_template_id' => 'required',
        ]);
        $info_page = InfoPage::find($this->info_page_id);
        $info_page->name = $this->name;
        $info_page->slug = $this->slug;
        $info_page->info_page_template_id = $this->info_page_template_id;
        if ($this->newImage) {
            unlink('assets/imgs/info-pages/' . $this->image);
            $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
            $this->newImage->storeAs('info-pages', $imageName);
            $info_page->image = $imageName;
        }
        if ($this->info_page_template_component_name) {
            $info_page->values = json_encode($this->values[$this->info_page_template_component_name]);
        }
        $info_page->save();
        session()->flash('success_message', 'Info Page has been updated successfully!');
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
            'livewire.admin.admin-edit-info-page-component',
            [
                'templates' => $templates
            ]
        );
    }
}
