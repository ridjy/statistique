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
      </div><br/>
                    
      <div class="row">  
        <div class="col-md-12">
              <div class="card">
                  <div class="header">
                      <h4 class="title">Statistiques personnalisés</h4>
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
                 
