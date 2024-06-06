@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.subnav', [
        'title' => 'Bulletin List',
        'subtitle' => 'KAFA Bulletin List',
    ])
    <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bulletin</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
              <a href="{{ url('createbulletin')}}" class="btn btn-primary"> Add New Bulletin</a>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Search Bulletin</h1>
              </div> 
              <form method="get" action="">
                <div class="card-body">
                  <div class="row">

                    <div class="form-group col-md-2">
                      <label>Title</label>
                      <input type="text" class="form-control" value="{{Request::get('bulletinTitle') }}" name="bulletinTitle" placeholder="Title">
                    </div>

                    <div class="form-group col-md-2">
                      <label>Publish Date From</label>
                      <input type="date" class="form-control" name="publishDate_from" value="{{Request::get('publishDate_from') }}" >
                    </div>

                    <div class="form-group col-md-2">
                      <label>Publish Date To</label>
                      <input type="date" class="form-control" name="publishDate_to" value="{{Request::get('publishDate_to') }}" >
                    </div>

                    <div class="form-group col-md-2">
                      <label>Message To</label>
                         <select class="form-control" name="publishTo">
                          <option value="">Select</option>
                          <option {{ (Request::get('publishTo') ==2) ? 'selected':'' }} value="2">Teacher</option>
                          <option {{ (Request::get('publishTo') ==3) ? 'selected':'' }} value="3">Parent</option>
                         </select>
                    </div>
                    
                    <div class="form-group col-md-2">
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                      <a href="{{url('listbulletin')}}" class="btn btn-success" style="margin-top:30px;">Reset</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            @include('_message')
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Bulletin List</h1>
              </div>
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Publish Date</th>
                      <th>Publish To</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($getRecord as $value)
                    <tr>
                      <td>{{ $value->bulletinId }}</td>
                      <td>{{ $value->bulletinTitle }}</td>
                      <td>{{ date('d-m-Y', strtotime($value->publishDate)) }}</td>
                      <td>
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
                      <td>{{ $value->createdBy_name }}</td>
                      <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                      <td>
                        <a href="{{ url('editbulletin' . $value->bulletinId) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('deletebulletin' . $value->bulletinId) }}" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="100%">Record not found</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>

                <div style="padding: 10px; float: right;">
                  {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
  @include('layouts.footers.auth.footer')
  @endsection


