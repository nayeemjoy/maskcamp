@extends('layouts.default')

@section('body')
  
  <div class="container">
    <div class="row">
      <div class="col-md-9">
          <!-- Admin Login Panel -->
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
              <h1 class="text-center">Overview Of the Site</h1>
              <p>Total Users : <b>{{$users}}</b></p>
              <p>Total Female Users : <b>{{$fusers}}</b></p>

              <p>Total Posts: <b>{{$posts}}</b></p>
              <p>Total Common Room Posts: <b>{{$cposts}}</b></p>
              <p>Current Poll: <b>{{$cpoll->question}}</b></p>
              
              <p>Total Votes of Current Poll: <b>{{$vfcpoll}}</b></p>
              
              <!-- Start Of Question Form -->
              <div class="wrapper">
                  <h2 class="text-center">Add New Poll.</h2>
                  <form class="form-horizontal" action="{{URL::to('adm/makeq')}}" method="POST">
                    <div class="form-group">
                      <label for="inputQuestion" class="col-sm-2 control-label">Question</label>
                      <div class="col-sm-10">
                        <input type="text" name="question"  class="form-control" id="inputQuestion" placeholder="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputOption1" class="col-sm-2 control-label">Option 1</label>
                      <div class="col-sm-10">
                        <input type="text" name="opt1" class="form-control" id="inputOption1" placeholder="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputOption2" class="col-sm-2 control-label">Option 2</label>
                      <div class="col-sm-10">
                        <input type="text" name="opt2" class="form-control" id="inputOption2" placeholder="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputOption3" class="col-sm-2 control-label">Option 3</label>
                      <div class="col-sm-10">
                        <input type="text" name="opt3" class="form-control" id="inputOption3" placeholder="">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Submit</button>
                      </div>
                    </div>
                  </form>
              </div>
              <!-- End Of Question Form -->
              <!-- Start Report Table -->
              <div class="container">
                  <h2>Reports Table</h2>
                  <table class="table table-bordered">
                      <thead>
                          <th>ID</th>
                          <th>Post</th>
                          <th>Type</th>
                          <th>Total</th>
                          <th>Hate Speech</th>
                          <th>Offensive</th>
                          <th>Threat</th>
                          <th>Delete</th>
                          <th>Ban</th>
                      </thead>
                      <tbody>
                          @foreach($rposts as $post)
                          <tr>
                          	
                            <td>{{$post['id']}}</td>
                            <td>{{$post['text']}}</td>
                            <td>
                              @if($post['type'] == '0')
                              {{'Friend\'s Room'}}
                              @else
                              {{'Common Room'}}
                              @endif

                            </td>
                            <td>{{$post['total']}}</td>
                            <td>{{$post['r1']}}</td>
                            <td>{{$post['r2']}}</td>
                            <td>{{$post['r3']}}</td>
                            <td><a class="btn btn-danger" href="{{URL::to('/adm/d/'.$post['id'])}}">Delete</a></td>
                            <td>
                            	@if($post['disable'] == 2)
                            	<a class="btn btn-info" href="{{URL::to('/adm/disbu/'.$post['uid'])}}">
                            	 Banned
                            	</a>
                            	@else
                            	<a class="btn btn-warning" href="{{URL::to('/adm/bu/'.$post['uid'])}}">
                            	 Ban User
                            	</a>
                            	@endif
                            </td>
                            
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
              
      		<a class="btn btn-primary" href="{{URL::to('/adm/logout')}}">Logout</a>
              <!-- ENd -->
      </div>
      <div class="col-md-3">
      </div>
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