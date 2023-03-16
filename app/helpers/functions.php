<?php
use Zizaco\Entrust\EntrustFacade as Entrust;
use Illuminate\Support\Facades\Auth;
use App\User;
	

  function arrStatusActive()
  {
      return array('Y' => __('main.active'), 'N' => __('main.non-active'));
  }

  function arrStatusActiveLabel()
  {
      return array('Y' => 'info', 'N' => 'danger');
  }

	function diset($set,$id_quotation){
		@session_start();
		if (session()->has('diset')){
			$diset = array('diset'=>$id_quotation);
			Session::put($diset, array());
		}
			$diset = array('diset'=>array($id_quotation=>true));
			Session::put($diset);
	}

	function diget($id_quotation){	

		if(session()->has('diset')){
					$diset = session()->get('diset');
		 			if(isset($diset[$id_quotation])) return $diset[$id_quotation];
		 			else return false;
		}else{
					return false;
		}
	}  

	function arrGender() {
	    return array('L' => __('main.male'), 'P' => __('main.female'));
	}

	function arrTipeData(){
	    return array(
                  "0" => array (
                      "id" => '1',
                      "tipe_dokumen" => 'doc',
                      "ket" => 'Microsoft Word 97 - 2003 Document'
                  ),
                  "1" => array (
                      "id" => '2',
                      "tipe_dokumen" => 'docx',
                      "ket" => 'Microsoft Word Document'
                  ),
                  "2" => array (
                      "id" => '3',
                      "tipe_dokumen" => 'xls',
                      "ket" => 'Microsoft Excel 97 - 2003 Worksheet'
                  ),
                  "3" => array (
                      "id" => '4',
                      "tipe_dokumen" => 'xlsx',
                      "ket" => 'Microsoft Excel Worksheet'
                  ),
                  "4" => array (
                      "id" => '5',
                      "tipe_dokumen" => 'ppt',
                      "ket" => 'Microsoft PowerPoint 97 - 2003 Presentation'
                  ),
                  "5" => array (
                      "id" => '6',
                      "tipe_dokumen" => 'pptx',
                      "ket" => 'Microsoft PowerPoint Presentation'
                  ),
                  "6" => array (
                      "id" => '7',
                      "tipe_dokumen" => 'pdf',
                      "ket" => 'Portable Document Format'
                  ),
                  "7" => array (
                      "id" => '8',
                      "tipe_dokumen" => 'psd',
                      "ket" => 'Photoshop Document'
                  ),
                  "8" => array (
                      "id" => '9',
                      "tipe_dokumen" => 'rar',
                      "ket" => 'RAR Archive'
                  ),
                  "9" => array (
                      "id" => '10',
                      "tipe_dokumen" => 'zip',
                      "ket" => 'ZIP Archive'
                  ),
                  "10" => array (
                      "id" => '11',
                      "tipe_dokumen" => 'jpeg',
                      "ket" => 'Joint Photographic Experts Group'
                  ),
                  "11" => array (
                      "id" => '12',
                      "tipe_dokumen" => 'jpg',
                      "ket" => 'Joint Photographic Group'
                  ),
                  "12" => array (
                      "id" => '13',
                      "tipe_dokumen" => 'png',
                      "ket" => 'Portable Network Graphics'
                  )
	    );
	}

	function pre($var){
	    echo '<pre>';
	    print_r($var);
	    echo '</pre>';
	}