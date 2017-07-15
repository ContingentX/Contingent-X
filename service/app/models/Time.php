<?php
/**
 * User model
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Fat-Free-PHP-Bootstrap-Site
 * @author   Michael McCouman
 * @license  CC-BY-SA
 */

/**
 * User model class
 *
 * @category PHP
 * @package  Fat-Free-PHP-Bootstrap-Site
 * @author   Michael McCouman
 * @license  CC-BY-SA
 */
class Time extends DB\SQL\Mapper {
    /**
     * Constructor, maps user table fields to php object
     *
     * @param DB\SQL $db Database connection
     */
    public function __construct( DB\SQL $db ) {
        parent::__construct( $db, 'time' );
    }

    /**
     * Fetch all records
     *
     * @return array
     */
    public function all() {
        $this->load();

        return $this->query;
    }

    /**
     * Fetch one record by id records
     *
     * @param int $id User id
     *
     * @return array
     */
    public function getById( $id ) {
        $this->load( array(
                'id=?',
                $id
            )
        );

        return $this->query;
    }

    /**
     * Fetch one record by name records
     *
     * @param string $name User name
     *
     * @return array
     */
    public function getByName( $name ) {
        $this->load( array(
                'username=?',
                $name
            )
        );
    }

    /**
     * Add a User record
     * there are no paramaters, becuase record data is copied from $_POST
     * it's one of the great features of f3
     *
     * @return void
     */
    public function add() {
        $this->copyFrom( 'POST' );
        $this->save();
    }

    /**
     * Edit a specific record
     *
     * @param int $id User id
     *
     * @return void
     */
    public function edit( $id ) {
        $this->load( array(
                'id=?',
                $id
            )
        );
        $this->copyFrom( 'POST' );
        $this->update();
    }

    /**
     * Delete a record
     *
     * @param int $id User id
     *
     * @return void
     */
    public function delete( $id ) {
        $this->load( array(
                'id=?',
                $id
            )
        );
        $this->erase();
    }


    //---------------------------------------- read DB about username (cookie)

    public function getTimeDB( $username ) {
        $row = $this->db->exec( "SELECT * FROM time WHERE userIDmail='" . $username . "'" );

        return $row[ 0 ];
    }

}
