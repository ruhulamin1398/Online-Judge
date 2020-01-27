<?php
class problem_format {
   
//starting connection
 public function __construct(){
     
     
 }
 
//end dabtabase connection
 public function build_problem_format($info){
 	$description=$info['problem_description'];
 	$input_description=$info['input_description'];
 	$output_description=$info['output_description'];
 	$input_example=$info['input_example'];
 	$output_example=$info['output_example'];
 	$notes=$info['notes'];
 	$constraint_description=$info['constraint_description'];
 	$this->add_math_script();
 	echo $description;
 	echo  $this->add_option_break("Input");
 	echo $input_description;
 	echo  $this->add_option_break("Constraints");
 	echo $constraint_description;
 	echo  $this->add_option_break("Output");
 	echo $output_description;
 	echo  $this->add_option_break("Example");
 	echo $this->add_example($input_example,$output_example);
 	echo  $this->add_option_break("Notes");
 	echo $notes;
 	

 }

 public function add_option_break($name){
 	return "<div class='problem_bold_text'>$name</div>";
 }

 public function add_example($input,$output){
 	return "<div class='example_box'>
			<div class='input_box'>Input</div>
			<div class='input_detail'>$input</div>
			<div class='output_box'>Output</div>
			<div class='input_detail'>$output</div>
			</div>";
 }

 public function add_math_script(){
 	echo "<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML'></script>";
 }

}
?>