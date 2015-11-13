<div class="row mc-post-area-style"> <!-- 8-7-Turash -->
   <div class="col-lg-12">

    <div class="post-area" data-posttype="0" data-tagflag="0"> <!-- Eve-26-May-Ehsan -->
      <h4>Speak Your Mind :</h4><!--05-10-15-->
      <textarea rows="4" cols="40" class="form-control post"></textarea> <!-- 5-7-Ehsan -->

      <div class="button-div">
          <div class="btn-group feeling-div">
              <button type="button" class="btn btn-primary dropdown-toggle button-class btn-modified" 
                      data-feeltext="none" data-feelid="1" 
                      data-toggle="dropdown" aria-expanded="false"><!-- 19-May-Ehsan -->
                  Feeling <span class="caret"></span>
              </button><!--11/07/15-turash-->
              <ul class="dropdown-menu option-class" role="menu"><!--10-04-15-->
                  @foreach($data['feelings'] as $feeling)
                  	<li data-feelid="{{$feeling->id}}"><a href="#">{{$feeling->name}}</a></li><!-- 19-May-2015 -->
                  @endforeach
              </ul>
          </div>

          <button type="button" class="btn btn-primary btn-modified dropdown-toggle button-class post-it" data-toggle="dropdown"aria-expanded="false">Post</button> <!-- 5-7-Ehsan --><!--11/07/15-turash-->
          <div class="checkbox name-check">                         
              <label>
                  <input type="checkbox" class="toggle-name-check" value="" aria-label="..." >
                  Hide Name
              </label>
          </div>
      
      </div>          
       
    </div>
    
   </div>
</div>