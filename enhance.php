<?php
ini_set('display_errors',1);
error_reporting(E_ALL | E_STRICT);
define('DS',DIRECTORY_SEPARATOR);
define('APP',dirname(__DIR__).'/dev/');
define('CORE',dirname(dirname(__DIR__)).'/core/dev/');
define('CLIBS',dirname(CORE).'/libs/dev/');
define('ENV',include dirname(CORE).DS.'env.php');

include CORE.'base/base.php';
include CORE.'enhancers/EnhanceApp.php';
include CORE.'utils/UExec.php';
include CORE.'utils/UEncoding.php';

$f=new Folder(dirname(__DIR__).DS.'tmp_dev'); if($f->exists()) $f->delete();
$f=new Folder(dirname(__DIR__).DS.'tmp_prod'); if($f->exists()) $f->delete();

$instance=new EnhanceApp(dirname(__DIR__));
$instance->process(true);
