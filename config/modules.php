<?php
/**
 * Register application modules
 */
$application->registerModules(array(
	'loja' => array(
		'className' => 'Ecommerce\Loja\Module',
		'path' => __DIR__ . '/../apps/loja/Module.php'
	),
	'admin' => array(
		'className' => 'Ecommerce\Admin\Module',
		'path' => __DIR__ . '/../apps/admin/Module.php'
	),
	'documentacao' => array(
		'className' => 'Ecommerce\Documentacao\Module',
		'path' => __DIR__ . '/../apps/documentacao/Module.php'
	)
));