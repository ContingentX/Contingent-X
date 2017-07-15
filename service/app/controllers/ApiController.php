<?php

/**
 * Created by Wikibyte.org
 * User: McCouman
 * Date: 28.05.16
 * Time: 16:23
 */
class ApiController extends Controller {

    /**
     * Liest User Daten über Angabe der mail-address aus
     */
    function userContingentAsJson() {

        //Endpoint: api/user/times
        $myName = $_GET[ 'name' ];

        $time = new Time( $this->db );
        $Y = $time->getTimeDB( $myName )[ "year" ];
        $m = $time->getTimeDB( $myName )[ "month" ];
        $d = $time->getTimeDB( $myName )[ "day" ];
        $H = $time->getTimeDB( $myName )[ "hour" ];
        $i = $time->getTimeDB( $myName )[ "min" ];
        $s = $time->getTimeDB( $myName )[ "sec" ];

        $this->f3->set( 'startDate', date( "Y/m/d H:i:s" ) );// 2016/12/25 12:30:00
        $this->f3->set( 'endTimer1',
            $Y . '/' . $m . '/' . $d . ' ' . $H . ':' . $i . ':' . $s
        );
        $this->f3->set( 'endTimer2',
            $m . ' ' . $d . ',' . $Y . ' ' . $H . ':' . $i . ':' . $s // 06 28, 2016 03:59:00
        );

        //https://github.com/AlexisTM/Simple-Json-PHP
        echo header( "Content-Type: application/json;charset=utf-8" );
        $return_array = array(
            "user" => array(
                "endDate"   => array(
                    "full"  => $this->f3->get( 'endTimer1' ),
                    "year"  => $Y,
                    "month" => $m,
                    "day"   => $d,
                    "hour"  => $H,
                    "min"   => $i,
                    "sec"   => $s
                )
            )
        );
        echo json_encode( $return_array );
    }
}