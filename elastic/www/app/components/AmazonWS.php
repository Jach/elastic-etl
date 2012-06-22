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
//define('AWS_DEFAULT_CACHE_CONFIG', 'apc');
define('AWS_CERTIFICATE_AUTHORITY', false);
define('AWS_KEY', '');
define('AWS_SECRET_KEY', '');
define('AWS_ACCOUNT_ID', '');

require_once 'AWSSDKforPHP/sdk.class.php';
spl_autoload_register(array('CFLoader', 'autoloader'), true, true);

/**
 * A few wrapper functions for Amazon's EC2
 * around this ETL use case of launching slave
 * instances to process jobs.
 *
 * @property string $ec2_response - holds the last EC2 response from the last
 *           request made, which may be of interest for logging.
 *
 */
class AmazonWS {

  public $ec2_response;

  /**
   * Creates $min slave servers of the default type specified in the DB.
   *
   * @param int $min - Number of slaves to launch, default 1
   * @return Returns an array of instance id(s) to be used as slave identifiers.
   * Will return NULL if the request failed.
   */
  public function createSlaveServers($min=1, array $params=NULL) {
    if ($params == NULL) {
      $params = $this->getDefaultParams();
    }
    if (!isset($params['DAILY_IMAGE_TO_START'], $params['SLAVE_KEY_NAME'],
      $params['SLAVE_SECURITY_GROUP'], $params['SLAVE_INSTANCE_TYPE'],
      $params['SLAVE_SHUTDOWN_BEHAVIOR']))
    {
        return NULL;
    }
    $ec2 = new AmazonEC2();
    $ec2->set_hostname(AmazonEC2::REGION_US_W2);
    $this->ec2_response = $ec2->run_instances($params['DAILY_IMAGE_TO_START'], $min, $min, array(
      'KeyName' => $params['SLAVE_KEY_NAME'],
      'SecurityGroup' => $params['SLAVE_SECURITY_GROUP'],
      'InstanceType' => $params['SLAVE_INSTANCE_TYPE'],
      'Placement' => array('AvailabilityZone' => 'us-west-2a'),
      'Monitoring.Enabled' => false,
      'DisableApiTermination' => false,
      'InstanceInitiatedShutdownBehavior' => $params['SLAVE_SHUTDOWN_BEHAVIOR'],
    ));
    if (!$this->ec2_response->isOK())
      return NULL;
    $instances = $this->ec2_response->body->instanceId()->map_string('/.*/i');
    // TODO: assign an elastic ip
    return $instances;
  }

  /**
   * Terminates the ec2 instance(s) given by $slv_id, e.g.'i-f6be2ac6'
   * 
   * @param string|array $slv_id - a single slave's instance id,
   * or an array of them, to terminate.
   * @return Returns the success of the termination call.
   */
  public function deleteSlaveServers($slv_id) {
    $ec2 = new AmazonEC2();
    $ec2->set_hostname(AmazonEC2::REGION_US_W2);
    $this->ec2_response = $ec2->terminate_instances($slv_id);
    return $this->ec2_response->isOK();
  }

  /**
   * @return Returns array of needed MasterConfig params to launch EC2
   * instances.
   */
  public function getDefaultParams() {
    return array(
      'DAILY_IMAGE_TO_START' => MasterConfig::model()->param('DAILY_IMAGE_TO_START'),
      'SLAVE_KEY_NAME' => MasterConfig::model()->param('SLAVE_KEY_NAME'),
      'SLAVE_SECURITY_GROUP' => MasterConfig::model()->param('SLAVE_SECURITY_GROUP'),
      'SLAVE_INSTANCE_TYPE' => MasterConfig::model()->param('SLAVE_INSTANCE_TYPE'),
      'SLAVE_SHUTDOWN_BEHAVIOR' => MasterConfig::model()->param('SLAVE_SHUTDOWN_BEHAVIOR'),
    );
  }

}
