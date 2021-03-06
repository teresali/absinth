<?php
  include('header.php');

  // needed fields for calculations
  $DB = Database::Instance();
  $projectId = $_GET['projectId'];
  $groupId = $_GET['groupId'];
  $project = Project::exists($DB, $projectId);
  $curr = new Project($project);

  // on submit upload the report
  if(isset($_POST['submit'])) {
    $errors = '';
    $title = $DB->escape_string(htmlentities(trim($_POST['title'])));
    $file = $_FILES['uploadedReport']['tmp_name'];
    $filename = $_FILES['uploadedReport']['name'];

    // both file and pasted text
    if(file_exists($file) && $_POST['pastedText']) {
      $errors = 'Unable to both upload file and paste contents. Please fix!';
    // file upload
    } elseif($_FILES['uploadedReport']['error'] == UPLOAD_ERR_OK && is_uploaded_file($file)) {
      if(strpos($filename, '.xml') == false) {
        $textContent = $DB->escape_string(htmlentities(trim(file_get_contents($file)))); 
      } else {
        // loads an xml file into the database
        $xml = simplexml_load_file($file);
        $title = $xml->title;
        $textContent = $xml->body;
      }
      $md5 = md5_file($_FILES['uploadedReport']['tmp_name']);
    // pasted text
    } elseif($_POST['pastedText']) {
      $textContent = $_POST['pastedText'];
      $md5 = 'None';
    // no input
    } else {
      $errors = 'No file or pasted text was entered. Please fix!';
    }

    // if no title is given then use filename or 'No Title'
    if($title == '') {
      if($filename != '') {
        $title = $filename;
      } else {
        $title = 'No Title';
      }
    }

    // // process submission if there are no errors
    if($errors == '') {
      $data = array(
        'groupId'       => $groupId,
        'projectId'     => $projectId,
        'title'         => $title,
        'textContent'   => $textContent,
        'md5'           => $md5
      );
      // check if group has already submitted a report for a project
      if(Report::exists($DB, $groupId, $projectId) != NULL) {
        Report::replaceExisting($data, $DB);
      } else {
        Report::addReport($data, $DB);
      }
    }
  }

?>

  <div id="page-wrapper" >
    <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <h3 class="page-header">
          <?php echo $curr->getTitle(); ?>     
        </h3>
      </div>
    </div> 
   <!-- /. ROW  -->
  <div class="row">
    <div class="col-lg-12">
      <div class="col-lg-6">
        <div class="panel panel-default no-boder">
          <div class="panel-heading">
            Summary
          </div>
          <div class="panel-body" style="height: 230px;">
            <table class="table borderless" id="borderless">
              <tbody>
                <tr>
                  <td class="col-md-3">Description:</td>
                  <td class="col-md-9"><?php echo $curr->getDescription(); ?></td>
                </tr>
                <tr>
                  <td class="col-md-3">Due Date:</td>
                  <td class="col-md-9"><?php echo $curr->getDueDate(); ?></td>
                </tr>
                <tr>
                  <td class="col-md-3">Group Members:</td>
                  <td class="col-md-9"><?php echo User::getGroupMembers($DB, $groupId, $projectId); ?></td>
                </tr>
                <tr>
                  <td class="col-md-4">Late Submissions:</td>
                  <td class="col-md-8">Not Accepted</td>
                </tr>
                <tr>
                  <td class="col-md-4">Regrades:</td>
                  <td class="col-md-8">No online regrades</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /. panel-body -->
        </div>
        <!-- /. panel -->
      </div>
      <!-- /. col-lg-6 -->

      <div class="col-lg-6">
        <div class="panel panel-default no-boder">
          <div class="panel-heading">
            Average Scores from Peer Assessments
            <div class="pull-right">
              <a href='<?php echo "view-assessments.php?projectId={$projectId}&groupId={$groupId}" ?>'>View Assessments</a>
            </div>
          </div>
          <div class="panel-body" style="height: 230px;">
            <table class="table borderless" id="borderless">
              <tbody>
                <tr>
                  <td class="col-md-5"><?php 
                    $scores = Project::getScoreForUser($DB, $projectId, $groupId);
                    echo $curr->getCriteria()[0]; ?></td>
                  <td class="col-md-7"><?php echo $scores['s1']?></td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $curr->getCriteria()[1]; ?></td>
                  <td class="col-md-7"><?php echo $scores['s2']?></td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $curr->getCriteria()[2]; ?></td>
                  <td class="col-md-7"><?php echo $scores['s3']?></td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $curr->getCriteria()[3]; ?></td>
                  <td class="col-md-7"><?php echo $scores['s4']?></td>
                </tr>
                <tr>
                  <td class="col-md-5"><?php echo $curr->getCriteria()[4]; ?></td>
                  <td class="col-md-7"><?php echo $scores['s5']?></td>
                </tr>
                <tr>
                  <td class="col-md-5"><strong>Overall</strong></td>
                  <td class="col-md-7"><?php echo $scores['total']?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /. panel-body -->
        </div>
        <!-- /. panel -->
      </div>
      <!-- /. col-lg-6 -->
    </div>
    <!-- /. col-lg-12 -->
  </div> 
  <!-- /. ROW -->

  <div class="col-lg-12">
      <div class="panel panel-default no-boder">
        <div class="panel-heading">
            Statistics
        </div>
        <div class="panel-body">
          <div class="col-lg-6">
          <table class="table borderless" id="borderless">
            <thead>
              <tr>
                <th class="col-md-2">Mean</th>
                <th class="col-md-2">Standard Dev</th>
                <th class="col-md-3">Aggregated Rank</th>
              </tr>
          </thead>
            <tbody>
              <tr>
                <td><?php echo Project::calculateMean($DB, $projectId); ?></td>
                <td><?php echo Project::calculateStdDev($DB, $projectId); ?></td>
                <td>
                  <?php 
                    $rank = Project::getRankForUser($DB, $projectId, $groupId);
                    if($rank != NULL) {
                      echo "{$rank[0]} out of {$rank[1]} groups";
                    } else {
                      echo "Not Available";
                    }
                  ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>
      </div>
  </div>

  <?php 
    $report = Report::exists($DB, $groupId, $projectId);
    // if submission has already been made then show details
    if($report != NULL) {
  ?>
    <div id="submissions" class="col-lg-12">
      <div class="panel panel-default no-boder">
        <div class="panel-heading">
          Submission
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered">
            <thead>
                <tr>
                  <th class="col-md-2">Submitted</th>
                  <th class="col-md-2">Date</th>
                  <th class="col-md-3">MD5</th>
                </tr>
            </thead>
            <tbody>
              <?php
                echo "<tr>";
                echo "<td>{$report['title']}<button class='report-button report-icon-right' data-toggle='modal' data-target='#submission'><i class='fa fa-file-text'></i></button></td>";
                echo "<td>{$report['dateSubmitted']}</td>";
                echo "<td>{$report['md5']}</td>";
                echo "</tr>";

                echo "<div class='modal fade' id='submission' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                              <h4 class='modal-title' id='myModalLabel'>{$report['title']}</h4>
                            </div>
                            <div class='modal-body'>
                              {$report['textContent']}
                            </div>
                            
                          </div>
                        </div>
                      </div>";
?>
            </tbody>
          </table>
        </div>
          <!-- /. panel-body -->
      </div>
      <!-- /. panel -->
    </div>
    <!-- /. col-lg-12 -->

  <?php } 

    $now = new DateTime();
    $dueDate = new DateTime($curr->getDueDate());
    $interval = $now->diff($dueDate);
    $diff = (int)$interval->format('%r%a');
    if($diff < 0) {
      echo "
        <div id='file-submit' class='col-lg-12'>
          <div class='panel panel-default no-boder'>
            <div class='panel-heading errors'>
                Submission Closed
            </div>
          </div>
        </div>
      ";
    }
    // if not overdue then show file submission form
    else {
  ?>

      <div id="file-submit" class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            File Submission
            <span class="errors"> <?php if($errors) { echo "- ".$errors; } ?></span>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']."?projectId={$projectId}&groupId={$groupId}#submissions" ?>" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Report Title</label>
                  <input class="form-control" name="title">
                </div>
                <div class="form-group">
                  <label>Upload Text or XML File</label>
                  <input type="file" name="uploadedReport">
                </div>
                <div class="form-group">
                  <label>Or Paste File Contents Here</label>
                  <textarea class="form-control" rows="10" name="pastedText"></textarea>
                </div>
                <button type="submit" class="btn btn-default btn-primary" name="submit">Submit</button>
              </form>
          </div>            
        </div>
        <!-- /.row (nested) -->
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
  </div>
  <!-- /.col-lg-12 -->

  <?php } ?>

</div>

</div>
<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php include('footer.php'); ?>

