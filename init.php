<?php
$databasesDir=dirname(__DIR__).'/';
$baseDir=dirname($databasesDir).'/';

echo shell_exec('cd '.escapeshellarg($databasesDir).' && ln -s src/enhance.php');

$coreDir=$baseDir.'core/dev/';
file_put_contents($databasesDir.'cli.php',"<?php
define('DS', DIRECTORY_SEPARATOR);
define('CORE','".$coreDir."');
define('APP', __DIR__.DS.'dev'.DS);
".'unset($argv[0]);
$action=array_shift($argv);'."
include CORE.'cli.php';");

mkdir($databasesDir.'config');
echo shell_exec('cd '.escapeshellarg($databasesDir).'src && ln -s ../config && cd .. && ln -s src/db');

$env=include $baseDir.'core/env.php';

file_put_contents($databasesDir.'config/secure.php','<?php return array();');
file_put_contents($databasesDir.'config/cookies.php','<?php return null;');
file_put_contents($databasesDir.'config/enhance.php',"<?php return array(
	'base'=>array('i18n'),
	'includes'=>array(
		'img'=>array('filetree','jquery-ui'),
		'js'=>array('ace')
	)
);");
file_put_contents($databasesDir.'config/_.php',"<?php return array(
	'project_name'=>'databases',
	'projectName'=>'Springbok Databases',
	'default_lang'=>'fr',
	
	'secure'=>array(
		'crypt_key'=>'".str_replace("'",'0',uniqid('',true))."',
	)
);");

file_put_contents($databasesDir.'config/_'.$env.'.php',"<?php return array(
	'siteUrl'=>array('index'=>'http://localhost/'),
	'php_doc_dir'=>dirname(__DIR__).'/php-chunked-xhtml/',
	
	'db'=>array(
		'_lang'=>dirname(__DIR__).'/db/',
		'default'=>array('type'=>'SQLite', 'file'=>dirname(__DIR__).'/webmanager.db',),
		'mysql'=>array( 'type'=>'MySQL','host'=>'localhost','dbname'=>'mysql', 'user'=>'mysql','password'=>'mysql'),
	),
	'generate'=>array('default'=>true,'mysql'=>false),
	
	'export_dir'=>'".`cd ~ && pwd`."/SQL/'
);");

file_put_contents($databasesDir.'config/routes.php',"<?php return array(
	'/favicon'=>array('Site::favicon','ext'=>'[a-z]+'),
	'/robots'=>array('Site::robots','ext'=>'txt'),'/'=>array('Site::index'),
	
	'/:id'=>array('Servers::view',null,array('fr'=>'/:id')),
	'/:id/:action/*'=>array('Servers::!',null,array('fr'=>'/:id/:action/*')),
	
	'/:id-:dbname/table/:tablename'=>array('Table::view',array('dbid'=>'[0-9]+'),array('fr'=>'/:id-:dbname/table/:tablename')),
	'/:id-:dbname/table/:tablename/:action/*'=>array('Table::!',array('dbid'=>'[0-9]+'),array('fr'=>'/:id-:dbname/table/:tablename/:action/*')),
	
	'/:id-:dbname'=>array('Database::view',array('sid'=>'[0-9]+'),array('fr'=>'/:id-:dbname')),
	'/:id-:dbname/:action/*'=>array('Database::!',array('dbid'=>'[0-9]+'),array('fr'=>'/:id-:dbname/:action/*')),
	
	'/:controller(/:action/*)?'=>array('!::!'),
);");