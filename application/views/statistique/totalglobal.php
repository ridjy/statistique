 </tbody>

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