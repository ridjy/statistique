<div class="content">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-md-4">
                    <a href="<?php echo site_url('statistiques') ;?>"><button type="button" class="btn btn-primary"><i class="pe-7s-back"></i> Retour</button></a>
                  </div> 
                  <div class="col-md-4">
                   <h5><p class="text-info">Campagne : <?php echo $campagne ; ?></p></h5> 
                  </div>  
                
                <div class="col-md-4">
                  <img src="<?php echo img_url('LOGO2.gif') ;?>" alt="Oceancall Group" style="width: 240px; height:110px;margin: -15px auto;" class="pull-right" title="Oceancall Group" id="logo"/>  
                </div>
              </div> 

                <div class="row">
                        <!--<p>Tout le contenu ici</p>-->
                       <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Statistique du jour</h4>
                            </div>
                            <div class="content">
                              <div class="row">
                              <div class="col-md-12">  
                                  <div id="statglobal" class="content table-responsive table-full-width datagrid_globale">
                                      <table id="statistique_globale" border="1" class="table table-inverse table-bordered">
                                        <thead class="thead-inverse">
                                            <tr>
                                             <th colspan="14"> APPELS EN PLAGE DU <?php echo $libelle; ?> </th>
                                            </tr> 
                                            <tr>
                                            <th rowspan="3">DATE</th>
                                            <th rowspan="3" title="Total des appels du jour">TOTAL DES APPELS RECUS</th>
                                            <th colspan="7">SERVIS</th>
                                            <th colspan="4">PERDUS</th>
                                            <th rowspan="3" title="Rapport du total des appels servis sur le total des appels re&ccedil;us">QS</th>
                                            </tr>

                                            <tr scope="row">
                                            <th rowspan="2" title="Total des appels servis">TOTAL</th>
                                            <th rowspan="2" title="Total des appels trait&eacute;s">TRAITES</th>
                                            <th rowspan="2" title="Total des appels re&ccedil;us et abandonn&eacute;s pendant le parking">ABANDONNES EN PARKING</th>
                                            <th rowspan="2" title="Total des appels re&ccedil;us et transfer&eacute;s au central">TRANSFERES</th>
                                            <th rowspan="2" title="Total des appels re&ccedil;us avant 15 secondes">SANS ATTENTE <BR>(-15s)</th>
                                            <th rowspan="2" title="Total des appels re&ccedil;us apr&egrave;s 15 secondes">AVEC ATTENTE <BR>(+15s)</th>
                                            <th rowspan="2" title="Dur&eacute;e moyenne de traitement">DMT</th>
                                            <th colspan="2">ABANDONNES</th>
                                            <th rowspan="2" title="Total des appels transfer&eacute;s pendant nos heures de fermeture">TRANSFERES AUTOMATIQUES</th>
                                            <th rowspan="2" title="Total des appels non re&ccedil;us">TOTAL</th>
                                            </tr> 
 
                                            <tr>
                                            <th title="Total des appels abandonn&eacute;s">(-15s)</th>
                                            <th title="Total des appels abandonn&eacute;s">(+15s)</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                          <?php //print_r($rowglobale)?>
                                              <tr >
                                                <td><?php echo $libelle?></td>
                                                <td><?php echo $rowglobale['TOUT']; ?></td>
                                                <td><a><?php echo $rowglobale['SERVIS'];?></a></td>
                                                <td><a><?php echo $rowglobale['QUALIFIES'];?></a></td>
                                                <td><a><?php echo $rowglobale['ABANDONNE_PARKING'] ?></a></td>
                                                <td><a><?php echo $rowglobale['TRANSFERE_PARKING'] ?></a></td>
                                                <td><a><?php echo $rowglobale['SANS_ATTENTE'] ?></a></td>
                                                <td><a><?php echo $rowglobale['AVEC_ATTENTE'] ?></a></td>
                                                <td><?php echo $rowglobale['DMT'] ?></td>
                                                <td><a><?php echo $rowglobale['ABANDONNE_PERDU -15'] ?></a></td>
                                                <td><a><?php echo $rowglobale['ABANDONNE_PERDU +15'] ?></a></td>
                                                <td><a><?php echo $rowglobale['DISSUADE_PERDU'] ?></a></td>
                                                <td><?php echo $rowglobale['PERDUS'] ?></td>
                                                <td><?php echo $rowglobale['QS'] ?></td>
                                              </tr>
                                          
                                        </tbody>

                                        <?php 
                                          $tout_global = $tout_global + $rowglobale['TOUT'];
                                          $total_traites = $total_traites + $rowglobale['QUALIFIES'];
                                          $total_abandon_parking = $total_abandon_parking + $rowglobale['ABANDONNE_PARKING'];
                                          $total_transferes = $total_transferes + $rowglobale['TRANSFERE_PARKING'];
                                          $total_servis = $total_servis + $rowglobale['SERVIS'];
                                          $total_s_attente = $total_s_attente + $rowglobale['SANS_ATTENTE'];
                                          $total_a_attente = $total_a_attente + $rowglobale['AVEC_ATTENTE'];
                                          $total_abandonnes1 = $total_abandonnes1 + $rowglobale['ABANDONNE_PERDU -15'];
                                          $total_abandonnes2 = $total_abandonnes2 + $rowglobale['ABANDONNE_PERDU +15'];
                                          $total_trans_auto = $total_trans_auto + $rowglobale['DISSUADE_PERDU'];
                                          $total_perdu = $total_perdu + $rowglobale['PERDUS'];
                                        ?>

                                        <tfoot>
                                          <tr id="total">
                                              <td>TOTAL</td>
                                              <td><?php echo $tout_global; ?></td>
                                              <td><?php echo $total_servis ?></td>
                                              <td><?php echo $total_traites ?></td>
                                              <td><?php echo $total_abandon_parking ?></td>
                                              <td><?php echo $total_transferes ?></td>
                                              <td><?php echo $total_s_attente ?></td>
                                              <td><?php echo $total_a_attente ?></td>
                                              <td>-</td>
                                             <td><?php echo $total_abandonnes1 ?></td>
                                              <td><?php echo $total_abandonnes2 ?></td>
                                              <td><?php echo $total_trans_auto ?></td>
                                              <td><?php echo $total_perdu ?></td>
                                              <td>-</td>
                                          </tr>
                                        </tfoot>

                                      </table>

                                  </div><!--div table-->
                                </div><!--div md12-->
                               </div><!--div row-->

                               <div class="row">
                                <div class="col-md-5">
                                  <!--marge-->
                                </div>  
                                <div class="col-md-4">
                                  <?php if ($this->session->userdata('ud_stat_exp')==1) : ?>
                                  <input type="button" class="btn btn-success btn-sm btn-fill" onclick="tableToExcel('statistique_globale', 'Statistique globale')" value="EXPORTER">
                                  <?php endif ?>
        
                                </div>
                                </div><!-- fin btn exporter-->

                               <div class="row">
                                <div class="col-md-12">  
                                  <div class="content table-responsive table-full-width datagrid_agent">
                                     <!--ici la table-->

                                      <table id="statistique_agent" border="1" name="STATISITQUES AGENTS" class="table table-inverse table-bordered ">
                                        <thead>
                                          <tr>
                                           <th colspan="9"> APPELS EN PLAGE DU <?php echo $libelle; ?> </th>
                                          </tr>
                                          <tr>
                                          <th rowspan="2">AGENT</th>
                                          <th colspan="7">SERVIS</th>
                                          <th rowspan="2" title="Rapport du total des appels servis sur le total des appels re&ccedil;us">QS</th>
                                          </tr>
                                           <tr>
                                            <th title="Total des appels servis">TOTAL RECU</th>
                                          <th title="Total des appels trait&eacute;s">TOTAL TRAITES</th>
                                          <th title="Total des appels re&ccedil;us et abandonn&eacute;s pendant le parking">ABANDONNES EN PARKING</th>
                                          <th title="Total des appels re&ccedil;us et transfer&eacute;s au central">TRANSFERES</th>
                                          <th title="Total des appels re&ccedil;us sans attente">TOTAL APPELS SERVIS SANS ATTENTE</th>
                                          <th title="Total des appels re&ccedil;us avec attente">TOTAL APPELS SERVIS AVEC ATTENTE</th>
                                          <th title="Dur&eacute;e moyenne de traitement">DMT</th>
                                          </tr> 
                                        </thead>
                                        <tbody>
                                         