<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index') }}" rel="nofollow">Home</a>
                    <span></span> Edit Menu
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
                                        Edit Menu
                                    </div>
                                    <div class="col-md-6">
                                        <a wire:click="addTab" class="btn btn-success float-end">Add New Tab</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(Session::has('success_message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('success_message') }}
                                    </div>
                                @endif
                                <form wire:submit.prevent="updateMenu">
                                    @foreach ($values as $key => $value)
                                        <div class="menu-edit-item">
                                            <div class="mb-3 mt-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" placeholder="Enter tab name" wire:model="values.{{ $key }}.name" required>
                                            </div>
                                            <div class="mb-3 mt-3">
                                                <label class="form-label">Link</label>
                                                <input type="text" class="form-control" placeholder="Enter tab link" wire:model="values.{{ $key }}.link" required>
                                            </div>
                                            <a wire:click="removeTab({{ $key }})" class="btn-close"></a>
                                        </div>
                                    @endforeach
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

@push('scripts')
    <script>
        function scrollToTop()
        {
            $('html, body').animate({
                scrollTop: $('main').offset().top
            }, 2000);
        }
    </script>
@endpush
