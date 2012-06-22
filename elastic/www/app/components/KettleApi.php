<?php
/*
   Copyright 2012 DynamoBI

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
 */

class KettleApi {
  /**
   * Returns the kettle status of a slave as an xml object, or 
   * NULL if the server is down.
   */
  public function kettleStatus($carte_url) {
    $opts = array(CURLOPT_USERPWD => 'cluster:cluster',
      CURLOPT_TIMEOUT => 8,
    );
    $req = self::curlRequest(
      $carte_url . '/status/?xml=y',
      $opts
    );
    if ($req == NULL)
      return NULL;
    return simplexml_load_string($req);
  }

  /**
   * Helper function to make curl requests simple.
   */
  public function curlRequest($url, $curl_opts) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    foreach ($curl_opts as $opt=>$val) {
      curl_setopt($ch, $opt, $val);
    }
    return curl_exec($ch);
  }

}

