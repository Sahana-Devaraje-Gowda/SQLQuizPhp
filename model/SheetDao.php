<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SheetDao
 *
 * @author Stéphane
 */
include_once 'DB.php';

class SheetDao {

  /**
   * 
   * @param type $trainee_id id of the trainee
   * @param type $eval_id id of the evaluation
   * @return type $ok return 1 if the update was succefull
   */
  public static function start($trainee_id, $eval_id) {
    $db = DB::getConnection();
    $sql = "update sheet set started_at=now() where evaluation_id=:eval_id and trainee_id=:trainee_id and started_at is null";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":eval_id", $eval_id);
    $stmt->bindValue(":trainee_id", $trainee_id);
    $ok = $stmt->execute();
    $db = null;
    return $ok;
  }

  /**
   * 
   * @param type $trainee_id id of the trainee
   * @param type $eval_id id of the evaluation
   * @return type return a sheet if the interrogation request was succefull
   */
  public static function get($trainee_id, $eval_id) {
    $db = DB::getConnection();
    $sql = "select sql_question.question_id,question_text,answer from sql_question natural join sheet_answer where trainee_id=:trainee_id and evaluation_id=:eval_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":eval_id", $eval_id);
    $stmt->bindValue(":trainee_id", $trainee_id);
    $stmt->execute();
    $db = null;
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * 
   * @param int $trainee_id  id of the trainee
   * @param int $eval_id id of the evaluation
   * @param int $question_id id of the question
   * @param String $answer answer of the question give by the trainee
   * @return int $ok return if the update request was succefull
   */
  public static function updateAnswer($trainee_id, $eval_id, $question_id, $answer) {
    $db = DB::getConnection();
    $sql = "update sheet_answer set answer=:answer,given_at=now() where evaluation_id=:eval_id and trainee_id=:trainee_id and question_id=:question_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":eval_id", $eval_id);
    $stmt->bindValue(":trainee_id", $trainee_id);
    $stmt->bindValue(":question_id", $question_id);
    $stmt->bindValue(":answer", $answer);
    $ok = $stmt->execute();
    $db = null;
    return $ok;
  }


  /**
   * 
   * @param int $trainee_id id of the trainee
   * @param int $eval_id id of the evaluation
   * @return int $ok return if the update request was succefull
   */
  public static function setCompleted($trainee_id, $eval_id) {
    $db = DB::getConnection();
    $sql = "update sheet set ended_at=now() where evaluation_id=:eval_id and trainee_id=:trainee_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":eval_id", $eval_id);
    $stmt->bindValue(":trainee_id", $trainee_id);
    $ok = $stmt->execute();
    $db = null;
    return $ok;
  }
  
  
  //Get all the question text and its id as to diplay all questions in a set 5.1(The complete set of questions is displayed. )
// but in 5.2(Each question displays the question text, at left the student query and below its result, at right the trainer query and below its result.)
//so we have to use the question id to get [student query result] and its corresponding [trainer query result]
//Hence we hav the next function getAnswersForTheQuestionByTrainee($question_id)

//
//Please comment on this new functions getAllQuestions() & getAnswersForTheQuestionByTrainee() if you think its not right.
//

public static function getAllQuestions() {
  $db = DB::getConnection();
  $sql = "SELECT question_id , question_text FROM sql_question";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $db = null;
  $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $list;
}


//Here by joining sql_question and sheet_answer
// on question_id(common)
//based on the  each question id we will get answer(student/trainee) and gives_correct_result
//this function will be iterated based on each question_id
public static function getAnswersForTheQuestionByTrainee($question_id)
{
  $db = DB::getConnection();
  $sql = "SELECT * FROM sheet_answer sa JOIN sql_question sqla ON sa.question_id=sqla.question_id WHERE sa.question_id=:question_id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":question_id", $question_id);
  $stmt->execute();
  $db = null;
  $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $list;
}

}
