@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Bulletin</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" value="{{$getRecord->bulletinTitle}}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Publish Date</label>
                                <input type="date" class="form-control" value="{{$getRecord->publishDate}}" readonly>
                            </div>
                            @php
                                    $publishTo_teacher = $getRecord->getBulletinDetailsToSingle($getRecord->bulletinId, 2);
                                    $publishTo_parent = $getRecord->getBulletinDetailsToSingle($getRecord->bulletinId, 3);
                                    
                            @endphp

                            <!-- Checkbox for publish to -->
                            <div class="form-group">
                                <label style="display: block;">Publish To </label>
                                <label style="margin-right: 40px;">
                                    <input type="checkbox" value="4" {{ !empty($publishTo_teacher) ? 'checked' : '' }} disabled> Teacher
                                </label>
                                <label style="margin-right: 40px;">
                                    <input type="checkbox" value="2" {{ !empty($publishTo_parent) ? 'checked' : '' }} disabled> Parent
                                </label>               
                            </div>

                            <div class="form-group">
                                <label>Bulletin Details</label>
                                <textarea id="compose-textarea" class="form-control" style="height: 300px" readonly>{{$getRecord->bulletinDetails}}</textarea>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="{{ url('listbulletin') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection

@section('script')
   
<script src="{{url('public/dist/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script type="text/javascript">

$(function () {

    $('#compose-textarea').summernote({
        height: 300,                 
        minHeight: null,             
        maxHeight: null,            
        focus: true                  
    })
});
</script>
    
@endsection
