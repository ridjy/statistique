<div class="content">
            <div class="container-fluid">
                <?php if ($e!='') :?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="alert alert-info">
                            <button type="button" onclick="ferme()" aria-hidden="true" class="close">×</button>
                            <span><b> Attention - </b> <?php echo $e;?> </span>
                        </div>
                    </div>
                </div>     
                <?php endif ?>    
                <div class="row">
                    <div class="col-md-1">
                    </div>  
                    <div class="col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"></h4>
                                <p class="text-danger">Les champs * sont obligatoires<p>
                            </div>
                            <div class="content">
                                <form  method="POST" action="<?php echo site_url('enregistrements/traitement');?>">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Date début*</label>
                                                <input type="date" name="recherche_date_debut" required class="form-control" placeholder="jj-mm-aaaa" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Date fin*</label>
                                                <input type="text" name="recherche_date_fin" required class="form-control" placeholder="jj-mm-aaaa" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Heure début*</label>
                                                <input type="text" name="recherche_heure_debut" required class="form-control" placeholder="hh:mm" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Heure fin*</label>
                                                <input type="text" class="form-control" name="recherche_heure_fin" required placeholder="hh:mm" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nom campagne</label>
                                                <select name="recherche_campagne"><option value="ALLOTAXI">AlloTaxi</option></select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nom agent</label>
                                                <select  name="recherche_agent" Placeholder="Agent...">
                                                  <option value=""> </option>
                                                  <option value="RAA"> ENZO (ANDREAS) </option>
                                                  <option value="RNA"> JULIE (NATHIE) </option>
                                                  <option value="RAN"> NANCY (NANCY) </option>
                                                  <option value="RJN"> JENNY (JENNY) </option>
                                                  <option value="RSO"> SOPHIE (SANTATRA) </option>
                                                  <option value="RAS"> ANNA (ANNA) </option>
                                                  <option value="RIK"> ERICA (ERICA) </option>
                                                  <option value="CHR"> CHRISTIAN (CHRISTIAN) </option>                                     
                                                  <option value="RAM"> MAËLLE (MAËLLE) </option>
                                                  <option value="RAE"> ERIC (ERIC) </option>
                                                  <option value="RSH"> TINA(SHAKILA) </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                          <div class="form-group">
                                                <label>Téléphone</label>
                                                <input type="text" name="recherche_tel" class="form-control" placeholder="Téléphone" value="">
                                          </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-warning btn-fill pull-right">Valider</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div><!--content-->
                        </div><!--card le container-->
                    </div><!--col md8-->

                    <div class="col-md-4">
                    <img src="<?php echo img_url('LOGO2.gif') ;?>" alt="Oceancall Group" style="width: 240px; height:110px;margin: -15px auto;" class="pull-right" title="Oceancall Group" id="logo"/>  
                  </div>
                              
            </div><!--row-->
        </div><!--contenair fluid-->
    </div><!--content-->