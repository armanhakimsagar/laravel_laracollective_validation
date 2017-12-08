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

use App\ViewModel;

use Illuminate\Http\Request;

use Validator;




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

   return redirect('/')->withErrors($validator)->withInput();

}


  In view page ->
  
  // show all error
  
  foreach ($errors->all() as $message) {
  
        echo $message;
	
  }
    
  // show indivisual error
  
  echo $errors->first('email');
    




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
