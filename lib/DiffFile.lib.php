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

/** \brief This class can analyse and handle diff-files.
 *
 * To create such a file use the command `diff oldFile newFile > file.diff`.
 */
class DiffFile
{
  /**
   *
   * @var array content of diff file
   */
  private $content;
  private $linesAdded;
  private $linesRemoved;

  public function __construct(&$file, $analyseOnLoad=true)
  {
    if( !file_exists($file) )
      die('Error: '.__METHOD__.' File '.$file.' doesn\'t exist!'."\n");

    $this->content = file($file);
    if($analyseOnLoad)
      $this->analyse();
  }

  /**
   * removes all lines except they're starting with < or >
   */
  public function cleanFileData()
  {
    foreach($this->content as $key => $line)
      if( $line{0} != '<' && $line{0} != '>' )
        unset($this->content[$key]);
  }

  public function analyse()
  {
    if(empty($this->content)) //maybe we already have analysed the content...
      return;

    $this->linesAdded=array();
    $this->linesRemoved=array();
    foreach($this->content as $c => $line)
    {
      if( $line{0} == '<' )
        $this->linesRemoved[] = substr($line, 2);
      else if( $line{0} == '>' )
        $this->linesAdded[] = substr($line, 2);
      else
        die('Error: wrong diff-format! Found: '.$line{0}.' instead of < or >'."\n");
      unset($this->content[$c]);
    }
  }
  
  public function getLinesAdded() {
    return $this->linesAdded;
  }

  public function countLinesAdded()
  {
    return count($this->linesAdded);
  }

  public function getLinesRemoved() {
    return $this->linesRemoved;
  }

  public function countLinesRemoved()
  {
    return count($this->linesRemoved);
  }
}

?>