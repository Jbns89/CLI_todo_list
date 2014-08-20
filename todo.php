 <?php
 // Create an empty array to hold list of todo items
 // and save them
 $items = array();
 function list_items($list)		//you can use foreach inside 
 {								//a function to list items
 	$list_todo = '';			// reference foreach_books
 	foreach ($list as $items_list => $activity)    
		{
			$items_list++;
			$list_todo=$list_todo."[{$items_list}] {$activity} ".PHP_EOL;
		}

 	return $list_todo;
 }
 function get_input($upper = FALSE)
 {
     // You can also do terinary vs. if/else statement
     if ($upper)		          // convert to uppercase if $upper is true
     {						    //dont need to put $upper=true inside if statement
     	$input=trim(fgets(STDIN));   //because it is already checking for that
     }
     else
     {
     	$input=trim(fgets(STDIN));
     }
     return ucfirst($input);   // Return STDIN input ucfirst to capitilize 1rst letter     
 }
 function sort_menu($items)
 {
    $input_sort=get_input(TRUE);
    
    switch($input_sort) 

        {
            case "A":
                
                asort($items);
                break;
    
            case "Z":
                
                arsort($items);
                break;

            case "O": 
                
                krsort($items);
                break;
        
            case "R": 
                
                ksort($items);
                break;
        } 
        return $items; 
 }
 do {     
     echo "\n~~~~~~~~~~~~~~~~~~~~~~~~\nYour to do list for today:\n".PHP_EOL;
     echo list_items($items); 	                                                 // Echo the list produced by the function
     echo '(N)ew item, (R)emove item, (S)ort, (Q)uit : ';
     $input = get_input(TRUE);

     switch ($input) 
     {
        case 'F':
            array_shift($items);
            break;
        case 'L':
            array_pop($items);
            break;
        case 'N':
            echo 'Do you want to add an item to the (T)op or (B)ottom of your list? '.PHP_EOL;   
            $input_tb = get_input(TRUE);
            if ($input_tb == 'T') 
            {
                echo 'Please enter your item'.PHP_EOL;
                array_unshift($items,get_input());
                
            }
            elseif($input_tb == 'B')
            {
                echo 'Please enter your item'.PHP_EOL;
                array_push($items,get_input());
            } 
            break;
        case 'R':
            echo 'Enter item number to remove: '.PHP_EOL;
            $key = get_input();                                                      
            unset($items[--$key]);                                                  
            $items=array_values($items);
            break;
        case 'S':
            echo 'Do you want to sort (A)-Z , (Z)-A, (O)rder entered, (R)everse order entered'.PHP_EOL;
            $items=sort_menu($items);
            break;
     }

 } while ($input != 'Q');				
 echo "Goodbye!\n";
 exit(0); // Exit with 0 errors











