# Ordit

Ordit is a Kohana 3.x module that adds automatic auditing to the Official ORM module.

Ordit is a transparent extension that audits all CUD actions on your objects.
It includes  a Log Viewer to view all Audit logs.

## Getting started

Before we use ORM, we must enable the modules required

	Kohana::modules(array(
		...
		'database' => MODPATH.'database',
		'orm' => MODPATH.'orm',
		'ordit' => MODPATH.'ordit',
		...
	));

[!!] Ordit requires the ORM module (plus its dependencies) to work.

### Setting up the database

You need to create a table in your database to hold all your logs.

A script is included in the module named `ordit_logs.sql`
The script is for a mysql database running the InnoDB engine.

The table is configured as follows:

	Table Name :: 
		`ordit_logs`
	Columns ::
		`id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY
		`model` CHAR(50) NOT NULL,
		`action` CHAR(7) NOT NULL,
		`values` TEXT NOT NULL,
		`user` CHAR(50) NOT NULL,
		`timestamp_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	
### Overriding the Ordit::get_username Method

In order to provide the current logged in user's username for auditing,
create a class in your classes folder named `Ordit`. The example below uses
the default `Auth` module.

	class Ordit extends Model_Ordit
	{	
		protected function get_username()
		{
			return Auth::instance()->get_user()->username;
		}
	}

### Auditing Your Models

To enable auditing of your ORM models, you simple extend `Ordit`.

	class Model_Model extends Ordit
	{
		...
	}

Any CREATE, UPDATE and DELETE actions are automatically and transparently logged.
You don't have to do anything else.

### Viewing Your Logs
The module includes a log viewer. 

You can view logs at {{site_url}}/ordit

[!!]The log viewer was modified from [Kohana Log Viewer](https://github.com/ajaxray/Kohana-Log-Viewer) viewer.


## TODO

### Log Changes to Related Modules
Currently, changes to related modules are logged as an empty array.

##Improve Viewer

Add pagination to the log results

Add ability to search by currently `undefined parameters`
