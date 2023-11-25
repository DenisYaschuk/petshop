<div>

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index') }}" rel="nofollow">Home</a>
                    <span></span> Add New Info Page
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        Add New Info Page
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.info-pages') }}" class="btn btn-success float-end">All Info Pages</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(Session::has('success_message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('success_message') }}
                                    </div>
                                @endif
                                <form wire:submit.prevent="addInfoPage">
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter product name" wire:model="name" wire:keyup="generateSlug()" required>
                                        @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control" name="slug" placeholder="Enter slug" wire:model="slug" required>
                                        @error('slug')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image" placeholder="Choose an Image" wire:model="image" required>
                                        @if($image)
                                            <img src="{{ $image->temporaryUrl() }}" width="120">
                                        @endif
                                        @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="info_page_template_id" class="form-label">Template</label>
                                        <select id="template_select" class="form-control" name="info_page_template_id" wire:model="info_page_template_id" wire:click="changeTemplate($event.target.value)" required>
                                            <option value="">Select Template</option>
                                            @foreach($templates as $template)
                                                <option value="{{ $template->id }}">{{ $template->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('info_page_template_id')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <p class="form-label">Template Values:</p>
                                    </div>
                                    @if($info_page_template_component_name == 'one-column-info-page')
                                        <div>
                                            <div class="mb-3 mt-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" placeholder="Enter title" wire:model="values.one-column-info-page.title">
                                            </div>
                                            <div class="mb-3 mt-3">
                                                <label for="column_title" class="form-label">Column Title</label>
                                                <input type="text" class="form-control" name="column_title" placeholder="Enter column title" wire:model="values.one-column-info-page.column_title">
                                            </div>
                                            <div class="mb-3 mt-3">
                                                <label for="column" class="form-label">Column Text</label>
                                                <textarea type="text" class="form-control" name="column" placeholder="Enter column text" wire:model="values.one-column-info-page.column"></textarea>
                                            </div>
                                        </div>
                                    @elseif($info_page_template_component_name == 'two-column-info-page')
                                        <div>
                                            <div class="mb-3 mt-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" placeholder="Enter title" wire:model="values.two-column-info-page.title">
                                            </div>
                                            <div class="mb-3 mt-3">
                                                <label for="column1_title" class="form-label">First Column Title</label>
                                                <input type="text" class="form-control" name="column1_title" placeholder="Enter first column title" wire:model="values.two-column-info-page.column1_title">
                                            </div>
                                            <div class="mb-3 mt-3">
                                                <label for="column1" class="form-label">First Column Text</label>
                                                <textarea type="text" class="form-control" name="column1" placeholder="Enter first column text" wire:model="values.two-column-info-page.column1"></textarea>
                                            </div>
                                            <div class="mb-3 mt-3">
                                                <label for="column2_title" class="form-label">Second Column Title</label>
                                                <input type="text" class="form-control" name="column2_title" placeholder="Enter second column title" wire:model="values.two-column-info-page.column2_title">
                                            </div>
                                            <div class="mb-3 mt-3">
                                                <label for="column2" class="form-label">Second Column Text</label>
                                                <textarea type="text" class="form-control" name="column2" placeholder="Enter second column text" wire:model="values.two-column-info-page.column2"></textarea>
                                            </div>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-primary float-end" onclick="scrollToTop()">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
