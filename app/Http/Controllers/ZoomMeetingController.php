<?php

namespace App\Http\Controllers;

use App\Http\Services\ZoomApiService;
use Illuminate\Http\Request;

class ZoomMeetingController extends Controller
{
    public $zoom_meeting;
    public function __construct(ZoomApiService $zoom_meeting)
    {
        $this->zoom_meeting = $zoom_meeting;
    }

    public function index()
    {
//        return date(now());
        $data = array();
        $data['topic'] 		= 'Example Test Meeting';
        $data['start_date'] = date("2022-01-25 19:25:00");
//        $data['start_date'] = date("Y-m-d h:i:s", strtotime('tomorrow'));
        $data['duration'] 	= 30;
        $data['type'] 		= 2;
        $data['password'] 	= "12345";
        $data['join_before_host'] = true;

        try {
            $response = $this->zoom_meeting->createMeeting($data);

            //echo "<pre>";
            //print_r($response);
            //echo "<pre>";

            echo "Meeting ID: ". $response->id;
            echo "<br>";
            echo "Topic: "	. $response->topic;
            echo "<br>";
            echo "Join URL: ". $response->join_url ."<a href='". $response->join_url ."' target='_blank'>Open URL</a>";
            echo "<br>";
            echo "Meeting Password: ". $response->password;


        } catch (\Exception $ex) {
            echo $ex;
        }
    }
}
