<?php 

require('./vendor/autoload.php');

/*
/ now i am getting the insurance.php data 
/ where x is the input/independant variable/number 
/ of claims of insurance company
/  and y is the output/dependent variable/total amount to be paid
*/

// loading the data
$data = new \Phpml\Dataset\CsvDataset("./data/insurance.csv",1,true);

// preprocessing data
// dividing into train and test
$dataset = new \Phpml\CrossValidation\RandomSplit($data,0.2);
 
// dataset is divided into four arrays
// $dataset->getTrainSamples();
// $dataset->getTrainLabels();
// $dataset->getTestSamples();
// $dataset->getTestLabels();


// Training
// linear regression-Relationship between x and y

$regression = new \Phpml\Regression\LeastSquares();

$regression->train($dataset->getTrainSamples(),$dataset->getTrainLabels());

// Now we have trained our data using linear regression we can predict
// on the test data
$predictions  = $regression->predict($dataset->getTestSamples());
// Evaluate the trained model
$score = \Phpml\Metric\Regression::r2score($dataset->getTestLabels(),$predictions );

echo  "R2 Score: ".$score;