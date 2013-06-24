# Auditing Your Models

To enable auditing of your ORM models, you simple extend `Ordit`.

	class Model_Model extends Ordit
	{
		...
	}

Any CREATE, UPDATE and DELETE actions are automatically and transparently logged.
You don't have to do anything else.

# Viewing Your Logs
The module includes a log viewer. 

You can view logs at {{site_url}}/ordit

[!!]The log viewer was modified from [Kohana Log Viewer](https://github.com/ajaxray/Kohana-Log-Viewer) viewer.
