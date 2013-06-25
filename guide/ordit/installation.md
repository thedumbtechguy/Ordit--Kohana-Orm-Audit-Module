# Setting up the database

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
	
## Overriding the Ordit::get_username Method

In order to provide the current logged in user's username for auditing,
create a class in your classes folder named `Ordit` that extends the `Model_Ordit` class. 
Then override the `get_username` method to return the current logged in user's username. The example below uses
the default `Auth` module.

	class Ordit extends Model_Ordit
	{	
		protected function get_username()
		{
			return Auth::instance()->get_user()->username;
		}
	}

