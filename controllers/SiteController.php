<?php
class SiteController extends Controller{
	/**
	*/ function index(){
		Server::Table()->paginate()->controller('servers')->actions('edit')->render(_tF('Server'),true);
	}

	/**
	*/ function favicon(){
		 self::renderFile(APP.'web/img/favicon.ico');
	}

	/**
	*/ function robots(){
		 self::renderText("User-agent: *\Disallow: /\n");
	}
}