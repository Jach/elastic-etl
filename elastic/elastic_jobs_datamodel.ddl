## MySQL database "log" 

CREATE TABLE master_config (
                param_name VARCHAR(256) NOT NULL,
                param_value VARCHAR(256) NOT NULL,
                PRIMARY KEY (param_name)
);


CREATE TABLE job_template (
                job_template_id INT NOT NULL AUTO_INCREMENT,
                job_template_schedule ENUM('daily', 'weekly', 'monthly', 'never', 'now') NOT NULL,
                job_template_client_id VARCHAR(256) NOT NULL,
                job_template_kettle_kjb VARCHAR(256) NOT NULL,
                job_template_sequence INT NOT NULL,
                job_template_max_retries INT NOT NULL DEFAULT 0,
                job_template_retry_delay TIME NOT NULL DEFAULT '000:15:00',
                PRIMARY KEY (job_template_id)
);

#ALTER TABLE job_template MODIFY COLUMN job_template_schedule VARCHAR(20) COMMENT 'daily, monthly, weekly, never';


CREATE TABLE param (
                param_id INT NOT NULL AUTO_INCREMENT,
                job_template_id INT NOT NULL,
                param_name VARCHAR(256) NOT NULL,
                param_value VARCHAR(4096),
                PRIMARY KEY (param_id),
                UNIQUE KEY (job_template_id, param_name)
);

CREATE TABLE client_param (
                client_param_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                job_template_client_id VARCHAR(256),
                param_name VARCHAR(256) NOT NULL,
                param_value VARCHAR(4096),
                UNIQUE KEY (job_template_client_id, param_name),
                CONSTRAINT job_template_client_params_fk
                FOREIGN KEY (job_template_client_id)
                REFERENCES job_template (job_template_client_id)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION
);


CREATE TABLE slaves (
                slave_server_id VARCHAR(256) NOT NULL,
                slave_status ENUM('starting', 'working', 'idling') NOT NULL,
                slave_carte_url VARCHAR(256) NOT NULL,
                slave_startup_time DATETIME NOT NULL,
                PRIMARY KEY (slave_server_id)
);

#ALTER TABLE slaves MODIFY COLUMN slave_server_id VARCHAR(256) COMMENT 'ver.';

# Changed to just contain simple info.
#ALTER TABLE slaves MODIFY COLUMN slave_status VARCHAR(20) COMMENT 'found no additional jobs to be executed)';


CREATE TABLE job (
                job_id INT NOT NULL AUTO_INCREMENT,
                slave_server_id_lock VARCHAR(256),
                job_start_time DATETIME,
                job_status ENUM('unassigned', 'retry', 'running', 'success', 'error') NOT NULL,
                job_retry_attempt INT NOT NULL DEFAULT 0,
                job_prior_failed_job_id INT DEFAULT NULL,
                job_template_id INT NOT NULL,
                job_kettle_id INT DEFAULT NULL,
                PRIMARY KEY (job_id)
);

#ALTER TABLE job MODIFY COLUMN slave_server_id_lock VARCHAR(256) COMMENT 'the server that is running this job.';

#ALTER TABLE job MODIFY COLUMN job_status VARCHAR(20) COMMENT 'success, error (both completion states)';

#ALTER TABLE job MODIFY COLUMN job_kettle_id INTEGER COMMENT 'porting based on the ID in the regular, Kettle tables.';


ALTER TABLE param ADD CONSTRAINT job_template_job_params_fk
FOREIGN KEY (job_template_id)
REFERENCES job_template (job_template_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE job ADD CONSTRAINT job_template_job_fk
FOREIGN KEY (job_template_id)
REFERENCES job_template (job_template_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE job ADD CONSTRAINT slaves_job_fk
FOREIGN KEY (slave_server_id_lock)
REFERENCES slaves (slave_server_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
