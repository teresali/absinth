<?php 

class Assessment{

  // checks if an assessment exists in the database
  public function exists($db, $groupId, $groupToAssess, $projectId) {
    $q = "SELECT * from assessments where groupId={$groupId} and groupAssessed={$groupToAssess} and projectId={$projectId}";
    $r = $db->query($q);

    if($r->num_rows == 1) {
      return $r->fetch_assoc();
    } else {
      return NULL;
    }
  }

  // checks if an assessment has been completed or not
  // returns the assessment 
  public function isCompleted($db, $groupId, $groupToAssess, $projectId) {
    $q = "SELECT * from assessments where groupId={$groupId} and groupAssessed={$groupToAssess} and projectId={$projectId}";
    $r = $db->query($q);

    if($r->num_rows > 0) {
      return $r->fetch_assoc();
    } else {
      return NULL;
    }
  }

  // adds an assessment to the database
  public function addAssessment($db, $data) {
    $date = date('Y-m-d H:i:s');
    $q = "INSERT INTO assessments VALUES ({$data['groupId']}, {$data['groupAssessed']}, {$data['projectId']}, '{$date}', {$data['score1']}, {$data['score2']}, {$data['score3']}, {$data['score4']}, {$data['score5']}, '{$data['comments']}')";
    $db->query($q);
  }

  // replaces an existing assessment if the user decides to edit it
  public function replaceExisting($db, $data) {
    $date = date('Y-m-d H:i:s');
    $q = "UPDATE assessments
            SET dateAssessed='{$date}', score1={$data['score1']}, score2={$data['score2']}, score3={$data['score3']}, score4={$data['score4']}, score5={$data['score5']}, comments='{$data['comments']}'
            WHERE groupId={$data['groupId']} and groupAssessed={$data['groupAssessed']} and projectId={$data['projectId']}";
    $db->query($q);
  }

  // used to determine the type of score and color of the panel header
  public function scoreType($mean, $std, $val) {
    // good score
    if($val > $mean + $std) {
      return 0;
    // below average score
    } else if ($val < $mean - $std) {
      return 2;
    // average score
    } else {
      return 1;
    }
  }
}

?>