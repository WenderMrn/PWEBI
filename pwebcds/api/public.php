<?php
	require_once "../config/imports.all.php";


	if(isset($_GET['cds'])){

		try{
				# code...
				$daocd = new DAOCD();
				$result = $daocd->readAll();
				
				$response['response'] = array(
	    					'cds' => $result,
	  					);
					if($_GET['cds'] == 'json'){
						header('Content-type: application/json');
						$encoded = json_encode($response);
						exit($encoded);

					}
				//else 
					if ($_GET['cds'] == 'xml'){

						 $dom = new DOMDocument('1.0', 'utf-8');
					    // $dom->formatOutput = true;
					     $cds= $dom->createElement('cds');
					     $dom -> appendChild($cds);
						foreach ($result as  $value) {
							 $cd= $dom->createElement('cd');
							 
							 $title = $dom->createElement('title', $value->title);
							 $release_year = $dom->createElement('release_year', $value->release_year);
							 $singer = $dom->createElement('singer', $value->singer->name);
							 $photo = $dom->createElement('photo', $value->photo);

							 $cd->appendChild($title);
							 $cd->appendChild($release_year);
							 $cd->appendChild($singer);
							 $cd->appendChild($photo);

							 $cds->appendChild($cd);

						}
						header("Content-type: text/xml");
						exit($dom->saveXML());
						echo $dom->saveXML();
						
					}
				
				

			} catch (Exception $e) {
				exit($e.getMessage());
			}

		

	}




?>