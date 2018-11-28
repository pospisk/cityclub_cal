<?php
// gets included in class-cityclub_cal.php

class Calendar {
    /**
     * Constructor
     */
    public function __constructor(){
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }

    /********************* PROPERTY ********************/
    private $dayLabels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");

    private $currentYear=0;

    private $currentMonth=0;

    private $currentDay=0;

    private $currentDate=null;

    private $daysInMonth=0;

    private $naviHref= null;

    /********************* PUBLIC **********************/

    /**
     * print out the calendar
     */
    public function show() {
        $calYear  = null;

        $calMonth = null;

        if(null==$calYear&&isset($_GET['calYear'])){

            $calYear = $_GET['calYear'];

        }else if(null==$calYear){

            $calYear = date("Y",time());

        }

        if(null==$calMonth&&isset($_GET['calMonth'])){

            $calMonth = $_GET['calMonth'];

        }else if(null==$calMonth){

            $calMonth = date("m",time());

        }

        $this->currentYear=$calYear;

        $this->currentMonth=$calMonth;

        $this->daysInMonth=$this->_daysInMonth($calMonth,$calYear);

        $content='<div id="calendar">'.
            '<div class="box">'.
            $this->_createNavi().
            '</div>'.
            '<div class="box-content">'.
            '<ul class="label">'.$this->_createLabels().'</ul>';
        $content.='<div class="clear"></div>';
        $content.='<ul class="dates">';

        $weeksInMonth = $this->_weeksInMonth($calMonth,$calYear);
        // Create weeks in a calMonth
        for( $i=0; $i<$weeksInMonth; $i++ ){

            //Create days in a week
            for($j=1;$j<=7;$j++){
                $content.=$this->_showDay($i*7+$j);
            }
        }

        $content.='</ul>';

        $content.='<div class="clear"></div>';

        $content.='</div>';

        $content.='</div>';
        return $content;
    }

    /********************* PRIVATE **********************/
    /**
     * create the li element for ul
     */
    private function _showDay($cellNumber){

        if($this->currentDay==0){

            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));

            if(intval($cellNumber) == intval($firstDayOfTheWeek)){

                $this->currentDay=1;

            }
        }

        if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){

            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));

            $cellContent = $this->currentDay;

            $this->currentDay++;

        }else{

            $this->currentDate =null;

            $cellContent=null;
        }


        return '<li id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
            ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
    }

    /**
     * create navigation
     */
    private function _createNavi(){

        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;

        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;

        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;

        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;

        return
            '<div class="header">'.
            '<a class="prev" href="'.$this->naviHref.'?calMonth='.sprintf('%02d',$preMonth).'&calYear='.$preYear.'">Prev</a>'.
            '<span class="title">'.date('Y F',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
            '<a class="next" href="'.$this->naviHref.'?calMonth='.sprintf("%02d", $nextMonth).'&calYear='.$nextYear.'">Next</a>'.
            '</div>';
    }

    /**
     * create calendar week labels
     */
    private function _createLabels(){

        $content='';

        foreach($this->dayLabels as $index=>$label){

            $content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';

        }

        return $content;
    }



    /**
     * calculate number of weeks in a particular calMonth
     */
    private function _weeksInMonth($calMonth=null,$calYear=null){

        if( null==($calYear) ) {
            $calYear =  date("Y",time());
        }

        if(null==($calMonth)) {
            $calMonth = date("m",time());
        }

// find number of days in this calMonth
        $daysInMonths = $this->_daysInMonth($calMonth,$calYear);

        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);

        $calMonthEndingDay= date('N',strtotime($calYear.'-'.$calMonth.'-'.$daysInMonths));

        $calMonthStartDay = date('N',strtotime($calYear.'-'.$calMonth.'-01'));

        if($calMonthEndingDay<$calMonthStartDay){

            $numOfweeks++;

        }

        return $numOfweeks;
    }

    /**
     * calculate number of days in a particular calMonth
     */
    private function _daysInMonth($calMonth=null,$calYear=null){

        if(null==($calYear))
            $calYear =  date("Y",time());

        if(null==($calMonth))
            $calMonth = date("m",time());

        return date('t',strtotime($calYear.'-'.$calMonth.'-01'));
    }
}

?>