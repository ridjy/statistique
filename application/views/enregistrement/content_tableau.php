  <!--<tr>
                                          <td>1</td>
                                          <td>Dakota Rice</td>
                                          <td>$36,738</td>
                                          <td>Niger</td>
                                          <td>Oud-Turnhout</td>
                                          <td>Niger</td>
                                          <td>Oud-Turnhout</td>
                                        </tr>
                                        -->
<tr>
  <td><?php echo $date;?></td>
  <td><?php echo $heure;?></td>
  <td><?php echo $agent;?></td>
  <td><?php echo $tel;?></td>
  <td><?php echo $duree;?></td>
  <td>
    <form name="lecture" style="padding-top:17px;text-align:center" action="<?php echo site_url('enregistrements/lecture');?>" method="post" TARGET=_BLANK>
      <input type="hidden"  name="lecture_ffname" value="">
      <input type="hidden"  name="lecture_fname" value="">
      <input type="image" src="<?php echo img_url('lecture.ico');?>" name="Lire" width="25" height="20">
    </form>
  </td>
  <?php if ($this->session->userdata('ud_enr_tel')==1) ?>    
      <td>
        <form name="download" style="padding-top:17px; text-align:center " action="<?php echo site_url('enregistrements/download');?>" method="post">
        <input type="hidden" name="download_ffname" value="">
        <input type="hidden" name="download_fname" value="">
        <input type="image" src="<?php echo img_url('lecture.ico');?>" title="L\'ecoute des fichiers ne se fera que sur VLC" name="telecharger" width="20" height="20"></form>
      </td> 
</tr> 