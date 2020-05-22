<?php

include('simple_html_dom.php'); //Including an HTML DOM parser allow for easier manipulation HTML
$html = file_get_html("https://www.worldometers.info/coronavirus/#countries");
//Getting the file so that the chosen data can be read and parsed.

$j=0; 
$x=0; //Assigning variables.
$covid19 = array("Country", 
                 "Total Cases", 
                 "New Cases",
                 "Total Deaths",
                 "New Deaths",
                 "Total Recovered"); /*Creating an array that will hold our data and later be formatted into
                                       JSON Strings*/
                                       
foreach($html->find("#main_table_countries_today tbody tr") as $item) /*Location and selecting the data on the webpage
with the use of their unique identifiers (Table Name: main_table_companies_today) Also this is a for loop*/
{   

    $td = $item->find("td"); //Creating a variable that will be assigned the value or text that is found inside <td /td>

        if($j<8)
        {
            $j++;           //A loop to skip through the data that was hidden in the table but shown during development.
            continue;       
        }

    $covid19[$x] = array("Country" => $td[1] -> text()."<br>", 
                     "Total Cases" => $td[2] -> text()."<br>", 
                     "New Cases"=> $td[3] -> text()."<br>",  
                     "Total Deaths"=> $td[4] -> text()."<br>", 
                     "New Deaths"=> $td[5] -> text()."<br>", 
                     "Total Recovered"=> $td[6] -> text()."<br>");  /*Assigning data to the variables within the array in 
                     a way that will allow for the data to be later formatted into JSON script. */

    echo json_encode($covid19[$x]); //Returns the JSON representation of the array

    echo "<br>";    //Creates a blank space to allow each row of information to be together.

    $x++;    /*incrememnting this value will allow for more data to be stored without overriding the previous 
               data that was assigned into the array/variables.*/

   
}




?>
