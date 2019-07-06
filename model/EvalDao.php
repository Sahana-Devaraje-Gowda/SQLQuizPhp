<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EvalDao
 *
 * @author Stéphane
 */
include_once 'DB.php';

class EvalDao {

  /**
   * 
   * @param type $groups_id list of group's id where the trainee registered
   * @return Array $list list of group's evaluation  
   */
  public static function getEvaluationsGroup($groups_id) {
    $db = DB::getConnection();
    $sql = "select * from evaluation natural join sql_quiz where group_id=:groups_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":groups_id", $groups_id);
    $stmt->execute();
    $db = null;
    $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $list;
  }

  /**
   * 
   * @param int $trainee_id id of a trainee
   * @return $list return a list of evaluations for a trainee
   */
  public static function getEvaluationsTrainee($trainee_id) {
    $db = DB::getConnection();
    $sql = "select evaluation_id,title,scheduled_at,ending_at,corrected_at,timediff(ending_at,scheduled_at) as time_diff from sql_quiz natural join evaluation natural join usergroup natural join group_member where person_id=:person_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":person_id", $trainee_id);
    $stmt->execute();
    $db = null;
    $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $list;
  }

    /**
   * 
   * @param int $quiz_id id of a quiz
   * @return $list return a list of evaluations for a trainee
   */
  public static function getQuestions($quiz_id) {
    $db = DB::getConnection();
    $sql = "SELECT * FROM sql_question sqn JOIN sql_quiz_question sqz ON sqz.question_id=sqn.question_id\n WHERE sqz.quiz_id=:quiz_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":quiz_id", $quiz_id);
    $stmt->execute();
    $db = null;
    $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $list;
  }

  /**
   * 
   * @param int $trainer_id id of a trainer
   * @return $list return a list of evaluations by a trainer
   */
  public static function getEvaluationsOfTrainer($trainer_id) {
    $db = DB::getConnection();
    $sql = "SELECT * FROM evaluation e JOIN usergroup u ON e.group_id = u.group_id JOIN sql_quiz sq ON sq.quiz_id=e.quiz_id WHERE u.creator_id =:trainer_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":trainer_id", $trainer_id);
    $stmt->execute();
    $db = null;
    $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $list;
  }

  
  /**
   * 
   * @param int $trainee_id id of a trainer
   * @return $list return a list of evaluations by a trainer
   */
  public static function getTraineeDetails($trainee_id) {
    $db = DB::getConnection();
    $sql = "SELECT person_id, name, first_name from person where person_id=:trainee_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":trainee_id", $trainee_id);
    $stmt->execute();
    $db = null;
    $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $list;
  }

/**
   * 
   * @param int $evaluation_id id of a trainer
   * @return $list return a list of evaluations by a trainer
   */
  public static function getDetailOfEvaluation($evaluation_id) {
    $db = DB::getConnection();
    $sql = "";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":evaluation_id", $evaluation_id);
    $stmt->execute();
    $db = null;
    $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($list);
    return $list;
  }

  /**
   * @param array $evaluations list of all evaluations of a trainee
   * @return array $filtred  list of filtred evaluations
   */
  public static function getFilteredTrainee($evaluations) {
    $coming = array();
    $finished = array();
    $corrected = array();
    $filtred = array();
    foreach ($evaluations as &$evaluation) {

      $now = new DateTime("now");
      $scheluded_at = new DateTime($evaluation["scheduled_at"]);
      $ending_at = new DateTime($evaluation["ending_at"]);
      $corrected_at = null;
      if ($evaluation["corrected_at"] != null) {
        $corrected_at = new DateTime($evaluation["corrected_at"]);
      }
      if ($scheluded_at >= $now && $ending_at >= $now) {
        array_push($coming, $evaluation);
      }
      if ($corrected_at == null && $ending_at <= $now) {
        array_push($finished, $evaluation);
      }
      if ($corrected_at != null && $ending_at <= $now) {
        array_push($corrected, $evaluation);
      }
    }
    $filtred = array("coming" => $coming, "finished" => $finished, "corrected" => $corrected);
    return $filtred;
  }

}
