<div class="content">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-md-2">
                    <a href="<?php echo site_url('enregistrements') ;?>"><button type="button" class="btn btn-primary">Retour</button></a>
                  </div> 
                  <div class="col-md-6">
                   <h5><p class="text-info"></p></h5> 
                  </div>  
                </div><br/>  
                <div class="row">
                        <!--<p>Tout le contenu ici</p>-->
                       <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Résultats de vos recherches</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table border="1" class="table table-hover table-striped">
                                  <thead>
                                      <tr>
                                        <th style="background-color:#006699; color:#FFFFFF">Date<br></th>
                                        <th style="background-color:#006699; color:#FFFFFF" >Heure<br></th>
                                        <th style="background-color:#006699; color:#FFFFFF">Agent<br></th>
                                        <th style="background-color:#006699; color:#FFFFFF">Téléphone<br></th>
                                        <th style="background-color:#006699; color:#FFFFFF">Durée<br></th>
                                       <!--<th style="background-color:#006699; color:#FFFFFF">Taille du Fichier<br></th>-->
                                       <!--<th style="background-color:#006699; color:#FFFFFF" >Campagne<br></th>-->
                                       <!--<th style="background-color:#006699; color:#FFFFFF">Agent<br></th>-->
                                       <!--<th style="background-color:#006699; color:#FFFFFF">Qualification<br></th>-->
                                        <th style="background-color:#006699; color:#FFFFFF"><img src="<?php echo img_url('lecture.ico');?>" alt="Lire fichier" ></th>
                                        <?php if ($this->session->userdata('ud_enr_tel')==1) :?>
                                        <th style="background-color:#006699; color:#FFFFFF"><img src="<?php echo img_url('telecharger.ico');?>" alt="Télécharger" style="text-align:center;"></th>
                                        <?php endif?>
                                      </tr>
                                  </thead>
                                  <tbody>
                                        <!--<tr>
                                          <td>1</td>
                                          <td>Dakota Rice</td>
                                          <td>$36,738</td>
                                          <td>Niger</td>
                                          <td>Oud-Turnhout</td>
                                        </tr>
                                        -->
                                  </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div> <!--row-->

            </div><!--container fluid-->
        </div><!--content-->