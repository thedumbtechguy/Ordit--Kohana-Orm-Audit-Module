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

