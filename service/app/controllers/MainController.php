<?php
/**
 * Controller of the main dashboard view sample applicaiton (dashboard.htm)
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Fat-Free-PHP-Bootstrap-Site
 * @author   Mark Takacs <takacsmark@takacsmark.com>
 * @license  MIT
 * @link     takacsmark.com
 */

/**
 * Controller class
 *
 * @category PHP
 * @package  Fat-Free-PHP-Bootstrap-Site
 * @author   Mark Takacs <takacsmark@takacsmark.com>
 * @license  MIT
 * @link     takacsmark.com
 */
class MainController extends Controller {
    /**
     * Renders the dashboard view template
     *
     * @return void
     */
    function render() {
        //user table
        $users = new User( $this->db );
        $this->f3->set( 'users', $users->all() );

        //Benutzerangaben
        $myName = $this->f3->get( 'SESSION.user' );
        $this->f3->set( 'myID', $users->getUserDB( $myName )[ "id" ] );
        $this->f3->set( 'myName', $myName );
        $this->f3->set( 'myPassword', $users->getUserDB( $myName )[ 'password' ] );
        $this->f3->set( '_rights', $users->getUserDB( $myName )[ 'group' ] );

        #Siehe auch http://www.jqueryscript.net/time-clock/Minimal-jQuery-Any-Date-Countdown-Timer-Plugin-countdown.html
        $start_time_o = date( "M d, Y H:i:s" );
        $hours = date( "H" );
        switch ( $hours )
        {
            case 0:
                $give_hourse = 12;
                break;
            case 1 or 23:
                $give_hourse = 11;
                break;
            case 2 or 22:
                $give_hourse = 10;
                break;
            case 3 or 21:
                $give_hourse = 9;
                break;
            case 4 or 20:
                $give_hourse = 8;
                break;
            case 5 or 19:
                $give_hourse = 7;
                break;
            case 6 or 18:
                $give_hourse = 6;
                break;
            case 7 or 17:
                $give_hourse = 5;
                break;
            case 8 or 16:
                $give_hourse = 4;
                break;
            case 9 or 15:
                $give_hourse = 3;
                break;
            case 10 or 14:
                $give_hourse = 2;
                break;
            case 11 or 13:
                $give_hourse = 1;
                break;
            case 12:
                $give_hourse = 0;
                break;
        }
        #$give_hourse = 0;
        $give_year = '+1 year';
        $saveTime = date( 'M d, Y H:i:s',
            strtotime( $give_year . ' +' . $give_hourse . ' hours', strtotime( $start_time_o ) )
        );

        //Passwort erstellen
        #echo password_hash("B-Secqw34+Z", PASSWORD_DEFAULT);

        //data-time
        $jsonfile = file_get_contents( 'http://'.$_SERVER["HTTP_HOST"].'/api/user/times?name=' . $myName );
        $aUT = json_decode( $jsonfile, true );

        $Y = $aUT [ "user" ][ "endDate" ][ "year" ];
        $m = $aUT [ "user" ][ "endDate" ][ "month" ];
        $d = $aUT [ "user" ][ "endDate" ][ "day" ];
        $H = $aUT [ "user" ][ "endDate" ][ "hour" ];
        $i = $aUT [ "user" ][ "endDate" ][ "min" ];
        $s = $aUT [ "user" ][ "endDate" ][ "sec" ];

        /*
        echo '<pre>';
        var_dump( $suche["user"]["endDate"] );
        echo '</pre>';

                $time = new Time( $this->db );
                $Y = $suche["user"]["endDate"]["year"];
                $m = $suche["user"]["endDate"][ "month" ];
                $d = $suche["user"]["endDate"][ "day" ];
                $H = $suche["user"]["endDate"][ "hour" ];
                $i = $suche["user"]["endDate"][ "min" ];
                $s = $suche["user"]["endDate"][ "sec" ];
        */


        $this->f3->set( 'startDate', date( "Y/m/d H:i:s" ) );// 2016/12/25 12:30:00
        $this->f3->set( 'endDate',
            $Y . '/' . $m . '/' . $d . ' ' . $H . ':' . $i . ':' . $s
        );

        #$this->f3->set( 'data', $users->getUserDB( $myName )[ "time" ] );
        $this->f3->set( 'data',
            $m . ' ' . $d . ',' . $Y . ' ' . $H . ':' . $i . ':' . $s // 06 28, 2016 03:59:00
        );


        //skin
        $this->f3->set( 'skin', "standard" );
        #$this->f3->set( 'skin', "blue" );
        #$this->f3->set( 'skin', "green" );
        #$this->f3->set( 'skin', "standard" );


        //cache on
        #$this->f3->set( 'cache', "manifest='app.cache'" );
        $this->f3->set( 'cache', "" );


        //templates
        $this->f3->set( 'name', "ContingentX" );
        $this->f3->set( 'view', 'users/user-dashboard.htm' );
        $template = new Template;
        echo $template->render( 'layout-user.htm' );
    }



    //---------------------------------- Admin Messages ---------------------------------


    function displayMessages() {
        $messages = new Messages( $this->db );
        $this->f3->set( 'messages', $messages->all() );
        $this->f3->set( 'view', 'users/messages.htm' );
        $template = new Template;
        echo $template->render( 'layout-user.htm' );
    }

    function apiMessages() {
        $messages = new Messages( $this->db );
        $data = $messages->all();

        $json = array();

        foreach ( $data as $row )
        {
            $item = array();

            foreach ( $row as $key => $value )
            {
                $item[ $key ] = $value;
            }

            array_push( $json, $item );
        }

        echo json_encode( $json );
    }

    /**
     * Renders the messages view template with AJAX
     *
     * @return void
     */
    function displayMessagesAjaxView() {
        $this->f3->set( 'view', 'admin/messagesajax.htm' );
        $template = new Template;
        echo $template->render( 'layout-user.htm' );
    }


    //---------------------------------- Admin User ---------------------------------

    function displayUsers() {
        $users = new User( $this->db );
        $this->f3->set( 'users', $users->all() );

        //Benutzerangaben
        $myName = $this->f3->get( 'SESSION.user' );
        $this->f3->set( 'myID', $users->getUserID( $myName ) );
        $this->f3->set( 'myName', $myName );
        $this->f3->set( 'myPassword', $users->password );
        $this->f3->set( '_rights', $users->getUserGroup( $myName ) );

        $this->f3->set( 'view', 'admin/users.html' );
        $template = new Template;
        echo $template->render( 'layout-user.htm' );
    }

    function apiUsers() {
        $users = new User( $this->db );
        $data = $users->all();

        $json = array();

        foreach ( $data as $row )
        {
            $item = array();

            foreach ( $row as $key => $value )
            {
                $item[ $key ] = $value;
            }

            array_push( $json, $item );
        }

        echo json_encode( $json );
    }

    //------------------------------- User Kontingent ---------------------------------


    //---- JSON

    function testJson(){
        $json = new json();

        $json->add('status', '200');
        $json->add("worked");
        $json->add("things", false);


        $object = new stdClass();
        $object->FirstName = 'John';
        $object->LastName = 'Doe';
        $json->add('friend', $object);


        $array = array(1,'2', 'Pieter', true);
        $json->add("arrays", $array);


        $jsonOnly = '{"Hello" : "darling"}';
        $json->add("json", $jsonOnly, false);



        // This will output the legacy JSON
        $json->send();

        // This will output the array, omitting names
        #$json->send_array();
    }
}