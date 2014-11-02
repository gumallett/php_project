<?php

namespace phporm;

abstract class Record implements Identifiable {

   public function __construct() {

   }

   public final function save() {
      $dao = DAO::get();
      $dao->save($this);
   }

   public final function save_() {
      $dao = DAO::get();
      $dao->save_($this);
   }

   public final function delete() {
      static::deleteAll('id=:id', array('id' => $this->getId()));
   }

   public static final function find($where = null, $args = null) {
      $dao = DAO::get();
      return $dao->find(static::$__CLASS__, $where, $args);
   }

   public static final function findAll($where = null, $args = null) {
      $dao = DAO::get();
      return $dao->findAll(static::$__CLASS__, $where, $args);
   }

   public static final function query($sql, $args = null) {
      $dao = DAO::get();
      $result = $dao->executeQuery($sql, $args);
      $results = array();

      while($obj = $result->fetch_object(static::$__CLASS__)) {
         $model = new TableModel($obj);
         $obj = $model->fetchEager();
         $results[] = $obj;
      }

      return $results;
   }

   public static final function count($where = null, $args = null) {
      $dao = DAO::get();
      return $dao->count(static::$__CLASS__, $where, $args);
   }

   public static final function deleteAll($where = null, $args = null) {
      $dao = DAO::get();
      $dao->delete(static::$__CLASS__, $where, $args);
   }
}