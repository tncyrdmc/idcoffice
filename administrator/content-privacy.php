<?php
  require("../includes/config.php"); 
  require_once(ROOT_PATH . "core/class.admin.php");
  require_once(ROOT_PATH . "core/adminSession.php");

  try {
      $stmt = $auth_user->runQuery("SELECT * FROM contents WHERE c_id='1'");
      $stmt->execute();
      $content = $stmt->fetch(PDO::FETCH_ASSOC);
  }catch(PDOException $e) {
      echo $e->getMessage();
  }
  
  //
  if(isset($_POST['privacy'])) {
    $privacy = $_POST['privacy'];
    try {
      $stmt = $auth_user->runQuery("UPDATE contents SET privacy=:privacy WHERE c_id='1'");     
      $stmt->execute(array(':privacy'=>$privacy));
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
    $auth_user->redirect(BASE_URL.'administrator/content-privacy?updated');
    exit();
  }
?>
<?php include(ROOT_PATH."administrator/includes/header.php") ?>
<?php include(ROOT_PATH."administrator/includes/navMenu.php") ?>        
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            <small>Dashboard / Contents / Privacy Policy</small>
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->
            <?php
                    if(isset($error)){
                        foreach($error as $error){?>
                         <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
                         </div>
                <?php } }elseif(isset($_GET['updated'])){?>
                 <div class="alert alert-success">
                    <i class="fa fa-check-square"></i> &nbsp; Content updated successfully!
                 </div>
            <?php }?>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">                
                <div class="panel-body">
                  <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div style="background: green; height: 10px; border-radius: 10px 10px 0px 0px;">
                      </div>
                      <div style="border:1px solid #CCC; min-height: 250px; padding: 30px 20px;">
                        <div class="row">

                          <form role="form" method="post" action="" style="width: 95%; margin: auto; margin-top: 30px;"
                     enctype="multipart/form-data">
                              <div class="row">
                                
                                <div class="col-md-11 col-sm-12 col-xs-12">
                                   <div class="form-group">
                                      <label for="privacy">Privacy Policy</label>
                                      <textarea class="form-control" name="privacy" id="privacy" rows="20"
                                      ><?php if(isset($privacy)){echo $privacy;}else{echo $content['privacy'];}?></textarea>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div style="margin: 0px 0px 0px 20px;">
                              <button type="submit" class="btn btn-success btn-small">
                              Update</button>
                            </div>
                          </form>

                      </div>

                    </div>
                    <br><br><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php include(ROOT_PATH."administrator/includes/footer.php") ?>