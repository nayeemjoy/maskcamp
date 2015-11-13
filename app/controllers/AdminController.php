<?php

class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return View::make('admin.index');
	}
	public function doLogin()
	{

		$data = Input::all();
		$rules = [
			'username' => 'required',
			'password' => 'required'
		];
		$validator = Validator::make($data, $rules);
		if($validator->passes()){
			if($data['username'] == 'maskadmin' && $data['password'] == 'maskadmin3214'){
				Session::put('login_for_maskcamp', '2');
				return Redirect::to('/adm/h');	
			}
			else
			{
				return Redirect::back()->withInfo('Invalid Username or Password');	
			}
	
		}
		else{
			return Redirect::back()->withErrors($validator->messages());
		}
		
	}

	public function home()
	{
		$data['users'] = User::get()->count();
		$data['fusers'] = User::whereSex('female')->get()->count();
		$data['posts'] = Post::get()->count();
		$data['cposts'] = Post::whereType('0')->get()->count();
		$data['cpoll'] = Question::orderBy('id', 'desc')->first();
		
		$data['vfcpoll'] = UsersAnswer::whereQuestionId($data['cpoll']->id)->get()->count();
		
		$posts = PostReport::select(DB::raw('post_id, count(*) as rcount'))->groupBy(['post_id'])->orderBy('rcount', 'desc')->get();
		
		$data['rposts'] = '';
		$i = 0;
		foreach($posts as $key){
			$post = Post::find($key->post_id);
			$data['rposts'][$i++] = [
				'id' => $post->id,
				'text' => $post->post, 
				'uid' => $post->user_id,
				'disable' => User::find($post->user_id)->disable, 
				'type' => $post->type,
				'total' => $key->rcount,
				'r1' => PostReport::wherePostId($post->id)->whereReportId(1)->get()->count(),
				'r2' => PostReport::wherePostId($post->id)->whereReportId(2)->get()->count(),
				'r3' => PostReport::wherePostId($post->id)->whereReportId(3)->get()->count()
			];
		}
		
		return View::make('admin.home', $data);
	}
	public function makeQuestion()
	{
		$data = Input::all();
		$rules = [
			'question' => 'required',
			'opt1' => 'required',
			'opt2' => 'required',
			'opt3' => 'required'
		];
		$validator = Validator::make($data, $rules);
		if($validator->passes()){
			$question = new Question;
			$question->question = $data['question'];
			if($question->save()){
				try {
					for ($i=1; $i < 4 ; $i++){
						$option = new QuestionOption;
						$option->question_id = $question->id;
						$option->option_details = $data["opt$i"];
						$option->option_number = $i;
						$option->save();
					}
				} catch (Exception $e) {
					Redirect::back()->withInfo('Something Interuppted');
				}
				
			}
			else
			{
				Redirect::back()->withInfo('Something Interuppted');	
			}


			return Redirect::to('adm/h');
		}
		else{
			return Redirect::back()->withErrors($validator->messages());
		}
	}
	public function postDelete($id){
		$post = Post::find($id);
		if($post)
		{
			$post->delete();	
			return Redirect::to('/adm/h')->withInfo('Deleted Successfully');
		}
		else
		{
			return Redirect::to('/adm/h')->withInfo('Post Not Deleted');
		}
	}
	public function banUser($id){
		$user = User::find($id);
		if($user)
		{
			$user->disable = 2;
			$user->save();	
			return Redirect::to('/adm/h')->withInfo('User has been banned Successfully');
		}
		else
		{
			return Redirect::to('/adm/h')->withInfo('Not Successfull');
		}
	}
	public function disbanUser($id){
		$user = User::find($id);
		if($user)
		{
			$user->disable = 0;
			$user->save();	
			return Redirect::to('/adm/h')->withInfo('User has been Unbanned Successfully');
		}
		else
		{
			return Redirect::to('/adm/h')->withInfo('Not Successfull');
		}
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}