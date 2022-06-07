<?php

class extAdmintoolsAdminFiles extends AbstractPage {
	
	public static function getSiteDisplayName() {
		return '<i class="fas fa-tools"></i> Admintools - Dateien';
	}

	public function __construct($request = [], $extension = []) {
		parent::__construct(array( self::getSiteDisplayName() ), false, false, false, $request, $extension);
		$this->checkLogin();
	}

	public function execute() {

		//$this->getRequest();
		//$this->getAcl();

        $user = DB::getSession()->getUser();

        if ( !$user->isAnyAdmin() ) {
            new errorPage('Kein Zugriff');
        }


        $files = FileUpload::getAll();

        $json_files = [];

        foreach($files as $file) {
            $json = $file->getCollection();
            //if ($json['exist']) {
                $json_files[] = $json;
            //}

        }

        /*
        echo '<pre>';
        print_r($json_files);
        echo '</pre>';
*/



		$this->render([
			"tmpl" => 'files',
			"scripts" => [
                PATH_EXTENSION.'tmpl/scripts/files/dist/main.js'
			],
			"data" => [
				"selfURL" => URL_SELF,
                "files" => $json_files
			]

		]);

	}


}
