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

class Domain
{
  /**
  * Explodes the givven domain into domain-parts (tld, sld, subdomains)
  */
  static function explodeDomain(&$domain, &$into)
  {
    $parts=explode('.', $domain);
    $l = count($parts) -1;
    
    if( $parts < 1 )
      return false;
    
    $into['tld']=$parts[$l--];
    $into['sld']=$parts[$l--];
    while( $l >= 0 )
      $into[ 'sub'.($l+1) ]=$parts[$l--];
    return true;
  }
  
  /**
  * Check the return-value with === true, because there is the posibility that this function returns 0 (zero)
  * @return should return if the givven domain is valid
  */
  static function isValid(&$domain)
  {
    $splitted=array();
    if( !Domain::explodeDomain($domain, $splitted) )
      return false;
    
    foreach($splitted as $key => $element)
    if( !preg_match('/^([-_a-z])$/i', $element) )
      return $key; //returns the current position where we failed, so a nice error-message is possible
      return true;
  }
}

?>