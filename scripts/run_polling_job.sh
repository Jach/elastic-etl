#!/bin/bash
cd /opt/elastic/kettle/data-integration/
./kitchen.sh -file=/opt/elastic/elastic-etl/elastic/etl/slave_polling_executor.kjb &> /tmp/polling_job`date +x%T`
