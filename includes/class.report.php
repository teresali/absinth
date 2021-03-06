<?php

class Report {
  private $groupId;
  private $projectId;
  private $title;
  private $dateSubmitted;
  private $text;

  function __construct($data) {
    $this->groupId = $data['groupId'];
    $this->projectId = $data['projectId'];
    $this->title = $data['title'];
    $this->dateSubmitted = $data['dateSubmitted'];
    $this->text = $data['textContent'];
  }

  /* Getters for fields */
  public function getGroupId() {
    return $this->groupId;
  }
  public function getProjectId() {
    return $this->projectId;
  }
  public function getTitle() {
    return $this->title;
  }

  // checks if a report exists in the database
  public function exists($db, $groupId, $projectId) {
    $q = "SELECT * FROM reports 
            WHERE groupId = {$groupId} and projectId = {$projectId}";
    $check_exists = $db->query($q);
    if($check_exists->num_rows == 1) {
      return $check_exists->fetch_assoc();
    }
    return NULL;
  }

  // adds a report to the database
  public function addReport($data, $db) {
    $date = date('Y-m-d H:i:s');
    $q = "INSERT INTO reports (groupId, projectId, title, dateSubmitted, textContent, md5) 
            VALUES ({$data['groupId']}, {$data['projectId']}, '{$data['title']}', '{$date}', '{$data['textContent']}', '{$data['md5']}')";
    $db->query($q);
  }

  // replaces an existing report if it already exists
  // does not keep previous submissions in database
  public function replaceExisting($data, $db) {
    $date = date('Y-m-d H:i:s');
    $q = "UPDATE reports
            SET title='{$data['title']}', dateSubmitted='{$date}', textContent='{$data['textContent']}', md5='{$data['md5']}'
            WHERE projectId={$data['projectId']} and groupId={$data['groupId']}";
    $db->query($q);
  }

  public function getTitleDB($db, $groupId, $projectId) {
    $q = "SELECT title from reports where groupId={$groupId} and projectId={$projectId}";
    $r = $db->query($q);
    $data = $r->fetch_assoc();
    return $data['title'];
  }
}

?>