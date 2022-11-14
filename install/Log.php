<?php

class Log
{
  private string $filename;
  
  public function __construct()
  {
    $this->filename = date('Y-m-d H:i:s') . ".log";
  }
  
  public function writeLog(string $text)
  {
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($this->filename, "$timestamp\n" . $text . "\n\n", FILE_APPEND);
  }
}
