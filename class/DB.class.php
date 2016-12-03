<?php

//DB.class.php
 
class DB {
 
    //for local
    protected $db_name = 'kianzykc_wifis';
    protected $db_user = 'kianzykc';
    protected $db_pass = 'Kian1214@';
    protected $db_host = 'localhost';
    protected $db_table = 'records';
    

    //for remote
    // protected $db_name = 'lennonzf_helpdesk';
    // protected $db_user = 'lennonzf';
    // protected $db_pass = 'BERnie69@!';
    // protected $db_host = 'localhost';

    //for remote
    // protected $db_name = 'lennonzf_helpdesk';
    // protected $db_user = 'kianzykc';
    // protected $db_pass = 'BERnie69@!';
    // protected $db_host = 'localhost';
 
    //open a connection to the database. Make sure this is called
    //on every page that needs to use the database.
    public function connect() {
        $connection = mysql_connect($this->db_host, $this->db_user, $this->db_pass);
        mysql_select_db($this->db_name);
 
        return true;
    }
 
    //takes a mysql row set and returns an associative array, where the keys
    //in the array are the column names in the row set. If singleRow is set to
    //true, then it will return a single row instead of an array of rows.
    public function processRowSet($rowSet, $singleRow=false)
    {
        $resultArray = array();
        while($row = mysql_fetch_assoc($rowSet))
        {
            array_push($resultArray, $row);
        }
 
        //if($singleRow === true)
            //return $resultArray[0];
 
        return $resultArray;
    }
 
    //Select rows from the database.
    //returns a full row or rows from $table using $where as the where clause.
    //return value is an associative array with column names as keys.
    public function select($table, $where) {
        $sql = "SELECT * FROM $table WHERE $where";
        $result = mysql_query($sql);
        //if(mysql_num_rows($result) == 1)
            //return $this->processRowSet($result, true);
 
        return $this->processRowSet($result);
    }

    //select & order by
    public function select_order($table, $where, $order) {
        $sql = "SELECT * FROM $table WHERE $where ORDER BY $order";
        $result = mysql_query($sql);
        if(mysql_num_rows($result) == 1)
            return $this->processRowSet($result, true);
 
        return $this->processRowSet($result);
    }

    //select & range & order by
    public function select_range_order($table, $start_date, $end_date, $order) {
        $sql = "SELECT * FROM $table WHERE date >= '$start_date' AND date <= '$end_date' ORDER BY $order";
        $result = mysql_query($sql);
        if(mysql_num_rows($result) == 1)
            return $this->processRowSet($result, true);
 
        return $this->processRowSet($result);
    }

    //select all the column
    public function select_all($table) {
        $sql = "SELECT * FROM $table";
        $result = mysql_query($sql);
        if(mysql_num_rows($result) == 1)
            return $this->processRowSet($result, true);
 
        return $this->processRowSet($result);
    }

    //select all the column & order by
    public function select_all_order($table, $order) {
        $sql = "SELECT * FROM $table ORDER BY $order";
        $result = mysql_query($sql);
        if(mysql_num_rows($result) == 1)
            return $this->processRowSet($result, true);
 
        return $this->processRowSet($result);
    }

    //select all the column & group by
    public function select_all_group($table, $group) {
        $sql = "SELECT * FROM $table GROUP BY $group";
        $result = mysql_query($sql);
        if(mysql_num_rows($result) == 1)
            return $this->processRowSet($result, true);
 
        return $this->processRowSet($result);
    }
 
    //Updates a current row in the database.
    //takes an array of data, where the keys in the array are the column names
    //and the values are the data that will be inserted into those columns.
    //$table is the name of the table and $where is the sql where clause.
    public function update($data, $table, $where) {
        foreach ($data as $column => $value) {
            $sql = "UPDATE $table SET $column = $value WHERE $where";
            mysql_query($sql) or die(mysql_error());
        }
        return true;
    }

    public function update_column($column, $data, $table, $where) {
            $sql = "UPDATE $table SET $column = $data WHERE $where";
            mysql_query($sql) or die(mysql_error());
        return true;
    }
 
    //Inserts a new row into the database.
    //takes an array of data, where the keys in the array are the column names
    //and the values are the data that will be inserted into those columns.
    //$table is the name of the table.
    public function insert($data, $table) {
 
        $columns = "";
        $values = "";
 
        foreach ($data as $column => $value) {
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= $column;
            $values .= ($values == "") ? "" : ", ";
            $values .= $value;
        }
 
        $sql = "insert into $table ($columns) values ($values)";
 
        mysql_query($sql) or die(mysql_error());
 
        //return the ID of the user in the database.
        return mysql_insert_id();
 
    }


    public function delete($table, $where){
        $sql = "DELETE FROM $table WHERE $where";
        $result = mysql_query($sql);
 
        return true;
    }


    ////////////calculation/////////////
    //sum of a column
    public function sum($table, $column, $where) {
        $sql = "SELECT sum($column) AS sum FROM $table WHERE $where";
        $result = mysql_query($sql);
        $row = mysql_fetch_assoc($result); 
        return $row['sum'];
    }

    //sum of a week with a start date and end date
    public function sum_date($table, $start_date, $end_date){
        $range_date = $this->sum($table, 'value', 'date >= "'.$start_date.'" AND date <= "'.$end_date.'"');
        return round($range_date, 2);
    }
    

    //sum of a week with a start date and end date + condition
    /*public function sum_date_condition($table, $start_date, $end_date, $condition){
        $range_date = $this->sum($table, 'value', 'date >= '.$start_date.' AND date <= '.$end_date.' AND '.$condition.'');
        return round($range_date, 2);
    }*/

    public function sum_date_condition($table, $column, $start_date, $end_date, $condition){
        $sql = "SELECT sum($column) AS sum FROM $table WHERE date >= '$start_date' AND date <= '$end_date' AND $condition ";
        $result = mysql_query($sql);
        $row = mysql_fetch_assoc($result); 
        return round($row['sum'], 2);
    }
 
}
?>