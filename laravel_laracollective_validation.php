Laravel Collective (Forms & HTML pakage)

https://laravelcollective.com/docs/5.4/html


*. CMD :

   composer require "laravelcollective/html":"^5.4.0"
 



*. config/app.php :

  'providers' => [
    
    Collective\Html\HtmlServiceProvider::class,
    
  ],




*. config/app.php

  'aliases' => [

      'Form' => Collective\Html\FormFacade::class,
      'Html' => Collective\Html\HtmlFacade::class,

  ],


*. Form :


{!! Form::open(['url' => 'foo/bar','class'=>'abc','method'=>'get','files' => true]) !!}
         
<?php echo Form::email("field_name", $value = "value_here", $attributes = ['class'=>'d','id'=>'ss']); ?>		 

<?php echo Form::file("field_name", $attributes = ['class'=>'abc','method'=>'get']);?>

<?php echo Form::radio('field_name', 'value', true, $attributes = ['class'=>'abc','method'=>'get']); ?>

<?php echo Form::select('field_name', ['L' => 'Large', 'S' => 'Small'], 'selected_value'); ?>

<?php echo Form::selectMonth('month'); ?>

<?php echo Form::token(); ?>

<?php echo Form::submit('Click Me!'); ?>
     
{!! Form::close() !!}




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