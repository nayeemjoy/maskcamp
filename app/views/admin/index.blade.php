@extends('layouts.default')

@section('body')
  
  <div class="container">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
          <!-- Admin Login Panel -->

          
          <img src="{{asset('img/logo_2.png')}}" class="img-responsive img-circle" alt="Responsive image">
          <form action="{{URL::to('adm/l')}}" method="POST">
            <div class="form-group">
              <label for="exampleInputUsername">Username</label>
              <input type="username" name="username" class="form-control" id="exampleInputUsername" placeholder="Enter Username">
            </div>
            <div class="form-group">
              <label for="InputPassword">Password</label>
              <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Password">
            </div>
            @if($errors = Session::get('errors'))
             <div class="alert alert-danger alert-dismissable fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                @foreach($errors->all() as $error)
                    {{ $error }}<br/>
                @endforeach
              </div>
            @elseif($info = Session::get('info'))
              <div class="alert alert-danger alert-dismissable fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{$info}}
              </div>
            @endif
            <button type="submit" class="btn btn-default">Submit</button>
            
          </form>

          <!-- Admin Login Panel -->
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
@stop

@section('script')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/cm-xs-sidebars.js"></script>
    <script type="text/javascript">
               
   </script>
@stop