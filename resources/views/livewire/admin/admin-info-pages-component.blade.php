<div>

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index') }}" rel="nofollow">Home</a>
                    <span></span> All Info Pages
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
                                        All Info Pages
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.info-page.add') }}" class="btn btn-success float-end">Add New Info Page </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(Session::has('success_message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('success_message') }}
                                    </div>
                                @endif
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Info Page Name</th>
                                        <th>Slug</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = ($info_pages->currentPage() - 1) * $info_pages->perPage();
                                    @endphp
                                    @foreach($info_pages as $info_page)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td><img src="{{ asset('assets/imgs/info-pages') }}/{{$info_page->image}}" alt="{{ $info_page->name }}" width="60"></td>
                                            <td>{{ $info_page->name }}</td>
                                            <td>{{ $info_page->slug }}</td>
                                            <td>{{ $info_page->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.info-page.edit', ['info_page_id' => $info_page->id]) }}" class="text-info">Edit</a><br>
                                                <a href="#" class="text-dander" onclick="deleteConfirmation({{ $info_page->id }})">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                                    {{ $info_pages->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>


<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="pb-3">Do you want to delete this record?</h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Cancel</button>
                        <button type="button" class="btn btn-danger" onclick="deleteInfoPage()">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function deleteConfirmation(id)
        {
        @this.set('info_page_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteInfoPage()
        {
        @this.call('deleteInfoPage');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush
