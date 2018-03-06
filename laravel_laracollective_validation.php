<form action="{{ url('insert') }}" method="post" enctype="multipart/form-data">
    <input type="text" name="name"><br/><br/>

    <input type="radio" name="gender" value="m"><br/><br/>
    <input type="radio" name="gender" value="f"><br/><br/>

    <select name="size">
        <option value="0">select something</option>
        <option value="1">gents</option>
        <option value="3">dfs</option>
    </select>

    <br/><br/>

    <input type="file" name="image1"> <br/><br/>
    <input type="file" name="image2"> <br/><br/>
     {{ csrf_field() }}
    <input type="submit" name="submit">
</form>



______________________________________________


-> Validation


use App\Http\Requests;

use App\Http\Controllers\controller;

use Illuminate\Http\Request;

use Validator;




    
    public function Validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
	
		'field' => 'alpha_dash',

		'field' => 'min:6|regex:/^(?=.*[a-z])(?=.*[A-Z]).+$/',

		'field_confirmation' => 'max:255|same:fieldname',

		'field' => 'Unique:database_tablename',

		'field' => 'date|date_format:Y-m-d',

		'field' => 'mimes:jpeg,jpg,png | min:400kb | dimensions:min_width=100,min_height=200',

		'field' => 'mimetypes:video/avi,video/mpeg',
	
	]);


	if ($validator->fails()) {
		    return redirect('admin/research_form')
				->withErrors($validator)
				->withInput();
		}

	}

}









  In view page ->
  


  // show all error
  
  foreach ($errors->all() as $message) {
  
        echo $message;
	
  }
    



  // show indivisual error
  
  echo $errors->first('email');
    



  // best way :

	create file in : resource/views/backend/pertial/operation_message;

		@if ($alert_message = Session::get('success'))
		<div class="alert alert-success">
		    <strong>Success!</strong> {{ $alert_message}} 
		</div>
		@endif
		@if ($alert_message = Session::get('error'))
		<div class="alert alert-danger">
		    <strong>Info!</strong> {{ $alert_message}}
		</div>
		@endif
		@if ($alert_message = Session::get('warning'))
		<div class="alert alert-warning">
		    <strong>Warning!</strong> {{ $alert_message}}
		</div>
		@endif
		@if ($alert_message = Session::get('info'))
		<div class="alert alert-info">
		    <strong>Danger!</strong> {{ $alert_message}}
		</div>
		@endif
		<div class="alert alert-success json_alert_message" id='success_message'>
		    <strong>Success!</strong> <span id='message'></span> 
		</div>
		<div class="alert alert-info json_alert_message" id='info_message'>
		    <strong>Info!</strong> {{ $alert_message}}
		</div>
		<div class="alert alert-warning json_alert_message" id='warning_message'>
		    <strong>Warning!</strong> {{ $alert_message}}
		</div>
		<div class="alert alert-danger json_alert_message" id='danger_message'>
		    <strong>Danger!</strong> {{ $alert_message}}
		</div>





	now include in view page :

	@include('backend/pertial/operation_message');

	@if ($errors->has('title'))
        <br>
            <div class="alert-error">{{ $errors->first('title') }}</div>
        @endif









_____________________________________________________________________





-> Create Custom Validation :


   * https://laravel.com/docs/5.5/validation#custom-validation-rules

    php artisan make:rule RulesName
   
   

	* <?php

		namespace App\Rules;

		use Illuminate\Contracts\Validation\Rule;

		class RulesName implements Rule{
		
			public function passes($attribute, $value){
			
				if($value==0){
				
					return $value;
				
				}
				
			}

			public function message(){
			
				return 'The :type here error message.';
				
			}
			
		}
		
		* In Controller :
		
		use App\Rules\RulesName;

		$request->validate([
		
			'name' => [new DropDownRule],
			
		]);
		

-> create custom error message :

   resources/lang/en/validation.php
   
   set : 
   
   'custom' => [
        'name' => [
            'required' => 'nothing ok',
        ],
    ],
