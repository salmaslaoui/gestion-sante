<?php
require_once 'header.php';
?>

<div class="row">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<p>
				La base de données du site est la base de données publique des médicaments.
				Celle-ci est accesible via <a href="http://base-donnees-publique.medicaments.gouv.fr/">ce lien</a> :
				<a href="http://base-donnees-publique.medicaments.gouv.fr/">http://base-donnees-publique.medicaments.gouv.fr/</a>.
				</br>
				Leur date de mise à jour est : 07/03/2020.
				(Article 12 de la loi n°78-753 du 17 juillet 1978 - loi CADA)
			</p>
		</div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<form action="#" method="post">
			<h3>Rechercher un médicament :</h3>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
				<div class="form-example-int form-example-st">
					<div class="form-group">
						<div class="nk-int-st">
							<input name="inputsearch" id="inputsearch" type="text" class="form-control input-sm" placeholder="Rechercher un médicament">
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-3 col-xs-2">
				<div class="form-example-int">
					<button name="buttonsearch" id="buttonsearch" class="btn btn-success notika-btn-success waves-effect">
						<i class="fas fa-search"></i>
					</button>
				</div>
				</br>
				</br>
			</div>
		</form>
	</div>
</div>

<div id="result_med" class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php
				if(isset($resultatmedtest)){
					echo "<h3>Résultats pour votre recherche : ".$var."</h3>";
					foreach($ret AS $row){
						$id_row = $row['cis_cis'];
						$retCip = $recupMedicCip->select_cis_cip_by_idcis($id_row);
						$retCompo = $recupMedicCompo->select_cis_compo_by_idcis($id_row);
						$retGener = $recupMedicGener->select_cis_gener_by_idcis($id_row);
						$retCpd = $recupMedicCpd->select_cis_cpd_by_idcis($id_row);
						$retAsmr = $recupMedicHasAsmr->select_cis_has_asmr_by_idcis($id_row);
						
						$retSmr = $recupMedicHasSmr->select_cis_has_smr_by_idcis($id_row);
						if(!empty($retAsmr)){
							$retHasLiens = $recupMedicLiens->select_liens_page_by_code_dossier($retAsmr[0]['cis_ha_file']);
						}
						$retInfosImp = $recupMedicInfosImp->select_cis_infoImportantes_aaaammjjhhmiss_by_idcis($id_row);
						
						echo $row['cis_cis'] . " " . $row['cis_name']. " " . $row['cis_type']
						. " " . $row['cis_take'] ." " . $row['cis_status']." " . $row['cis_proc']
						. " " . $row['cis_comm']. " " . $row['cis_date_amm']. " " . $row['cis_status_bdm']
						. " " . $row['cis_ue_number']. " " . $row['cis_lab']. " " . $row['cis_watch'];

						foreach($retCip AS $rowCip){
							echo $rowCip['cis_cip_cip7'] . " " . $rowCip['cis_cip_name']. " " . $rowCip['cis_cip_admin']
							. " " . $rowCip['cis_cip_comm'] ." " . $rowCip['cis_cip_date']." " . $rowCip['cis_cip_cip13']
							. " " . $rowCip['cis_cip_community']. " " . $rowCip['cis_cip_refund']. " " . $rowCip['cis_cip_price']
							. " " . $rowCip['cis_cip_price2']. " " . $rowCip['cis_cip_price3']. " " . $rowCip['cis_cip_law'];
						}
						foreach($retCompo AS $rowCompo){
							echo $rowCompo['cis_comp_type'] . " " . $rowCompo['cis_comp_code']. " " . $rowCompo['cis_comp_sub']
							. " " . $rowCompo['cis_comp_dosage']. " " . $rowCompo['cis_comp_ref']
							. " " . $rowCompo['cis_comp_nature']. " " . $rowCompo['cis_comp_link_number']
							. " " . $rowCompo['cis_comp_col9'];
						}
						foreach($retGener AS $rowGener){
							echo $rowGener['cis_gen_name'] . " " . $rowGener['cis_gen_cis']. " " . $rowGener['cis_gen_type']
							. " " . $rowGener['cis_gen_sort']. " " . $rowGener['cis_gen_col6'];
						}
						foreach($retCpd AS $rowCpd){
							echo $rowCpd['cis_cpd_cond'];
						}
						foreach($retAsmr AS $rowHasAsmr){
							echo $rowHasAsmr['cis_ha_file'] . " " . $rowHasAsmr['cis_ha_motive']
							. " " . $rowHasAsmr['cis_ha_date']
							. " " . $rowHasAsmr['cis_ha_value']. " " . $rowHasAsmr['cis_ha_desc'];
						}
						foreach($retSmr AS $rowHasSmr){
							echo $rowHasSmr['cis_hs_file'] . " " . $rowHasSmr['cis_hs_motive']
							. " " . $rowHasSmr['cis_hs_date']
							. " " . $rowHasSmr['cis_hs_value']. " " . $rowHasSmr['cis_hs_desc'];
						}
						foreach($retInfosImp AS $rowInfosImp){
							echo $rowInfosImp['cis_ii_start_date'] . " " . $rowInfosImp['cis_ii_end_date']
							. " " . $rowInfosImp['cis_ii_desc'];
						}
						if(!empty($retHasLiens)){
							foreach($retHasLiens AS $rowLiens){
								echo $rowLiens['has_link'];
							}
						}
					}
				}
				if(isset($error) && !empty($error)){
					echo '<div style="color:red">',$error,'</div>';
				}
			?>
			</br>
			</br>
		</div>
	</div>

<?php
require_once 'footer.php';
?>