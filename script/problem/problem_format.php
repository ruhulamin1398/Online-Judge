<?php
class ProblemFormat {
   
//starting connection
 public function __construct(){
     
     
 }
 
//end dabtabase connection
 public function buildProblemFormat($info){
 	$description=$info['problemDescription'];
 	$input_description=$info['inputDescription'];
 	$output_description=$info['outputDescription'];
 	$input_example=$info['inputExample'];
 	$output_example=$info['outputExample'];
 	$notes=$info['notes'];
 	$constraint_description=$info['constraintDescription'];
 	$this->addMathScript();
 	echo $description;
 	echo  $this->addOptionBreak("Input");
 	echo $input_description;
 	echo  $this->addOptionBreak("Constraints");
 	echo $constraint_description;
 	echo  $this->addOptionBreak("Output");
 	echo $output_description;
 	echo  $this->addOptionBreak("Example");
 	echo $this->addExample($input_example,$output_example);
 	echo  $this->addOptionBreak("Notes");
 	echo $notes;
 	

 }

 public function addOptionBreak($name){
 	return "<div class='problem_bold_text'>$name</div>";
 }

 public function addExample($input,$output){
 	return "<div class='example_box'>
			<div class='input_box'>Input</div>
			<div class='input_detail'>$input</div>
			<div class='output_box'>Output</div>
			<div class='input_detail'>$output</div>
			</div>";
 }

 public function addMathScript(){
 	echo "<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML'></script>";
 }

}
?>