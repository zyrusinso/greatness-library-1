@extends('app.layouts.master')

@section('title')Admin - Books | Library
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush
@section('content')
@component('app.components.admin_breadcrumb')
@slot('breadcrumb_title')
<h3>Book Return</h3>
@endslot
<li class="breadcrumb-item active">Book Return</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Book Return</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Title</th>
                                    <th>Borrowing Date</th>
                                    <th>Due Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($returns as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ App\Models\User::getUser($item->user_id)->fname }} {{ App\Models\User::getUser($item->user_id)->lname }}</td>
                                        <td>{{ App\Models\Book::getBook($item->book_id)->title }}</td>
                                        <td>{{ Carbon\Carbon::parse(App\Models\Borrow::getBorrow($item->borrow_id)->created_at)->format('M j Y') }}</td>
                                        <td>{{ Carbon\Carbon::parse(App\Models\Borrow::getBorrow($item->borrow_id)->due_date)->format('M j Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script src="{{asset('assets/js/sweet-alert2/sweetalert.all.min.js')}}"></script>
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>

<script>
    $('#myTable').DataTable({
        "paging":   true,
        "ordering": true,
        "info":     true
    });
</script>

<script>
    function deleteData(el){
        var form = document.getElementById('deleteDataForm'+el.dataset.id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your data has been deleted.',
                    'success'
                ).then((result) => {
                    if(result.isConfirmed){
                        form.submit();
                        // window.location = window.location.pathname;
                    }
                })
            }
        })
    }
</script>
@endpush
@endsection