@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Bulletin</h1>
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
                        <form method="post" action="">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Title<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="bulletinTitle" required placeholder="Title"required>
                                </div>

                                <div class="form-group">
                                    <label>Publish Date</label>
                                    <input type="date" class="form-control" name="publishDate" required placeholder="publish date">
                                </div>

                                <div class="form-group">
                                    <label style="display: block;">Publish To </label>
                                    <label style="margin-right: 40px;"><input type="checkbox" value="4" name="publishTo[]"> Teacher</label>
                                    <label><input type="checkbox" value="2" name="publishTo[]"> Parent</label>               
                                </div>

                                <div class="form-group">
                                    <label>Bulletin Details</label>
                                    <textarea id="compose-textarea" name="bulletinDetails" class="form-control" style="height: 300px">
                                  
                                    </textarea>
                                           
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
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