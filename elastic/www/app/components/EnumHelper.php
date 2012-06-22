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

/**
 * Simple class to help Yii show sql ENUM values in a drop down list.
 */
class EnumHelper extends CHtml {
  public static function enumItem($model, $attr) {
    self::resolveName($model, $attr);
    preg_match('/\((.*)\)/u',
      $model->tableSchema->columns[$attr]->dbType,
      $matches);
    $values = array();
    $items = explode(',', $matches[1]);
    foreach ($items as $value) {
      // Sanitizes '
      $value = str_replace("'", '', $value);
      $values[$value] = Yii::t('enumItem', $value);
    }
    return $values;
  }

  public static function enumDropdown($model, $attr, $htmlOps=array()) {
    return CHtml::activeDropdownList($model, $attr,
      EnumHelper::enumItem($model, $attr), $htmlOps);
  }
}
