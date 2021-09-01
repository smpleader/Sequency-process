<?php
/**
 * Sequency Process - Demo
 * 
 * @project: https://github.com/smpleader/Sequency-process
 * @author: Pham Minh - smpleader
 * @description: Some function support info
 * 
 */

class demo
{
    public static function sampleArray()
    {
        return range(1, 100);
    }

    public static function connectDB()
    {
        // TODO: create connections
    }

    public static function sampleDB()
    {
        $this->connectDB();
        // create table #__process_state
        // create table #__table_records
        // add sample data to #__table_records
    }
}