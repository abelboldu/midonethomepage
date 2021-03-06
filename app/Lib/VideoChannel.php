<?php
/**
 * Video Channel class.
 *
 * Provides base for maintaining youtube videos. Uses a Tab delimited text file
 * in channels directory with a text file for each channel in the format
 * ID (youtube video id), Title (title to video), Description (Any description
 * for video, please remove line breaks), Featured (1 or 0, reeserved for future
 * use).
 *
 * Client: Midokura SARL
 *
 * @author Amit Talwar <amit@midokura.com>
 * @copyright 2015 midonet.org
 */

class VideoChannel
{
    protected $count = 0;
    protected $counter = 0;
    protected $fp;

    public function VideoChannel($channel)
    {
        $filename = ROOT_PATH.'/channels/'.$channel.'.txt';

        if ( ! file_exists ($filename)) {
            die('Channel ' .$channel.' Does not exist!!');
        }

        $this->fp = file($filename);
        $this->count = count($this->fp);
    }

    public function size()
    {
        return $this->count;
    }

    // Returns an array of videos
    public function listing()
    {
        $varr = array();

        for ($i = 0; $i < $this->count; $i++) {
            $row = explode("\t", $this->fp[$i]);
            $ft = ($row[3] == 1) ? true : false;
            $video = new Video($row[0], $row[1], $row[2], $ft);
            $varr[] = $video;
        }

        return $varr;
    }
}
