@extends('layouts.app')

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>My Bulletin Board</h1>
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
                    <div class="form-group col-md-4">
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
                    
                    <div class="form-group col-md-4">
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                      <a href="{{url('teacherbulletin')}}" class="btn btn-success" style="margin-top:30px;">Reset</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          
          @foreach($getRecord as $value)
            <div class="col-md-12">
              <div class="card card-primary card-outline">
                <div class="card-body p-0">
                  <div class="mailbox-read-info">
                    <h5>{{$value->bulletinTitle}}</h5>
                    <h6 style="margin-top:10px;">{{ date('d-m-Y', strtotime($value->publishDate))}}</h6>
                    <p><strong>Created By:</strong> {{$value->createdBy_name}}</p>
                  </div>
                  <div class="mailbox-read-message">
                  {!! nl2br(e($value->bulletinDetails)) !!}
                  </div>
                </div>
              </div>
            </div>
          @endforeach

          <div class="col-sm-12">
            <div style="padding: 10px; float: right;">
              {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
