<?php
/**
 * System de benchmark
 *
 * @category backoffice
 * @package backoffice_controllers
 * @copyright RCWEB
 */

class BenchmarkController extends App_Backoffice_Controller
{
    /**
     * Overrides Zend_Controller_Action::init()
     *
     * @access public
     * @return void
     */
    public function init(){
        // init the parent
        parent::init();
    }

    /**
     * Index des benchmark
     *
     * @access public
     * @return void
     */
    public function indexAction(){

    }


    /**
     * Benchmark 1
     *
     * @access public
     * @return void
     */
    public function benchmark1Action(){
        $benchmark = App_Benchmark::run(false);
        $this->view->benchmark = $benchmark;
    }

    /**
     * Benchmark 2
     *
     * @access public
     * @return void
     */
    public function benchmark2Action(){
        $iterations = 15;
        if(isset($_SERVER['PHP_SELF'])) $PHP_SELF = $_SERVER['PHP_SELF'];
        $starttime = explode(' ', microtime());
        $string1 = 'abcdefghij';

        for($i = 1; $i <= 20000; $i++)
        {
            $x=$i * 5;
            $x=$x + $x;
            $x=$x/10;
            $string3 = $string1 . strrev($string1);
            $string2 = substr($string1, 9, 1) . substr($string1, 0, 9);
            $string1 = $string2;
        }

        $endtime = explode(' ', microtime());
        $total_time = $endtime[0] + $endtime[1] - ($starttime[1] + $starttime[0]);
        $total_time = round($total_time * 1000);

        ###################################################

        if(isset($_GET['test'])){
            $test = $_GET['test'];
        }else{
            $test = "";
        }
        $test = (int)$test;
        if(empty($test)) $test=0;

        if(isset($_GET['ttimes']))
        {
            $ttimes = $_GET['ttimes'];
            if($test>0 AND empty($ttimes)) { echo 'error'; die; }
            $itimes = explode('_', $ttimes);
            if(count($itimes)<$test)  { echo 'error 2'; die; }
        }

        $itimes[$test] = number_format($total_time,0);
        $test_results = '';
        $ttimes2 = '';
        $TimesSum=0;

        for($i = 0; $i <= $test; $i++)
        {
            $itimes[$i] = (int)$itimes[$i];
            $TimesSum += $itimes[$i];
            $j=$i+1;
            $test_results .=  'Test #' . $j . ' completed in ' . $itimes[$i] . ' ms.<br>';
            $ttimes2 .= $itimes[$i];
            if($i < $test) $ttimes2 .= '_';
        }

        $test2 = $test+1;
        $tquery = 'test=' . $test2 . '&ttimes=' . $ttimes2;
        $tquery2 = $tquery . '&stop=1;';
        $AverageAll = round($TimesSum/$test2);
        $iterations2 = $iterations-1;
        sort($itimes);
        $lowest = $itimes[0];
        $highest = $itimes[$test];
        if(isset($_GET['stop'])) $stop = $_GET['stop'];
        if(isset($stop)) $test = $iterations;

        if($test<$iterations2){
            //echo '<META HTTP-EQUIV="REFRESH" CONTENT="5; URL=' . $this->view->url() . '?' . $tquery . '">';
            $this->view->headMeta()->appendHttpEquiv('Refresh',
                    '5;URL='.$this->view->url()."?".$tquery);
        }

        $this->view->test_results = $test_results;
        $this->view->lowest = $lowest;
        $this->view->highest = $highest;
        $this->view->j = $j;
        $this->view->AverageAll = $AverageAll;
        $this->view->test2 = $test2;
        $this->view->PHP_SELF = $PHP_SELF;
        $this->view->iterations = $iterations;
        $this->view->iterations2 = $iterations2;
        $this->view->test = $test;
        $this->view->tquery2 = $tquery2;
        $this->view->TimesSum = $TimesSum;
    }


    /**
     * Benchmark BDD
     *
     * @access public
     * @return void
     */
    public function benchmarkBddAction(){
        $timer = new Timer(1);
        $mysqli = mysqli_connect("localhost","root","", "test") or die ("could not connect to mysql");
        echo  "Db connection established  at  : " . $timer->get() . "<br \> " ;
        // Create an sql command structure for creating a table
        $tableCreate = "CREATE TABLE IF NOT EXISTS test_tbl (
                                          id int(11) NOT NULL auto_increment ,
                                          RandomTxt TEXT ,
                                          PRIMARY KEY (id)
                                          ) ";
        // This line uses the mysqli_query() function to create the table now
        $queryResult = mysqli_query($mysqli , $tableCreate);
        echo  "Table created at  : " . $timer->get() . "<br \> " ;
        // Create a conditional to see if the query executed successfully or not
        if ($queryResult === TRUE) {
            for ($i = 1; $i <= 1000; $i++) {
                mysqli_query($mysqli ,
                "INSERT INTO Test_tbl (RandomTxt) VALUES ('abcdefghklmnopqrsst')" )  ;
            }
        } else {
            print "<br /><br />No TABLE created. Check";
        }
        echo  "Data inserted into the table at  : " . $timer->get() . "<br \> " ;
        $result = mysqli_query($mysqli , 'SELECT * FROM Test_tbl') ;
        $arrayResults = array() ;
        while ($row = $result->fetch_assoc()) {
            array_push($arrayResults , $row['RandomTxt']);     }
            echo "Data is read from table and inserted into an array at  : ". $timer->get() . "
 " ;
            //print_r($arrayResults) ;
    }

}