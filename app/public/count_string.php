<?php

// Gather form data
$inputString = $_POST["inputString"];
$seperateCase = false;
$countOtherChars = false;
$characterToExclude = "";

if(!empty($_POST["isSeperateCase"]))
{
    $seperateCase = true;
}

if(!empty($_POST["countOtherChars"]))
{
    $countOtherChars = true;
}

if(!empty($_POST["excludeCharacter"]))
{
    $characterToExclude = $_POST["characterToExclude"];
}

//Output

if(validateExcludedCharacter($characterToExclude))
{
    $outputArray = generate_results_tables($inputString, $seperateCase, $countOtherChars, $characterToExclude);
    echo json_encode ($outputArray);
}
else
{
    echo json_encode (array("error" => '<h4 style="color: red;"> Only one character can be excluded.</h4>'));
}


// table generation functions

function generate_results_tables($inputString, $seperateCase, $countOtherChars, $characterToExclude)
{
    $outputArray = array("dataArrays" => array());
    $htmlTables = "";

    $countArray = my_count_chars($inputString, $characterToExclude);

    if($seperateCase)
    {
        $upperCase = array_filter($countArray, "isUpperAlphabet", ARRAY_FILTER_USE_KEY);
        $lowerCase = array_filter($countArray, "isLowerAlphabet", ARRAY_FILTER_USE_KEY);

        $htmlTables .= generate_count_results($upperCase);
        $outputArray["dataArrays"]["upperCase"] = $upperCase;

        $htmlTables .= generate_count_results($lowerCase);
        $outputArray["dataArrays"]["lowerCase"] = $lowerCase;

    }
    else{
        $countArray = my_count_chars(strtoupper_exclude($inputString, $characterToExclude), $characterToExclude);

        array_map("strtoupper", $countArray);

        $filteredArray = array_filter($countArray, "isAlphabet", ARRAY_FILTER_USE_KEY);

        $htmlTables .= generate_count_results($filteredArray);
        $outputArray["dataArrays"]["total"] = $filteredArray;
    }

    if($countOtherChars)
    {
        $filteredArray = array_filter($countArray, "isNumberSpaceSpecialChar", ARRAY_FILTER_USE_KEY);

        $htmlTables .= generate_count_results($filteredArray);
        $outputArray["dataArrays"]["other"] = $filteredArray;
    }

    $outputArray["htmlTables"] = $htmlTables;

    return $outputArray;
}

function generate_count_results($countArray)
{
    $htmlTable = "";

    if(count($countArray) > 0){
        $htmlTable .=
        "<table class='table table-striped'>
           <thead>
               <tr>
               <th>Character</th>
               <th>Count</th>
           </thead>
           <tbody>
           ";
   
       foreach($countArray as $i => $val)
       {
           if($i == " ")
           {
            $htmlTable .= "<tr><td> Spaces </td><td> $val </td><tr>";
           }
           else
           {
            $htmlTable .= "<tr><td> $i </td><td> $val </td><tr>";
           }
           
       }
   
       $htmlTable .=
       "</tbody>
       </table>";
    }

    return $htmlTable;
}

// Count Function
function my_count_chars($inputString, $characterToExclude)
{
    $resultArray = array();

    $length = my_strlen($inputString);

    for($i=0; $i<$length; $i++)
    {
        $currentChar = $inputString[$i];

        if($currentChar != $characterToExclude)
        {
            if(array_key_exists($currentChar, $resultArray))
            {
                $resultArray[$currentChar] += 1;
            }
            else
            {
                $resultArray[$currentChar] = 1;
            } 
        }
    }

    return $resultArray;
}

function my_strlen($string)
{
    $length = 0;

    $index = 0;
    while($string[$index] != null)
    {
        $length += 1;

        $index++;
    }

    return $length;
}

function my_array_key_exists($key, $array)
{
    $exists = false;
    
    for($i=0; $i<my_strlen($array); $i++)
    {
        if($key == $array[$i])
        {
            return true;
        }
    }

    return false;
}

function validateExcludedCharacter($char)
{
    if(my_strlen($char) > 1)
    {
        return false;
    }

    return true;
}

function strtoupper_exclude($string, $charToExclude)
{
    $length = my_strlen($string);

    for($i=0; $i<$length; $i++)
    {

        if($string[$i] != $charToExclude)
        {
            $string[$i] = strtoupper($string[$i]);
        }
    }

        return $string;
}

// filter functions

function isAlphabet($var)
{
    if(isLowerAlphabet($var) || isUpperAlphabet($var))
    {
        return true;
    }

    return false;
}

function isLowerAlphabet($var)
{
    $var = ord($var);
    if($var >= 97 && $var <= 122)
    {
        return true;
    }

    return false;
}

function isUpperAlphabet($var)
{
    $var = ord($var);
    if($var >= 65 && $var <= 90)
    {
        return true;
    }

    return false;
}

function isNumberSpaceSpecialChar($var)
{
    $var = ord($var);
    if($var >= 32 && $var <= 64)
    {
        return true;
    }

    return false;
}

?>