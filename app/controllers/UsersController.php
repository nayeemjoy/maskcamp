<?php
	
	use Facebook\FacebookSession;
	use Facebook\FacebookRequest;
	use Facebook\GraphUser;
	use Facebook\FacebookRequestException;
	use Facebook\FacebookRedirectLoginHelper;
	use Emojione\Emojione;
	session_start();
	class UsersController extends \BaseController {

		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 */
		
		public function index(){
			//return 'We Are Working';
			if(Auth::check()){
					return Redirect::to('/home');
			}
			return View::make('index');
		}
		public function getBaseDateTime()
		{
			$date = Carbon::now();
			return $date;
		}
		public function login()
		{
			
			$session = null;
			FacebookSession::setDefaultApplication('374453862708387', 'd8ab419c4d092be99eb9911949c02208');
			$helper = new FacebookRedirectLoginHelper('https://www.maskcamp.com/login');
			$params = array(
				  'scope' => 'read_stream,user_friends'
				  //'redirect_uri' => ''
			);
			try {
  				$session = $helper->getSessionFromRedirect();
  				if($session){
					//return 'ok';
					$user_profile = (new FacebookRequest(
     							 $session, 'GET', '/me'
    						))->execute()->getGraphObject(GraphUser::className());
    					//$info = $session->getSessionInfo();
    					$response = (new FacebookRequest(
     							 $session, 'GET', '/me/friends?limit=5000'
    						))->execute();
    					$user_friends = $response->getGraphObject()->getPropertyAsArray('data');
    					
    					$user =  User::whereUserId($user_profile->getProperty('id'))->first();
    				  	
    				  	//var_dump($user_profile);
    					//return 'ok';

    					if($user){
    						
    							foreach ($user_friends as $key) {
    									$friend = User::whereUserId($key->getProperty('id'))->first();
    									//echo $user->id.' '.$key->getProperty('id').'<br>';
									try {
										if($friend){
											$already_friend = FriendList::whereUserId($user->id)->whereFriendId($friend->id)->first();
											if($already_friend == null){    									
							 				$friend_list = new FriendList;
							 				$friend_list->user_id = $user->id;
							 				$friend_list->friend_id = $friend->id;
							 				$friend_list->save();
							 				}
								 		}
									} catch (Exception $e) {
										
									}
							
								}
								Auth::login($user);
								
								return Redirect::to('/home');
    					}
    					else{
    						$user = new User;
    						$user->user_id = $user_profile->getProperty('id');
    						$user->sex = $user_profile->getProperty('gender');
    						if($user->sex == 'male')
    						{
    							$user->picture = 2;	
    						}
    						elseif($user->sex == 'female') {
   							$user->picture = 4;
       						}
       						
    						if($user->save()){
    							foreach ($user_friends as $key) {
								 	$friend = User::whereUserId($key->getProperty('id'))->first();
								 	try {
										if($friend){
											$already_friend = FriendList::whereUserId($user->id)->whereFriendId($friend->id)->first();
											if($already_friend == null){    									
							 				$friend_list = new FriendList;
							 				$friend_list->user_id = $user->id;
							 				$friend_list->friend_id = $friend->id;
							 				$friend_list->save();
							 				}
								 		}
									} catch (Exception $e) {
										
									}
							
								}
								Auth::login($user);
								return Redirect::to('/home?n=1');
    						}
    						else{
    							return Redirect::to('/');
    						}
    					}
    					
    					
			}	
			} catch(FacebookRequestException $ex ) {
 			  return Redirect::to('/');
			} catch( Exception $ex ) {
  			 	 $loginUrl = $helper->getLoginUrl($params);
				return Redirect::to($loginUrl);
			}
			$loginUrl = $helper->getLoginUrl($params);
			return Redirect::to($loginUrl);
		}
		
		//Test Login
		public function test_login(){
			$user = User::find(Input::get('username'));
				if($user){

					Auth::login($user);
					//return json_encode(Auth::check());
					return Redirect::to('/home');
				}
				return Redirect::to('/');

		}
		//Test Login
		public function terms(){
			return View::make('terms');
		}
		public function home()
		{
			//return 'We Are Working';
			$data['date'] = $this->getBaseDateTime();
			//Changed
		
			

			/*19-May-2015 Ehsan*/
			$user = User::find(Auth::user()->id);
			$url = Picture::find($user->picture);
			$data['self'] = $url;
			/*START23-6-Ehsan*/
			// Available Pictures 
			$data['pictures'] = Picture::whereSex($user->sex)->orWhere('sex','none')->get();
			//

			$confession = Confession::whereUserId($user->id)->first();
			$data['enable'] = 1;
			$data['confess'] = "";
			if($confession){
				$now = Carbon::parse($confession->created_at);
				$now = $now->diffInHours(); //7-11-Ehsan
				//$now = $now->diffInSeconds(); //23-6-Ehsan
				//return $now;
				if($now < 24){
					$data['enable'] = 0;
					$data['confess'] = $confession->confess;	
				}
			}
			/*END23-6-Ehsan*/ 

			/*!!!!19-May-2015 Ehsan*/
			// EveryDay Question Calculations 
			$data['question'] = null;
			$data['prev_question'] = null;
			$question = Question::orderBy('id', 'desc')->first();
			$prev_question = Question::orderBy('id', 'desc')->skip(1)->first();
			if($question){
				$data['question'] = $question;
				$data['options_of_question'] = QuestionOption::whereQuestionId($question->id)->get();
				//$get_count_of_the_answers = DB::table('users_answers')->select(DB::raw('option_number,count(*) as count'))->join('question_options','users_answers.option_id', '=', 'question_options.id')->whereQuestionId($question->id)->groupBy('option_id')->groupBy('option_number')->orderBy('option_number')->get();
				$data['answered'] = UsersAnswer::whereUserId(Auth::user()->id)->whereQuestionId($question->id)->first();
			}
			if($prev_question) {
				$data['prev_question'] = $prev_question;
				$options_of_question = QuestionOption::whereQuestionId($prev_question->id)->get();
				$total_answer = 0;
				foreach($options_of_question as $key) {
					$current_answer = DB::table('users_answers')->select(DB::raw('count(*) as count'))->whereOptionId($key->id)->first()->count;
					$total_answer += $current_answer;
					$answers_count[$key->option_number] = array(
						'option_details' => $key->option_details,
						'total_answer' => $current_answer

					);
				}
				try {
					foreach ($options_of_question as $key) {
						$cur = $answers_count[$key->option_number]['total_answer'] * 1.00;
						$percentage = ($cur/$total_answer) * 100.0;
						$answers_count[$key->option_number]['total_answer'] = number_format((float)$percentage, 2, '.', '');
					}	
				} catch (Exception $e) {
					$answers_count[1]['total_answer'] = 33;
					$answers_count[2]['total_answer'] = 33;
					$answers_count[3]['total_answer'] = 33;
				}
				$data['total_votes'] = $total_answer;
				$data['answers'] = $answers_count;
			}
			// EveryDay Question Calculations ENd

			// Top And Flop Of the day Calculation
			$top_post = DB::table('likes')->select(DB::raw('count(*) as like_count, post_id'))->whereIn('post_id',function($query){
	                		$yesterday = Carbon::now()->subDay()->format('Y-m-d');
	                		$query->select('posts.id')->from('posts')->join('users', 'users.id', '=', 'posts.user_id')->where('users.disable', '0')->whereType('0')->where('posts.created_at','like',"$yesterday%")->whereIn('posts.user_id', function($query){
							$query->select('friend_id')->from('friend_list')->whereUserId(Auth::user()->id);
							})->orWhere('posts.user_id',Auth::user()->id)->whereType('0')->where('users.disable', '0')->where('posts.created_at','like',"$yesterday%");
	                  }

				)->orderBy('like_count','desc')->groupBy('post_id')->first();

			//return json_encode($top_post);
			$flop_post = DB::table('dislikes')->select(DB::raw('count(*) as dislike_count, post_id'))->whereIn('post_id',function($query){
					$yesterday = Carbon::now()->subDay()->format('Y-m-d');
	                		$query->select('posts.id')->from('posts')->join('users', 'users.id', '=', 'posts.user_id')->where('users.disable', '0')->whereType('0')->where('posts.created_at','like',"$yesterday%")->whereIn('posts.user_id', function($query){
							$query->select('friend_id')->from('friend_list')->whereUserId(Auth::user()->id);
							})->orWhere('posts.user_id',Auth::user()->id)->whereType('0')->where('users.disable', '0')->where('posts.created_at','like',"$yesterday%");
	                  }

				)->orderBy('dislike_count','desc')->groupBy('post_id')->first();
			//return json_encode($flop_post);
			$data['top_post'] = null;
			if($top_post != null){
				$top_post = Post::whereId($top_post->post_id)->first();
				$post = $top_post;
				/*19-May-2015 Ehsan*/
				$user = User::find($post->user_id);
				$url = Picture::find($user->picture);
				$url = $url->url;
				/*!!!!19-May-2015 Ehsan*/
				
				$text = htmlentities($post->post);
				/*Eve-26-May-Ehsan*/
				
				/*!!!!Eve-26-May-Ehsan*/
				$text = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@','<a target="_blank" href="$1">$1</a>', $text);
	          		$text = nl2br($text);
	          		$text = Emojione::shortnameToImage($text);
				$now = Carbon::parse($post->created_at);
				$data['top_post'] = array(
						'id' => $post->id,
						'post' => $text,
						'user_id' => $post->user_id,
						'img' => asset($url),///*19-May-2015 Ehsan*/
						'like' => Like::wherePostId($post->id)->get()->count(),
						'dislike' => Dislike::wherePostId($post->id)->get()->count(), 
						'liked' => Like::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'disliked' => Dislike::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'comment' => Comment::wherePostId($post->id)->get()->count(),
						'ago' => $now->diffForHumans()
					);	
			}
			$data['flop_post'] = null;
			if($flop_post != null){
				$flop_post = Post::whereId($flop_post->post_id)->first();	
				$post = $flop_post;
				/*19-May-2015 Ehsan*/
				$user = User::find($post->user_id);
				$url = Picture::find($user->picture);
				$url = $url->url;
				/*!!!!19-May-2015 Ehsan*/
				$text = htmlentities($post->post);
				/*Eve-26-May-Ehsan*/
				
				/*!!!!Eve-26-May-Ehsan*/
				$text = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@','<a target="_blank" href="$1">$1</a>', $text);
	          		$text = nl2br($text);
	          		$text = Emojione::shortnameToImage($text);
				$now = Carbon::parse($post->created_at);
				$data['flop_post'] = array(
						'id' => $post->id,
						'post' => $text,
						'user_id' => $post->user_id,
						'img' => asset($url),///*19-May-2015 Ehsan*/
						'like' => Like::wherePostId($post->id)->get()->count(),
						'dislike' => Dislike::wherePostId($post->id)->get()->count(), 
						'liked' => Like::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'disliked' => Dislike::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'comment' => Comment::wherePostId($post->id)->get()->count(),
						'ago' => $now->diffForHumans()
					);
			}
			// Top And Flop Of the day Calculation end

			// Get All Available Reports and Feelings
				$data['feelings'] = Feeling::get();
				$data['reports'] = Report::get();
			// 
			$data['notifications'] = $this->getNotification();

			//START23-6-Ehsan
			$data['page'] = "home";
			$campus = UserCampus::whereUserId(Auth::user()->id)->first();
			if($campus == null || $campus->campus_id == '1'){
				$data['isValid'] = "0";
				$data['campuses'] = Campus::all();		
			} else {
				$data['isValid'] = "1";	
				$data['campus'] = Campus::find($campus->campus_id)->name; 
			}
			//return json_encode($data);
			return View::make('home')->with('data', $data);
		}
		public function common(){
			//return 'We Are Working';
			//Changed
			
			$data['date'] = $this->getBaseDateTime();
			
			/*19-May-2015 Ehsan*/
			$user = User::find(Auth::user()->id);
			$url = Picture::find($user->picture);
			$data['self'] = $url;
			/*!!!!19-May-2015 Ehsan*/
			// Everyday Question Generation
			$data['question'] = null;
			$data['prev_question'] = null;
			$question = Question::orderBy('id', 'desc')->first();
			$prev_question = Question::orderBy('id', 'desc')->skip(1)->first();
			if($question){
				$data['question'] = $question;
				$data['options_of_question'] = QuestionOption::whereQuestionId($question->id)->get();
				//$get_count_of_the_answers = DB::table('users_answers')->select(DB::raw('option_number,count(*) as count'))->join('question_options','users_answers.option_id', '=', 'question_options.id')->whereQuestionId($question->id)->groupBy('option_id')->groupBy('option_number')->orderBy('option_number')->get();
				$data['answered'] = UsersAnswer::whereUserId(Auth::user()->id)->whereQuestionId($question->id)->first();
			}
			if($prev_question) {
				$data['prev_question'] = $prev_question;
				$options_of_question = QuestionOption::whereQuestionId($prev_question->id)->get();
				$total_answer = 0;
				foreach($options_of_question as $key) {
					$current_answer = DB::table('users_answers')->select(DB::raw('count(*) as count'))->whereOptionId($key->id)->first()->count;
					$total_answer += $current_answer;
					$answers_count[$key->option_number] = array(
						'option_details' => $key->option_details,
						'total_answer' => $current_answer

					);
				}
				try {
					foreach ($options_of_question as $key) {
						$cur = $answers_count[$key->option_number]['total_answer'] * 1.00;
						$percentage = ($cur/$total_answer) * 100.0;
						$answers_count[$key->option_number]['total_answer'] = number_format((float)$percentage, 2, '.', '');
					}	
				} catch (Exception $e) {
					$answers_count[1]['total_answer'] = 33;
					$answers_count[2]['total_answer'] = 33;
					$answers_count[3]['total_answer'] = 33;
				}
				$data['total_votes'] = $total_answer;
				$data['answers'] = $answers_count;
			}
			// ENd of Question Related Code
			// Top And Flop Post Generation
			$top_post = DB::table('likes')->select(DB::raw('count(*) as like_count, post_id'))->whereIn('post_id', function($query){
			$yesterday = Carbon::now()->subDay()->format('Y-m-d');
			 $query->select('posts.id')->from('posts')->join('users', 'users.id', '=', 'posts.user_id')->where('users.disable', '0')->whereType('1')->where('posts.created_at','like',"$yesterday%");
			 })->groupBy('post_id')->orderBy('like_count','desc')->first();


			$flop_post = DB::table('dislikes')->select(DB::raw('count(*) as like_count, post_id'))->whereIn('post_id', function($query){
			 $yesterday = Carbon::now()->subDay()->format('Y-m-d');
			 $query->select('posts.id')->from('posts')->join('users', 'users.id', '=', 'posts.user_id')->where('users.disable', '0')->whereType('1')->where('posts.created_at','like',"$yesterday%");
			 })->groupBy('post_id')->orderBy('like_count','desc')->first();
			$data['flop_post'] = null;
			$data['top_post'] = null;
			if($top_post){
				$post = Post::whereId($top_post->post_id)->first();
				/*19-May-2015 Ehsan*/
				$user = User::find($post->user_id);
				$url = Picture::find($user->picture);
				$url = $url->url;
				/*!!!!19-May-2015 Ehsan*/
				$text = htmlentities($post->post);
				/*Eve-26-May-Ehsan*/
				
				/*!!!!Eve-26-May-Ehsan*/
				$text = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@','<a target="_blank" href="$1">$1</a>', $text);
	          		
				$text = preg_replace('/#([a-zA-Z0-9\x{0980}-\x{09FF}_])+/u','<a href="#" class="tags">$0</a>',$text);
				
				$text = nl2br($text);
				$text = Emojione::shortnameToImage($text);
				$now = Carbon::parse($post->created_at);
				$data['top_post'] = array(
						'id' => $post->id,
						'post' => $text,
						'user_id' => $post->user_id,
						'img' => asset($url),///*19-May-2015 Ehsan*/
						'like' => Like::wherePostId($post->id)->get()->count(),
						'dislike' => Dislike::wherePostId($post->id)->get()->count(), 
						'liked' => Like::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'disliked' => Dislike::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'comment' => Comment::wherePostId($post->id)->get()->count(),
						'ago' => $now->diffForHumans()
					);
			}
			else
			{
				$data['top_post'] = null;
			}
			if($flop_post){
				$post = Post::whereId($flop_post->post_id)->first();
				/*19-May-2015 Ehsan*/
				$user = User::find($post->user_id);
				$url = Picture::find($user->picture);
				$url = $url->url;
				/*!!!!19-May-2015 Ehsan*/
				$text = htmlentities($post->post);
				/*Eve-26-May-Ehsan*/
				
				/*!!!!Eve-26-May-Ehsan*/
				$text = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@','<a target="_blank" href="$1">$1</a>', $text);
	          	
					$text = preg_replace('/#([a-zA-Z0-9\x{0980}-\x{09FF}_])+/u','<a href="#" class="tags">$0</a>',$text);
				
				$text = nl2br($text);
				$text = Emojione::shortnameToImage($text);
	          		$now = Carbon::parse($post->created_at);
				$data['flop_post'] = array(
						'id' => $post->id,
						'post' => $text,
						'user_id' => $post->user_id,
						'img' => asset($url),///*19-May-2015 Ehsan*/
						'like' => Like::wherePostId($post->id)->get()->count(),
						'dislike' => Dislike::wherePostId($post->id)->get()->count(), 
						'liked' => Like::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'disliked' => Dislike::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'comment' => Comment::wherePostId($post->id)->get()->count(),
						'ago' => $now->diffForHumans()
					);
			}
			else
			{
				$data['flop_post'] = null;
			}
			// Top And Flop Post Generation end
			// Get All Available Reports and Feelings
			$data['feelings'] = Feeling::get();
			$data['reports'] = Report::get();
			// 
			$data['notifications'] = $this->getNotification();
			//Get Current Trends
			$now = Carbon::now();
			$before_12hours = Carbon::now()->subHours(12);
			$data['tags'] = DB::table('hash_tagged_posts')->select('tag_id','tag',(DB::raw('count(*) as  count')))
			->join('hashtags', 'hashtags.id', '=', 'hash_tagged_posts.tag_id')->whereIn('hash_tagged_posts.post_id', function($query){
				$query->select('id')->from('posts')->whereType('1');
			})->whereBetween('hash_tagged_posts.created_at', array($before_12hours,$now))->groupBy(['tag_id','tag'])->orderBy('count','desc')->take(3)->get();
			
			//Get Current Trends End
			$data['page'] = "common";		
			return View::make('common')->with('data', $data);
		}
		// Campus
		public function campus(){
			//return 'We Are Working';
			//Changed
			
			$data['date'] = $this->getBaseDateTime();
			$campus = UserCampus::whereUserId(Auth::user()->id)->first();
			if($campus){
				Session::put('campus', $campus->campus_id);
			}
			else
			{
				Session::put('campus', 1);
			}

			/*19-May-2015 Ehsan*/
			$user = User::find(Auth::user()->id);
			$url = Picture::find($user->picture);
			$data['self'] = $url;
			/*!!!!19-May-2015 Ehsan*/
			// Everyday Question Generation
			$data['question'] = null;
			$data['prev_question'] = null;
			$question = Question::orderBy('id', 'desc')->first();
			$prev_question = Question::orderBy('id', 'desc')->skip(1)->first();
			if($question){
				$data['question'] = $question;
				$data['options_of_question'] = QuestionOption::whereQuestionId($question->id)->get();
				//$get_count_of_the_answers = DB::table('users_answers')->select(DB::raw('option_number,count(*) as count'))->join('question_options','users_answers.option_id', '=', 'question_options.id')->whereQuestionId($question->id)->groupBy('option_id')->groupBy('option_number')->orderBy('option_number')->get();
				$data['answered'] = UsersAnswer::whereUserId(Auth::user()->id)->whereQuestionId($question->id)->first();
			}
			if($prev_question) {
				$data['prev_question'] = $prev_question;
				$options_of_question = QuestionOption::whereQuestionId($prev_question->id)->get();
				$total_answer = 0;
				foreach($options_of_question as $key) {
					$current_answer = DB::table('users_answers')->select(DB::raw('count(*) as count'))->whereOptionId($key->id)->first()->count;
					$total_answer += $current_answer;
					$answers_count[$key->option_number] = array(
						'option_details' => $key->option_details,
						'total_answer' => $current_answer

					);
				}
				try {
					foreach ($options_of_question as $key) {
						$cur = $answers_count[$key->option_number]['total_answer'] * 1.00;
						$percentage = ($cur/$total_answer) * 100.0;
						$answers_count[$key->option_number]['total_answer'] = number_format((float)$percentage, 2, '.', '');
					}	
				} catch (Exception $e) {
					$answers_count[1]['total_answer'] = 33;
					$answers_count[2]['total_answer'] = 33;
					$answers_count[3]['total_answer'] = 33;
				}
				$data['total_votes'] = $total_answer;
				$data['answers'] = $answers_count;
			}
			// ENd of Question Related Code
			// Top And Flop Post Generation
			//return json_encode($data);
			$top_post = DB::table('likes')->select(DB::raw('count(*) as like_count, post_id'))->whereIn('post_id', function($query){
				$yesterday = Carbon::now()->subDay()->format('Y-m-d');
				$query->select('posts.id')->from('posts')->join('users', 'users.id', '=', 'posts.user_id')->where('posts.campus_id', Session::get('campus'))
				->where('users.disable', '0')->whereType('2')->where('posts.created_at','like',"$yesterday%");
			 })->groupBy('post_id')->orderBy('like_count','desc')->first();


			$flop_post = DB::table('dislikes')->select(DB::raw('count(*) as like_count, post_id'))->whereIn('post_id', function($query){
			 $yesterday = Carbon::now()->subDay()->format('Y-m-d');
			 $query->select('posts.id')->from('posts')->join('users', 'users.id', '=', 'posts.user_id')->where('users.disable', '0')->whereType('2')->where('posts.campus_id', Session::get('campus'))
			->where('posts.created_at','like',"$yesterday%");
			 })->groupBy('post_id')->orderBy('like_count','desc')->first();
			$data['flop_post'] = null;
			$data['top_post'] = null;
			if($top_post){
				$post = Post::whereId($top_post->post_id)->first();
				/*19-May-2015 Ehsan*/
				$user = User::find($post->user_id);
				$url = Picture::find($user->picture);
				$url = $url->url;
				/*!!!!19-May-2015 Ehsan*/
				$text = htmlentities($post->post);
				/*Eve-26-May-Ehsan*/
				/*!!!!Eve-26-May-Ehsan*/
				$text = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@','<a target="_blank" href="$1">$1</a>', $text);
	          	$text = preg_replace('/#([a-zA-Z0-9\x{0980}-\x{09FF}_])+/u','<a href="#" class="tags">$0</a>',$text);
				$text = nl2br($text);
				$text = Emojione::shortnameToImage($text);
				$now = Carbon::parse($post->created_at);
				$data['top_post'] = array(
						'id' => $post->id,
						'post' => $text,
						'user_id' => $post->user_id,
						'img' => asset($url),///*19-May-2015 Ehsan*/
						'like' => Like::wherePostId($post->id)->get()->count(),
						'dislike' => Dislike::wherePostId($post->id)->get()->count(), 
						'liked' => Like::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'disliked' => Dislike::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'comment' => Comment::wherePostId($post->id)->get()->count(),
						'ago' => $now->diffForHumans()
					);
			}
			else
			{
				$data['top_post'] = null;
			}
			if($flop_post){
				$post = Post::whereId($flop_post->post_id)->first();
				/*19-May-2015 Ehsan*/
				$user = User::find($post->user_id);
				$url = Picture::find($user->picture);
				$url = $url->url;
				/*!!!!19-May-2015 Ehsan*/
				$text = htmlentities($post->post);
				/*Eve-26-May-Ehsan*/
				/*!!!!Eve-26-May-Ehsan*/
				$text = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@','<a target="_blank" href="$1">$1</a>', $text);
	          	$text = preg_replace('/#([a-zA-Z0-9\x{0980}-\x{09FF}_])+/u','<a href="#" class="tags">$0</a>',$text);
				$text = nl2br($text);
				$text = Emojione::shortnameToImage($text);
				$now = Carbon::parse($post->created_at);
				$data['flop_post'] = array(
						'id' => $post->id,
						'post' => $text,
						'user_id' => $post->user_id,
						'img' => asset($url),///*19-May-2015 Ehsan*/
						'like' => Like::wherePostId($post->id)->get()->count(),
						'dislike' => Dislike::wherePostId($post->id)->get()->count(), 
						'liked' => Like::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'disliked' => Dislike::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
						'comment' => Comment::wherePostId($post->id)->get()->count(),
						'ago' => $now->diffForHumans()
					);
			}
			else
			{
				$data['flop_post'] = null;
			}
			// Top And Flop Post Generation end
			// Get All Available Reports and Feelings
			$data['feelings'] = Feeling::get();
			$data['reports'] = Report::get();
			// 
			$data['notifications'] = $this->getNotification();
			//Get Current Trends
			$now = Carbon::now();
			$before_12hours = Carbon::now()->subHours(12);
			$data['tags'] = DB::table('hash_tagged_posts')->select('tag_id','tag',(DB::raw('count(*) as  count')))->join('hashtags', 'hashtags.id', '=', 'hash_tagged_posts.tag_id')->whereIn('hash_tagged_posts.post_id', function($query){
				$query->select('id')->from('posts')->whereType('2')->where('campus_id',Session::get('campus'));
			})->whereBetween('hash_tagged_posts.created_at', array($before_12hours,$now))->groupBy(['tag_id','tag'])->orderBy('count','desc')->take(3)->get();
			
			//Get Current Trends End
			$data['page'] = "campus";
			$campus = UserCampus::whereUserId(Auth::user()->id)->first();
			if($campus == null || $campus->campus_id == '1'){
				

				$data['page'] = "campus";
				$data['top_post'] = null;
				$data['flop_post'] = null;
				$data['posts'] = null;
				$data['isValid'] = "0";	
				$data['campuses'] = Campus::all();
				return View::make('campus')->with('data', $data);				

			}
			$data['isValid'] = "1";
			$data['campus'] = Campus::find(Session::get('campus'))->name;
			return View::make('campus')->with('data', $data);
		}

		// 
		public function profile(){
			//return 'We Are Working';
			$data['date'] = $this->getBaseDateTime();
			
			// 
			//Profile Picture And Confession Related Task of Profile 5/12/15
				$data['confess'] = '';
				$data['enable'] = 1;
				$user = User::find(Auth::user()->id);
				$data['user'] = $user;
				
				// Available Pictures
					$data['pictures'] = Picture::whereSex($user->sex)->orWhere('sex','none')->get();
				// 



				$confession = Confession::whereUserId($user->id)->first();
				if($confession){
					$now = Carbon::parse($confession->created_at);
					$now = $now->diffInHours();
					//$now = $now->diffInSeconds(); //23-6-Ehsan
					//return $now;
					if($now < 24){
						$data['enable'] = 0;
						$data['confess'] = $confession->confess;	
					}
				}
			//Prifile Picture And Confession Related Task of Profile 5/12/15
			//return json_encode($data);

			// Friends Like Dislike Percentage
			$like = Like::whereIn('post_id',function($query){
	                $query->select('id')->from('posts')->whereIn('user_id', function($query){
							$query->select('friend_id')->from('friend_list')->whereUserId(Auth::user()->id);
							});
	                  }

				)->get()->count();
			$dislike = Dislike::whereIn('post_id',function($query){
	                $query->select('id')->from('posts')->whereIn('user_id', function($query){
							$query->select('friend_id')->from('friend_list')->whereUserId(Auth::user()->id);
							});
	                  }

				)->get()->count();
			$count = FriendList::whereUserId(Auth::user()->id)->get()->count();
			if(($like+$dislike) == 0){
				$ratio_of_like_dislike_of_my_friends_posts = array(
						'like' => 50, 
						'dislike' => 50
					);	
			}
			else
			{
				$ratio_of_like_dislike_of_my_friends_posts = array(
						'like' => number_format((float)(($like*100.0)/($like+$dislike)), 2, '.', ''), 
						'dislike' => number_format((float)(($dislike*100.0)/($like+$dislike)), 2, '.', '')
					);
			}
			$ratio_of_like_dislike_of_my_friends_posts['friends'] = $count;
			//return json_encode($ratio_of_like_dislike_of_my_friends_posts); 
			// end

			// Followers Like Dislike Percentage
			$like = Like::whereIn('post_id',function($query){
	                $query->select('id')->from('posts')->whereIn('user_id', function($query){
							$query->select('follower_id')->from('followings')->whereFollowingId(Auth::user()->id);
							});
	                  }

				)->get()->count();
			$dislike = Dislike::whereIn('post_id',function($query){
	                $query->select('id')->from('posts')->whereIn('user_id', function($query){
							$query->select('follower_id')->from('followings')->whereFollowingId(Auth::user()->id);
							});
	                  }

				)->get()->count();
			$count = Following::whereFollowingId(Auth::user()->id)->get()->count();
			if(($like+$dislike) == 0){
				$ratio_of_like_dislike_of_my_followers_posts = array(
						'like' => 50, 
						'dislike' => 50
					);	
			}
			else
			{
				$ratio_of_like_dislike_of_my_followers_posts = array(
						'like' => number_format((float)(($like*100.0)/($like+$dislike)), 2, '.', ''), 
						'dislike' => number_format((float)(($dislike*100.0)/($like+$dislike)), 2, '.', '')
					);
			}
			$ratio_of_like_dislike_of_my_followers_posts['followers'] = $count;
			
			//return json_encode($ratio_of_like_dislike_of_my_followers_posts); 
			
			// end
			// Followings Like Dislike Percentage
			$like = Like::whereIn('post_id',function($query){
	                $query->select('id')->from('posts')->whereIn('user_id', function($query){
							$query->select('following_id')->from('followings')->whereFollowerId(Auth::user()->id);
							});
	                  }

				)->get()->count();
			$dislike = Dislike::whereIn('post_id',function($query){
	                $query->select('id')->from('posts')->whereIn('user_id', function($query){
							$query->select('following_id')->from('followings')->whereFollowerId(Auth::user()->id);
							});
	                  }

				)->get()->count();
			$count = Following::whereFollowerId(Auth::user()->id)->get()->count();
			if(($like+$dislike) == 0){
				$ratio_of_like_dislike_of_my_followings_posts = array(
						'like' => 50, 
						'dislike' => 50
					);	
			}
			else
			{
				$ratio_of_like_dislike_of_my_followings_posts = array(
						'like' => number_format((float)(($like*100.0)/($like+$dislike)), 2, '.', ''), 
						'dislike' => number_format((float)(($dislike*100.0)/($like+$dislike)), 2, '.', '')
					);
			}
			$ratio_of_like_dislike_of_my_followings_posts['followings'] = $count;
			
			//return json_encode($ratio_of_like_dislike_of_my_followings_posts); 
			
			// end
			// My Posts Like Dislike Percentage
			$like = Like::whereIn('post_id',function($query){
                		$query->select('id')->from('posts')->whereUserId(Auth::user()->id);
                  }

			)->get()->count();
			$dislike = Dislike::whereIn('post_id',function($query){
                		$query->select('id')->from('posts')->whereUserId(Auth::user()->id);
                  }

			)->get()->count();
			$count = Post::whereUserId(Auth::user()->id)->get()->count();
			if(($like+$dislike) == 0){
				$ratio_of_like_dislike_of_my_posts = array(
						'like' => 50, 
						'dislike' => 50
					);	
			}
			else
			{
				$ratio_of_like_dislike_of_my_posts = array(
						'like' => number_format((float)(($like*100.0)/($like+$dislike)), 2, '.', ''), 
						'dislike' => number_format((float)(($dislike*100.0)/($like+$dislike)), 2, '.', '')
					);
			}
			$ratio_of_like_dislike_of_my_posts['posts'] = $count;
			
			// Get All Available Reports and Feelings
			$data['feelings'] = Feeling::get();
			$data['reports'] = Report::get();
			$data['notifications'] = $this->getNotification();
			$data['page'] = "profile"; //16-11-Ehsan
			//return json_encode($data['notifications']);
			// return null;
			return View::make('profile')->with('data', $data)->with('friends',$ratio_of_like_dislike_of_my_friends_posts)
			->with('followers',$ratio_of_like_dislike_of_my_followers_posts)->with('followings', $ratio_of_like_dislike_of_my_followings_posts)
			->with('my_posts', $ratio_of_like_dislike_of_my_posts);
		}


		public function getProfile($id){
			//return 'We Are Working';
			$data['date'] = $this->getBaseDateTime();
			
			// 
			//Profile Picture And Confession Related Task of Profile 5/12/15
				$data['confess'] = '';
				$data['enable'] = 1;
				$user = User::find($id);
				if(!$user){
					return Redirect::to('/');
				}
				$data['user'] = $user;
				Session::put('id', $id);
				// Available Pictures
					$data['pictures'] = Picture::whereSex($user->sex)->orWhere('sex','none')->get();
				// 
				$url = Picture::find($user->picture); /*21-11-Ehsan*/
				$data['self'] = $url; /*21-11-Ehsan*/


				$confession = Confession::whereUserId($user->id)->first();
				if($confession){
					$now = Carbon::parse($confession->created_at);
					$now = $now->diffInHours();
					//$now = $now->diffInSeconds(); //23-6-Ehsan
					//return $now;
					if($now < 24){
						$data['enable'] = 0;
						$data['confess'] = $confession->confess;	
					}
				}
			//Prifile Picture And Confession Related Task of Profile 5/12/15
			//return json_encode($data);

			// Friends Like Dislike Percentage
			$like = Like::whereIn('post_id',function($query){
	                $query->select('id')->from('posts')->whereIn('user_id', function($query){
							$query->select('friend_id')->from('friend_list')->whereUserId(Session::get('id'));
							});
	                  }

				)->get()->count();
			$dislike = Dislike::whereIn('post_id',function($query){
	                $query->select('id')->from('posts')->whereIn('user_id', function($query){
							$query->select('friend_id')->from('friend_list')->whereUserId(Session::get('id'));
							});
	                  }

				)->get()->count();
			$count = FriendList::whereUserId(Session::get('id'))->get()->count();
			if(($like+$dislike) == 0){
				$ratio_of_like_dislike_of_my_friends_posts = array(
						'like' => 50, 
						'dislike' => 50
					);	
			}
			else
			{
				$ratio_of_like_dislike_of_my_friends_posts = array(
						'like' => number_format((float)(($like*100.0)/($like+$dislike)), 2, '.', ''), 
						'dislike' => number_format((float)(($dislike*100.0)/($like+$dislike)), 2, '.', '')
					);
			}
			$ratio_of_like_dislike_of_my_friends_posts['friends'] = $count;
			//return json_encode($ratio_of_like_dislike_of_my_friends_posts); 
			// end

			// Followers Like Dislike Percentage
			$like = Like::whereIn('post_id',function($query){
	                $query->select('id')->from('posts')->whereIn('user_id', function($query){
							$query->select('follower_id')->from('followings')->whereFollowingId(Session::get('id'));
							});
	                  }

				)->get()->count();
			$dislike = Dislike::whereIn('post_id',function($query){
	                $query->select('id')->from('posts')->whereIn('user_id', function($query){
							$query->select('follower_id')->from('followings')->whereFollowingId(Session::get('id'));
							});
	                  }

				)->get()->count();
			$count = Following::whereFollowingId(Session::get('id'))->get()->count();
			if(($like+$dislike) == 0){
				$ratio_of_like_dislike_of_my_followers_posts = array(
						'like' => 50, 
						'dislike' => 50
					);	
			}
			else
			{
				$ratio_of_like_dislike_of_my_followers_posts = array(
						'like' => number_format((float)(($like*100.0)/($like+$dislike)), 2, '.', ''), 
						'dislike' => number_format((float)(($dislike*100.0)/($like+$dislike)), 2, '.', '')
					);
			}
			$ratio_of_like_dislike_of_my_followers_posts['followers'] = $count;
			
			//return json_encode($ratio_of_like_dislike_of_my_followers_posts); 
			
			// end
			// Followings Like Dislike Percentage
			$like = Like::whereIn('post_id',function($query){
	                $query->select('id')->from('posts')->whereIn('user_id', function($query){
							$query->select('following_id')->from('followings')->whereFollowerId(Session::get('id'));
							});
	                  }

				)->get()->count();
			$dislike = Dislike::whereIn('post_id',function($query){
	                $query->select('id')->from('posts')->whereIn('user_id', function($query){
							$query->select('following_id')->from('followings')->whereFollowerId(Session::get('id'));
							});
	                  }

				)->get()->count();
			$count = Following::whereFollowerId(Session::get('id'))->get()->count();
			if(($like+$dislike) == 0){
				$ratio_of_like_dislike_of_my_followings_posts = array(
						'like' => 50, 
						'dislike' => 50
					);	
			}
			else
			{
				$ratio_of_like_dislike_of_my_followings_posts = array(
						'like' => number_format((float)(($like*100.0)/($like+$dislike)), 2, '.', ''), 
						'dislike' => number_format((float)(($dislike*100.0)/($like+$dislike)), 2, '.', '')
					);
			}
			$ratio_of_like_dislike_of_my_followings_posts['followings'] = $count;
			
			//return json_encode($ratio_of_like_dislike_of_my_followings_posts); 
			
			// end
			// My Posts Like Dislike Percentage
			$like = Like::whereIn('post_id',function($query){
                		$query->select('id')->from('posts')->whereUserId(Session::get('id'));
                  }

			)->get()->count();
			$dislike = Dislike::whereIn('post_id',function($query){
                		$query->select('id')->from('posts')->whereUserId(Session::get('id'));
                  }

			)->get()->count();
			$count = Post::whereUserId(Session::get('id'))->get()->count();
			if(($like+$dislike) == 0){
				$ratio_of_like_dislike_of_my_posts = array(
						'like' => 50, 
						'dislike' => 50
					);	
			}
			else
			{
				$ratio_of_like_dislike_of_my_posts = array(
						'like' => number_format((float)(($like*100.0)/($like+$dislike)), 2, '.', ''), 
						'dislike' => number_format((float)(($dislike*100.0)/($like+$dislike)), 2, '.', '')
					);
			}
			$ratio_of_like_dislike_of_my_posts['posts'] = $count;
			
			// Get All Available Reports and Feelings
			// $data['feelings'] = Feeling::get();
			$data['reports'] = Report::get();
			$data['notifications'] = $this->getNotification();
			//return json_encode($data['notifications']);
			// return null;
			return View::make('publicprofile')->with('data', $data)->with('friends',$ratio_of_like_dislike_of_my_friends_posts)
			->with('followers',$ratio_of_like_dislike_of_my_followers_posts)->with('followings', $ratio_of_like_dislike_of_my_followings_posts)
			->with('my_posts', $ratio_of_like_dislike_of_my_posts);
		}

		public function give_answer(){
			
			try {
				$option = QuestionOption::find(Input::get('optid'));
				if($option == null){
					return Redirect::to('/');
				}
				$answer = UsersAnswer::whereUserId(Auth::user()->id)->whereQuestionId($option->question_id)->first();
				if($answer == null){
					$answer = new UsersAnswer;
					$answer->user_id = Auth::user()->id;
					$answer->question_id = $option->question_id;
					$answer->option_id = $option->id;
					if($answer->save()){
						return Redirect::to('/');
					}
				}
			} catch (Exception $e) {
				
			}

			return Redirect::to('/');
		}
		
		public function getNotification(){
			$notifications = Notification::whereUserId(Auth::user()->id)->where('seen','!=',2)->orderBy('updated_at', 'desc')->get();
			
			$data['notifications'] = null;
			$i = 0;
			$size = 0;
			foreach ($notifications as $notification) {
				$dec = 1;
				if($notification->type == 1){
					$like = Like::wherePostId($notification->post_id)->get()->count() - $notification->like;
					$dislike = Dislike::wherePostId($notification->post_id)->get()->count() - $notification->dislike;
					if($like > 0 && $dislike > 0){

						if($like == 1){
							$msg = $like.' new like and ';
						}
						else
						{
							$msg = $like.' new likes and ';
						}
						if($dislike == 1)
						{
							$msg .= $dislike.' new dislike';
						}
						else{
							$msg .= $dislike.' new dislikes';
						}



						$msg = 'You have <b>'.$msg.'</b> in your Post';
					}
					elseif($like > 0){
						if($like == 1)
						{
							$msg = $like.' new like';
						}
						else{
							$msg = $like.' new likes';
						}
						$msg = 'You have <b>'.$msg.'</b> in your Post';
						
					}
					elseif ($dislike > 0) {
						if($dislike == 1)
						{
							$msg = $dislike.' new dislike';
						}
						else{
							$msg = $dislike.' new dislikes';
						}
						$msg = 'You have <b>'.$msg.'</b> in your Post';
					}
					else
					{
						$dec = 0;
					}
					$post = Post::find($notification->post_id)->post;
					$post = ' "'.str_limit($post, 20,'...').'"';

					if($dec){
						$data['notifications'][$i]['id'] = $notification->id;
						$data['notifications'][$i]['msg'] = $msg.'<br/>'.$post;
						$data['notifications'][$i]['ago'] = Carbon::parse($notification->updated_at)->diffForHumans();
						
						if($notification->seen == 0){
					$size++;
				}
				$data['notifications'][$i]['seen'] = $notification->seen;
					}
					
				}
				elseif($notification->type == 2){
					$comment = Comment::wherePostId($notification->post_id)->get()->count() - $notification->comment;
					if($comment > 0){
						$post = Post::find($notification->post_id);
						if($post){
							if($comment == 1){
								$msg = $comment.' new comment';
							}
							else{
								$msg = $comment.' new comments';
							}
							if($notification->user_id == $post->user_id)
							{
								$msg = 'You have <b>'.$msg.'</b> on your post';
							}
							else
							{
								$msg = '<b>'.$msg.'</b> on this post';
							}	
						}
						
					}
					else
					{
						$dec = 0;
					}
					$post = Post::find($notification->post_id)->post;
					$post = ' "'.str_limit($post, 20,'...').'"';

					if($dec){
						$data['notifications'][$i]['id'] = $notification->id;
						$data['notifications'][$i]['msg'] = $msg.'<br/>'.$post;
						$data['notifications'][$i]['ago'] = Carbon::parse($notification->updated_at)->diffForHumans();
						if($notification->seen == 0){
					$size++;
				}
				$data['notifications'][$i]['seen'] = $notification->seen;
					}
				}
				elseif($notification->type == 3){
					$post = Post::find($notification->post_id)->post;
					$post = ' "'.str_limit($post, 20,'...').'"';
					if($notification->like == 1){
						$msg = '1 request';
					}
					else
					{
						$msg = $notification->like.' requests';
					}
					$msg = 'You have <b>'.$msg.'</b> to delete your post';
					$data['notifications'][$i]['id'] = $notification->id;
					$data['notifications'][$i]['msg'] = $msg.'<br/>'.$post;
					$data['notifications'][$i]['ago'] = Carbon::parse($notification->updated_at)->diffForHumans();
					if($notification->seen == 0){
					$size++;
				}
				$data['notifications'][$i]['seen'] = $notification->seen;
				}
				elseif($notification->type == 4){
					$post = Comment::find($notification->dislike);
					if($post)
					{
						$post = $post->comment;
						$post = ' "'.str_limit($post, 20,'...').'"';
						if($notification->like == 1){
							$msg = '1 request';
						}
						else
						{
							$msg = $notification->like.' requests';
						}
						$msg = 'You have <b>'.$msg.'</b> to delete your comment';
						$data['notifications'][$i]['id'] = $notification->id;
						$data['notifications'][$i]['msg'] = $msg.'<br/>'.$post;
						$data['notifications'][$i]['ago'] = Carbon::parse($notification->updated_at)->diffForHumans();
						if($notification->seen == 0){
							$size++;
						}
							$data['notifications'][$i]['seen'] = $notification->seen;	
					}
					else{
						$notification->delete();
					}			
				}
					
				$i++;
				
			}
			$data['length'] = $size; 
			return $data;
		}
		public function singlePost($id){
				$post = Post::find($id);
				$data['date'] = $this->getBaseDateTime();
				if($post==null){
					return null;
				}
				if(Auth::check()){
					if($post->type == '0'){
						$post = Post::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*')->where('posts.id', $id)->where('users.disable', '0')
						->whereType('0')->whereIn('posts.user_id', function($query){
						$query->select('friend_id')->from('friend_list')->whereUserId(Auth::user()->id);
						})->orWhere('posts.user_id', Auth::user()->id)->where('users.disable', '0')->whereType('0')->where('posts.id' , $id)->first();
						if($post == null){
							return null;		
						}	
					}
					// 
						$now = Carbon::parse($post->created_at);
		          		$feeling = DB::table('feelings')->find($post->feeling)->name;
		           		$following = Following::whereFollowerId(Auth::user()->id)->whereFollowingId($post->user_id)->get()->count();
		           		$confession = Confession::whereUserId($post->user_id)->first();
						if($confession){
							$confess_time = Carbon::parse($confession->created_at);
							$confess_time = $confess_time->diffInHours();
							//$confess_time = $confess_time->diffInSeconds();
							if($confess_time < 24){
								$confession = $confession->confess;	
							}
							else
							{
								$confession = null;
							}
						}
						$user = User::find($post->user_id);
						$url = Picture::find($user->picture);
						$url = $url->url;
		          			$text = htmlentities($post->post);
		          			// 9-2-Start
		          			$pos = strpos($text ,'watch?v=');
						if ($pos != 0) {
							$pos = $pos + 8;
							$str = substr($text, $pos, 11);
							# code...
						}
						else{
							$str = null;
						}
						// 9-2-End
						$data['post'] = array(
							'id' => $post->id,
							'post' => $text,
							'user_id' => $post->user_id,
							'img' => asset($url),
							'confess' => $confession,
							'following' => $following,
							'type' => $post->type,
							'like' => Like::wherePostId($post->id)->get()->count(),
							'dislike' => Dislike::wherePostId($post->id)->get()->count(), 
							'liked' => Like::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
							'disliked' => Dislike::wherePostId($post->id)->whereUserId(Auth::user()->id)->get()->count(),
							'comment' => Comment::wherePostId($post->id)->get()->count(),
							'feeling' => $feeling,
							'vidsrc' => $str, //9-2
							'ago' => $now->diffForHumans()
						);
						$data['notifications'] = $this->getNotification();
				
					// 
				}
				else{
					if($post->type == '0'){
						return null;
					}
					// 
						$now = Carbon::parse($post->created_at);
	          		$feeling = DB::table('feelings')->find($post->feeling)->name;
	           		$following = null;
	           		$confession = Confession::whereUserId($post->user_id)->first();
					if($confession){
						$confess_time = Carbon::parse($confession->created_at);
						$confess_time = $confess_time->diffInHours();
						//$confess_time = $confess_time->diffInSeconds();
						if($confess_time < 24){
							$confession = $confession->confess;	
						}
						else
						{
							$confession = null;
						}
					}
					$user = User::find($post->user_id);
					$url = Picture::find($user->picture);
					$url = $url->url;
	          			$text = htmlentities($post->post);
	          			
	          			// 9-2-Start
	          			$pos = strpos($text ,'watch?v=');
					if ($pos != 0) {
						$pos = $pos + 8;
						$str = substr($text, $pos, 11);
					# code...
					}
					else{
						$str = null;
					}
					//9-2-End
					
					$data['post'] = array(
						'id' => $post->id,
						'post' => $text,
						'user_id' => $post->user_id,
						'img' => asset($url),
						'confess' => $confession,
						'following' => $following,
						'type' => $post->type,
						'like' => Like::wherePostId($post->id)->get()->count(),
						'dislike' => Dislike::wherePostId($post->id)->get()->count(), 
						'liked' => 0,
						'disliked' => 0,
						'comment' => Comment::wherePostId($post->id)->get()->count(),
						'feeling' => $feeling,
						'vidsrc' => $str, // 9-2
						'ago' => $now->diffForHumans()
					);
					//
					$data['notifications'] = [
						'length' => 0,
						'notifications' => null
					];
				
				 
				}
				$data['single'] = 1;
				$data['reports'] = Report::get();
				return View::make('single')->withData($data);
		}
		public function viewNotification($id){

				try {
						$notification = Notification::find($id);
						if($notification){
							$notification->seen = 2;
							if($notification->type == 1)
							{
									$notification->like = Like::wherePostId($notification->post_id)->get()->count();
									$notification->dislike = Dislike::wherePostId($notification->post_id)->get()->count();
									
							}
							elseif($notification->type == 2){
									$notification->comment = Comment::wherePostId($notification->post_id)->get()->count();
									//$notification->save();
							}
							$notification->save();
							return Redirect::to('/singlepost/'.$notification->post_id);
						}
						return "Unauthorized Access Of Notification";
					} catch (Exception $e){
						
				}	
				return "Unauthorized Access Of Notification";
		}
	}