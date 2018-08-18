<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PDOConnection
 *
 * @author bbchsoluciones
 */
class PDOConnection {
    /**
     * singleton instance
     * 
     * @var PDOConnection 
     */
    protected static $_instance = null;
    /**
     * Returns singleton instance of PDOConnection
     * 
     * @return PDOConnection 
     */
    public static function instance() {
        
        if ( !isset( self::$_instance ) ) {
            
            self::$_instance = new PDOConnection();
            
        }
        
        return self::$_instance;
    }
    
    /**
     * Hide constructor, protected so only subclasses and self can use
     */
    protected function __construct() {}
    
    function __destruct(){}
    
    /**
     * Return a PDO connection using the dsn and credentials provided
     * 
     * @param string $dsn The DSN to the database
     * @param string $username Database username
     * @param string $password Database password
     * @return PDO connection to the database
     * @throws PDOException
     * @throws Exception
     */
    public function getConnection() {
        
        $dsn="mysql:dbname=sindicatouno;host=localhost";
        $username="root";
        $password="";
        
        $conn = null;
        try {
            
            $conn = new \PDO($dsn, $username, $password);
            
            //Set common attributes
			$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
            
            return $conn;
            
        } catch (PDOException $e) {
            
            //TODO: flag to disable errors?
            throw $e;
            
        }
        catch(Exception $e) {
            
            //TODO: flag to disable errors?
            throw $e;
            
        }
    }
    
    /** PHP seems to need these stubbed to ensure true singleton **/
    public function __clone()
    {
        return false;
    }
    public function __wakeup()
    {
        return false;
    }
    
    
}