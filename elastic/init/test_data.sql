## master_config records
insert into master_config (param_name, param_value) values ('NUM_SLAVES_TO_START_DAILY', '2');

## include to test ability for slave to bail if already have a running job
insert into job (job_id, slave_server_id_lock, job_start_time, job_status) values (100, '192.168.75.1', '1970-01-01 00:00:01', 'running');

##
insert into job (job_id, slave_server_id_lock, job_start_time, job_status) values (101, null, null, 'unscheduled');

## test for a full run
insert into job_template (job_template_id, job_template_schedule, job_template_client_id, job_template_kettle_kjb, job_template_sequence) values (1000, 'daily', 999, 'test/testjob.kjb', 1);
insert into job_template (job_template_id, job_template_schedule, job_template_client_id, job_template_kettle_kjb, job_template_sequence) values (1001, 'daily', 999, 'test/testjob.kjb', 2);
insert into job (job_id, slave_server_id_lock, job_start_time, job_status, job_template_id) values (101, null, null, 'unscheduled', 1000);
insert into job (job_id, slave_server_id_lock, job_start_time, job_status, job_template_id) values (102, null, null, 'unscheduled', 1001);
insert into param (job_template_id, param_name, param_value) values (1000, 'var1', 'value1');
insert into param (job_template_id, param_name, param_value) values (1000, 'var2', 'value2');
insert into param (job_template_id, param_name, param_value) values (1001, 'var1', 'value1AAAA');
insert into param (job_template_id, param_name, param_value) values (1001, 'var2', 'value2AAAA');
