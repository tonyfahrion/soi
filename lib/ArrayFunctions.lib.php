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

class ArrayFunctions
{
  private function __construct() {}

  public static function toSqlValues(&$dbms, &$from, &$to, &$callbacks=array())
  {
    $help=array();
    foreach($from as $row)
    {
      // enable manipulation by callback
      foreach( $callbacks as $key => $callback )
        $callback($key, $row[$key]);

      foreach( $row as $key => $value )
      {
        $row[$key]=$dbms->escape_string($value);
      }

      $help[]='(\''.implode('\',\'', $row).'\')'."\n";
    }
    $to = implode(',', $help);
  }

  /**
   * Generates an array from a line. (fixed-length-csv)
   *
   * You have to 
   *
   * @param array $fields
   * @param array $dropper
   * @param array $lines
   * @param array $data
   * @param array $callbacks
   */
  public static function fromLines(&$fields, &$dropper, &$lines, &$data, &$callbacks=array(), $unsetLinesAfterAnalyse=false)
  {
    foreach( $lines as $l => $line )
    {
      $help = array();
      foreach($fields as $key => $length)
      {
        // drop unneeded lines
        if( in_array($key, $dropper) )
        {
          returnField($line, $length, true); //this will remove our field from line
          continue;
        } else
          $help[$key] = trim( returnField($line, $length) );

        if( isset( $callbacks[$key] ) )
          $callbacks[$key]($key, $help[$key]);
      }
      if( isset($help['ID']) )
        $data[ $help['ID'] ] = $help;
      else
        $data[] = $help;
      if( $unsetLinesAfterAnalyse )
        unset($GLOBALS['lines'][$l]);
    }
  }
}

?>