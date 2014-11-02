<?php

namespace phporm;
/**
 * Simple logging
 */
final class Logger {

   public static function log($message) {
      if(is_array($message)) {
         $msg = "Keys: " . implode(', ', array_keys($message));
         $msg .= " Values: " . implode(', ', array_values($message));
         $message = $msg;
      }

      file_put_contents("php://stderr", $message."\n");
   }
}
