 <?php
 
 // Create an empty array to hold list of todo items
 // and save them
 $items = array();
 
 function list_items($list)      
 {                              
    //you can use foreach inside
    //a function to list items
    // reference foreach_books
    $list_todo = '';            
    foreach ($list as $items_list => $activity)    
    {
        $items_list++;
        $list_todo = $list_todo ."[{$items_list}] {$activity} " . PHP_EOL;
    }

    return $list_todo;
 }
 
 function get_input($upper = FALSE)
 {
    // You can also do terinary vs. if/else statement
    // <- convert to uppercase if $upper is true
    //<- dont need to put $upper=true inside if condition
    //because it is already checking for that
     
     if ($upper)                  
     {                      
        $input = trim(fgets(STDIN));
     }
     else
     {
        $input = trim(fgets(STDIN));
     }
     // Return STDIN input ucfirst to capitilize 1rst letter 
     return ucfirst($input);
 }
 
 function sort_menu($items)
 {
    $input_sort = get_input(TRUE);
    
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

//Can use file function instead of doing
// most of this function here. 
 function open_file($file) 
 {                              
    $handle = fopen($file, 'r');
    $content = trim(fread($handle,filesize($file)));
    fclose($handle);
    return $add_list = explode("\n",$content);
 }
 
 do {     
     echo "\n~~~~~~~~~~~~~~~~~~~~~~~~\nYour to do list for today:\n" . PHP_EOL;
     echo list_items($items);
     echo '(N)ew item, (R)emove item, (S)ort, (O)pen, s(A)ve, (Q)uit : ';
     $input = get_input(TRUE);

     switch ($input) 
     {
        case 'A':
            echo 'What would you like to name this file?' . PHP_EOL;
            $file = trim(fgets(STDIN));
            $file_name = "data/$file" . ".txt";
            if (file_exists($file_name)) 
            {
                echo "\nThis file exists, do you want to overwrite it? (y/n)" . PHP_EOL;
                $input = ucfirst(trim(fgets(STDIN)));
                if ($input == 'Y') 
                {
                    $handle = fopen($file_name, 'w');
                    foreach ($items as $item) 
                    {
                        fwrite($handle, PHP_EOL . $item);
                    }
                    fclose($handle);
                    echo "\n**To Do List Saved**" . PHP_EOL;
                }
                else
                {
                    echo "\n**To Do List Unsaved**" . PHP_EOL;
                    break;
                }
            }
            else
            {
                $handle = fopen($file_name, 'w');
                foreach ($items as $item) 
                {
                    fwrite($handle, PHP_EOL . $item);
                }
                fclose($handle);
                echo "\n**To Do List Saved**" . PHP_EOL;
            }
            break;
        case 'O':
            echo 'Which file would you like to open?' . PHP_EOL;
            $filename = trim(fgets(STDIN)); //you can also do $file='data/' . trim(fgets(STDIN));
            $file = "data/$filename" . ".txt";
            if (file_exists($file))
            {
                $new_list = open_file($file);   //so user doesnt only needs to type list.txt
                $items = array_merge($items, $new_list);           
            }
            else 
            {
                echo "Sorry that file doesn't exist";
            }
            break;
        case 'F':
            $remove_top = array_shift($items);
            echo "\nYou removed $remove_top item." . PHP_EOL;
            break;
        case 'L':
            $remove_bottom = array_pop($items);
            echo "\nYou removed $remove_bottom item." . PHP_EOL;
            break;
        case 'N':
            echo 'Do you want to add an item to the (T)op or (B)ottom of your list? ' . PHP_EOL;   
            $input_tb = get_input(TRUE);
            if ($input_tb == 'T') 
            {
                echo 'Please enter your item' . PHP_EOL;
                array_unshift($items,get_input());
                
            }
            elseif($input_tb == 'B')
            {
                echo 'Please enter your item' . PHP_EOL;
                array_push($items,get_input());
            } 
            break;
        case 'R':
            echo 'Enter item number to remove: ' . PHP_EOL;
            $key = get_input();                                                      
            unset($items[--$key]);                                                  
            $items = array_values($items);
            break;
        case 'S':
            echo 'Do you want to sort (A)-Z , (Z)-A, (O)rder entered, (R)everse order entered' . PHP_EOL;
            $items = sort_menu($items);
            break;
     }

 } while ($input != 'Q');
 echo "Goodbye!\n";
 // Exit with 0 errors
 exit(0); 











