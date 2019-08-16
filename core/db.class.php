<?php
class DB {

    private static $instance;

    private function __construct() {}

    private function __clone() {}

    /**
     * @return PDO|null
     */
    public static function getInstance() {
        $dbinfo = config['mysql'];

        if (!isset(self::$instance) && !empty($dbinfo)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO(
                'mysql:host='.$dbinfo['host'].';port='.$dbinfo['port'].';dbname='.$dbinfo['datb'].';charset=utf8',
                $dbinfo['user'],
                $dbinfo['pass'],
                $pdo_options
            );
        }
        return self::$instance;
    }

    /**
     * @param string $con
     * @param string $type
     * @return bool
     */
    static function action($con='',$type=''){
        switch($type){
            case 'rowcount':
                return $con->rowCount();
                break;
            case 'lastID':
                return self::getInstance()->lastInsertId();
                break;
            case 'rows':
                return $con->fetchAll(PDO::FETCH_ASSOC);
                break;
            case 'row':
                return $con->fetch(PDO::FETCH_ASSOC);
                break;
            case  'column':
                return  $con->fetchColumn();
                break;
            default:
                return true;
        }
    }

    /**
     * @param $query
     * @param $values
     * @param string $type
     * @return bool
     */
    public static function query($query , $values , $type = ''){
        try {
            $con = self::getInstance()->prepare($query);

            foreach($values as $key => $value) { // Add colons automatically
                if (strpos($key,':') === false) {
                    unset($values[$key]);
                    $values[':'.$key] = $value;
                }
            }

            $con->execute($values);
            return self::action($con,$type);

        } catch (PDOException $ex) {

            if(devMode){
                echo '<h1>SQL Error</h1>';
                echo '<hr>';
                echo '<h2>Query:</h2>';
                echo '<code>'.$query.'</code>';
                echo '<h2>Values:</h2>';
                echo '<pre>';
                print_r($values);
                echo '</pre>';
                echo '<h2>Message:</h2>';
                echo '<code>'.$ex->getMessage().'</code>';
                echo '<h2>Extras:</h2>';
                echo 'HOST: '.$_SERVER['HTTP_HOST'].'<br>';
                echo 'IP: '.Functions::getIP().'<br>';
                echo 'Request: '.$_SERVER['REQUEST_URI'];
            }
            die();
        }
    }

    /**
     * @param $table
     * @param $values
     * @return bool
     */
    public static function insertRow($table, $values) {
        $keys = [];
        foreach($values as $k=>$v) array_push($keys, ':'.$k);
        $vals = implode(',',$keys);
        $keys = str_replace(':','',implode(',',$keys));
        $query  = 'INSERT INTO '.$table.' ('.$keys.') VALUES ('.$vals.')';
        return self::query($query,$values,'lastID');
    }

    /**
     * @param $table
     * @param $values
     * @return bool
     */
    public static function insertRows($table, $values) {
        if(empty($values)){
            return false;
        }

        $ins = [];
        $counter = 0;
        foreach($values as $value){
            if($counter == 0){
                $keys = array_keys($value);
            }
            $vals = array_values($value);
            $vals = array_map('addslashes',$vals);

            $ins[] = '(\''.implode('\',\'',$vals).'\')';
            $counter++;
        }

        if(!empty($keys)){
            $keys = str_replace(':','',$keys);
            $query  = 'INSERT INTO '.$table.' ('.implode(',',$keys).') VALUES'.implode(',',$ins);
            return self::query($query,[],'lastID');
        } else {
            return false;
        }
    }

    /**
     * @param $table
     * @param $values
     * @param string $wherestr
     * @param array $wherevalues
     * @return bool
     */
    public static function updateRow($table, $values, $wherestr = '1', $wherevalues = []){
        $updates = [];
        $v = [];

        // Assign tokens
        foreach($values as $key => $value):
            $updates[] = $key.'=:'.$key;
            $v[':'.$key] = $value;
        endforeach;
        $updatesStr = implode(', ',$updates);

        // Add tokens to the WHERE
        foreach($wherevalues as $key => $value):
            $updates[] = $key.'=:'.$key;
            $v[':'.$key] = $value;
        endforeach;

        // Perform Query
        $query = 'UPDATE '.$table.' SET '.$updatesStr.' WHERE '.$wherestr;
        return self::query($query, $v);
    }

    /**
     * @param $tabel
     * @param $updateveld
     * @param $whereveld
     * @param $values
     * @param string $extrawhere
     * @param array $extratokens
     * @return bool
     */
    public static function updateRows($tabel, $updateveld, $whereveld, $values, $extrawhere = '', $extratokens = []){
        $query = '';
        $tokens = [];
        $udp = [];

        if(is_array($values) && count($values) > 0){
            $in = [];
            $i = 0;

            foreach($values as $k => $v){
                $i++;
                $udp[] = 'WHEN \''.$k.'\' THEN :token'.$i;
                $tokens[':token'.$i] = $v;
            }

            if(count($udp) > 0){
                $query .= 'UPDATE '.$tabel.' SET '.$updateveld.' = CASE '.$whereveld.' ';
                $query .= implode(PHP_EOL, $udp);
                $query .= ' END'.PHP_EOL;
                $query .= 'WHERE '.$whereveld.' IN(\''.implode('\',\'',array_keys($values)).'\') '.$extrawhere;
                $tokens = array_merge($tokens, $extratokens);

                return self::query($query, $tokens, 'rowcount');
            }
            return false;
        }
        return false;
    }

    /**
     * @param $table
     * @param $column
     * @param $value
     * @return bool
     */
    public static function deleteRow($table,$column,$value){
        $values = [];
        $values[':value'] = $value;

        $query = 'DELETE FROM ' . $table . ' WHERE '.$column.'=:value';
        $rowAmount = self::query($query,$values,'rowcount');

        return ( $rowAmount > 0 ) ? true : false;
    }

    /**
     * @param $table
     * @param $column
     * @param $value
     * @return bool
     */
    public static function rowExists( $table , $column , $value ){
        $query  = 'SELECT 1 FROM '.$table.' WHERE '.$column.' = :value';
        $values = [':value'  => $value];
        $check  = self::query($query,$values,'column');
        return ( !$check ) ? false : true ;
    }

}