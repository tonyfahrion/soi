<?php
/*
This file is part of SOI.

SOI is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 3 of the License.

SOI is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with SOI.  If not, see <http://www.gnu.org/licenses/>.
*/

# ====== General =======
# this is an example file for compiled queries
# this file would be automaticaly created by our querie-compiler
# the compiler uses a xml based description

# ====== Filename =======
# The filename is build uppon module-name + database resource-name + suffix .php
# other suffixes are allowed, but currently not planed

//this variable musst be called $queries
$queries = array(
'get' => array( // there is an get, set and update section
  'userdata' => array(
    'hash'      => 'sha1sum', //here should be the sha1sum of the statement - this would be automaticly created by the compiler
    'statement' => 'SELECT * FROM user WHERE ID = %{username}', //%{username} would be replaced by the argument with the key "username"
    'requires'  => array('username'), //the argument username is required!
    'cacheable' => true //the core is allowed to cache the result of the statement (that would be identified by statement+arguments)
    )
  ),
'set' => array(),
'update' => array()
);
?>
