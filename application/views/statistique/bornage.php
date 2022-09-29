<div class="content">
            <div class="container-fluid">
              
                <div class="row">
                  <div class="col-md-1 ">
                  </div>  
                  <div class="col-md-7 ">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Statistiques personnalisés</h4>
                            </div>
                            <div class="content">
                                <form method="POST" action="<?php echo site_url('statistiques/statperso'); ?>">

                                    <div class="row">
                                        <div class="col-md-5">
                                           
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                               <label>CAMPAGNE</label>
                                               <select id="campagne" name="campagne" style="font-size: 16px;" class="selectpicker" data-style="btn-primary">
                                                  <?php if ($this->session->userdata('camp_chartres')==1) {
                                                  echo '<option value="ALLOTAXI">Chartres</option>' ;
                                                  } ?>
                                                  <?php if ($this->session->userdata('camp_troyes')==1) {
                                                  echo '<option value="ALLOTAXI_TROYES">Troyes</option>' ;
                                                  } ?>
                                                  <?php if ($this->session->userdata('camp_chateauroux')==1) {
                                                  echo '<option value="ALLOTAXI_CHATEAUROUX">Chateauroux</option>' ;
                                                  } ?>
                                                </select>
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="row">
                                       <div class="col-md-4">
                                            <div class="form-group">
                                              <p><input type="checkbox" name="contigu" value="1" >  Stat. contigu</p>
                                            </div>
                                        </div>  
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date début</label>
                                                <input type="text" class="form-control" id="datedbt" placeholder="jj-mm-aaaa" name="datedbt" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date fin</label>
                                                <input type="text" class="form-control"  id="datefin" placeholder="jj-mm-aaaa" name="datefin" value="">
      
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Heure début</label>
                                                <input type="text" class="form-control" id="timedbt" placeholder="hh:mm" name="heuredbt" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Heure fin</label>
                                                <input type="text" class="form-control" id="timefin" placeholder="hh:mm" name="heurefin" value="">
      
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                       
                                    </div>

                                    <button type="submit" class="btn btn-warning btn-fill pull-right">Valider</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div><!--content-->
                        </div><!--card-->
                    </div><!--col md12-->

                  <div class="col-md-4">
                    <img src="<?php echo img_url('LOGO2.gif') ;?>" alt="Oceancall Group" style="width: 240px; height:110px;margin: -15px auto;" class="pull-right" title="Oceancall Group" id="logo"/>  
                  </div>

                </div> <!--row-->

                  <div class="row">
                        <!--<p>Tout le contenu ici</p>-->
                        <div class="col-md-1">
                        </div>  
                        <div class="col-md-10">
                          <button class="btn btn-info btn-fill" onclick="RedirectionLastMonth()">Mois dernier</button>
                          <button class="btn btn-info btn-fill" onclick="RedirectionMonth()">Mois en cours</button>
                          <button class="btn btn-info btn-fill" onclick="RedirectionLastweek()">Semaine dernière</button>
                          <button class="btn btn-info btn-fill" onclick="RedirectionWeek()">Semaine en cours</button>
                          <button class="btn btn-info btn-fill" onclick="RedirectionHier()">Hier</button>
                          <button class="btn btn-info btn-fill " onclick="RedirectionToday()">Aujourd'hui</button>
                        </div>
                        <div class="col-md-1">
                        </div>
                </div>

            </div><!--container fluid-->
        </div><!--content-->