
  </tbody>
                                      </table>

            </div><!--content table-->
            </div> <!--col 12--> 
           </div> <!--row-->

                                <div class="row">
                                    
                                    <div class="col-md-5">
                                      <!--marge-->
                                    </div>  
                                    <div class="col-md-4">
                                  <?php if ($this->session->userdata('ud_stat_exp')==1) : ?>
                                  <input type="button" class="btn btn-success btn-sm btn-fill" onclick="tableToExcel('statistique_agent', 'Statistique par agent')" value="EXPORTER">
                                  <?php endif ?>
                                    </div>
                                </div><!-- fin btn exporter-->      
                  


                            </div><!--div content interne-->
                        </div><!--div card-->  
                    </div><!--divmd12-->
                </div> <!--row-->

            </div><!--container fluid-->
        </div><!--content-->
 <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li><a href="#">Statistiques</a></li>
                        <li><a href="#">Enregistrements</a></li>
                        <li><a href="#">Utilisateurs</a></li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">BPOOI</a>, Tous droits réservés.
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="<?php echo js_url('jquery.3.2.1.min'); ?>" type="text/javascript"></script>
	<script src="<?php echo js_url('bootstrap.min'); ?>" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="<?php echo js_url('chartist.min'); ?>"></script>

    <!--  Notifications Plugin    -->
    <script src="<?php echo js_url('bootstrap-notify'); ?>"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="<?php echo js_url('light-bootstrap-dashboard'); ?>"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="<?php echo js_url('demo'); ?>"></script>

    <script type="text/javascript" >
    
    function RedirectionHier(){
    var campagne = document.getElementById('campagne').value;
    document.location.href="default/yesterday.php?c="+campagne; 
    //alert(campagne);
    }

        function RedirectionToday(){
    var campagne = document.getElementById('campagne').value;       
    document.location.href="<?php echo site_url('statistiques/today?c=');?>"+campagne; 
    }

        function RedirectionLastweek(){
    var campagne = document.getElementById('campagne').value;       
    document.location.href="default/lastweek.php?c="+campagne; 
    }

        function RedirectionWeek(){
    var campagne = document.getElementById('campagne').value;       
    document.location.href="default/week.php?c="+campagne; 
    }

        function RedirectionLastMonth(){
    var campagne = document.getElementById('campagne').value;       
    document.location.href="default/lastmonth.php?c="+campagne; 
    }

        function RedirectionMonth(){
    var campagne = document.getElementById('campagne').value;       
    document.location.href="default/month.php?c="+campagne; 
    }
    
    </script>

    


</html>