<!DOCTYPE html>
<html>
   <head>
      <title>Laravel Upload File With Amazon S3 Bucket - ScratchCode.io</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   </head>
   <body>
        <div class="container">
            <h2>Laravel Upload File With Amazon S3 Bucket</h2>
            <div>
                @if ($message = Session::get('success'))
                   <div class="alert alert-success alert-block">
                      <strong>{{ $message }}</strong>
                   </div>
                @endif
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('save-file') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Upload file</label>
                        <input type="file" name="file" class="form-control"/>
                        <small id="emailHelp" class="form-text text-muted">Please upload file in jpg, png and csv formats.</small>
                    </div>
                    <button type="submit" class="btn btn-success">Upload File</button>
                </form>
            </div>
        </div>
    </body>
</html>