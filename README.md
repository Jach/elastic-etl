# About

This is a modified form of an older project we at DynamoBI did for a client that
we are releasing as open source with the hope someone else may find it
of some use in the future.

The scripts and PHP application provide functionality to make elastic
ETL with PDI 4.1 and Kettle less painful by horizontally scaling on
the EC2 cloud machines of Amazon.

Jobs can be scheduled to run once a day (and other
frequencies), pre-defined Amazon instance machines will be started up when
needed by a continually running master instance. Together they will finish
the batch of scheduled jobs in parallel then turn off again.

The PHP framework provides a manual way for an administrator to check up
on the jobs, manually create/launch new jobs or job templates,
check the status of slave servers, and more.

# Documentation

Setting up the Master Server documentation can be found in
[Install-Document](wiki/Install-Document).

Make sure you load the DDL found in elastic_jobs_datamodel.ddl to the
database you set up.

General documentation can be found in `documentation.pdf`. Important sections
are "Generating new models" on page 3, "Security" on page 4
(specifically "Passwords"), and the non-obsolete
"Master Configuration Settings" on page 6.

# License

The software here is copyright 2012 DynamoBI and
distributed under the Apache License version 2.0 unless
otherwise specified, see NOTICE for more details.
