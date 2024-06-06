@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Bulletin List'], ['subtitle' => 'KAFA Bulletin List'])

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0" style="display: flex; justify-content: space-between; align-items: center;">
                    <h6>Bulletin List</h6>
                    <a class="btn btn-add" href="{{ url('createbulletin') }}">+ Add New Bulletin</a>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">

                        <!-- Search Bulletin Part -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6>Search Bulletin</h6>
                            </div>
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label>Title</label>
                                            <input type="text" class="form-control" value="{{ Request::get('bulletinTitle') }}" name="bulletinTitle" placeholder="Title">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Publish Date From</label>
                                            <input type="date" class="form-control" name="publishDate_from" value="{{ Request::get('publishDate_from') }}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Publish Date To</label>
                                            <input type="date" class="form-control" name="publishDate_to" value="{{ Request::get('publishDate_to') }}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Message To</label>
                                            <select class="form-control" name="publishTo">
                                                <option value="">Select</option>
                                                <option {{ Request::get('publishTo') == 2 ? 'selected' : '' }} value="2">Teacher</option>
                                                <option {{ Request::get('publishTo') == 3 ? 'selected' : '' }} value="3">Parent</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 d-flex align-items-end">
                                            <button class="btn btn-primary" type="submit">Search</button>
                                            <a href="{{ url('listbulletin') }}" class="btn btn-success ms-2">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Bulletin List -->
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Publish Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Publish To</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created By</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created Date</th>
                                    <th class="text-center text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($getRecord as $value)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $value->bulletinTitle }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ date('d-m-Y', strtotime($value->publishDate)) }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            @foreach($value->getBulletinDetails as $bulletinDetails)
                                                @if($bulletinDetails->publishTo == 2)
                                                    <div>Teacher</div>
                                                @elseif($bulletinDetails->publishTo == 3)
                                                    <div>Parent</div>
                                                @elseif($bulletinDetails->publishTo == 4)
                                                    <div>Muip</div>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $value->createdBy_name }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ date('d-m-Y', strtotime($value->created_at)) }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ url('editbulletin' . $value->bulletinId) }}" class="p-1 text-white text-secondary button view-bg justify-content-center ps-2 me-2 border border-dark" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="{{ url('deletebulletin' . $value->bulletinId) }}" class="p-1 text-white text-secondary button bg-danger ps-2 pe-2 border border-dark" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this bulletin?');">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No data available in table</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="p-2 float-right">
                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footers.auth.footer')
@endsection

<script>
window.onload = function() {
    @if(session('success'))
    alert("{{ session('success') }}");
    @endif

    @if(session('error'))
    alert("{{ session('error') }}");
    @endif
}
</script>
<script>
function deleteBulletin(bulletinId) {
    if (confirm('Are you sure you want to delete this bulletin?')) {
        fetch(`/bulletins/${bulletinId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
        })
        .then(response => {
            if (response.ok) {
                window.location.href = '/bulletins';
            } else {
                console.error('Failed to delete bulletin');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}
</script>
