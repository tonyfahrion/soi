<?php

/*
This file is part of SOI.

SOI is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, version 3 of the License.

SOI is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with SOI. If not, see <http://www.gnu.org/licenses/>.
*/

class CLI
{
  static function getCliLine($message)
  {
    echo $message.": \033[0;32m"; // green for input
    $y = trim(fgets(STDIN));
    echo "\033[0;37m";
    return $y;
  }
  
  static function requestInputUntilMatch($message, $callback='')
  {
    $x = "";
    $first = TRUE;
    do
    {
      if($first)
        $first = FALSE;
      else
        echo "\n    Fehlerhafte Eingabe - bitte versuchen Sie es noch einmal\n";
      $x = CLI::getCliLine($message);
      
      /**
       * Check if we have to validate the givven input.
       * The callback-function return true if the input is valid. Else we will empty the input...
       **/
      if( !empty($callback) && function_exists($callback) && !$callback($x) )
        $x='';
      
    } while(empty($x));
    return $x;
  }
}
?>