<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private $CITY_NAME = null;

    public function showIndex(){
        $cityList = $this->getCities();
        $videoList = $this->getVideos($this->CITY_NAME);
        return view('welcome')->with(['cities' => $cityList, 'videos' => $videoList]);
    }

    //get cities name
    private function getCities(){
        $user = User::select('city')->distinct()->get();
        return $user;
    }

    //get videos 
    private function getVideos(string $cityName = null){
        if(!isset($cityName)){
            $cityVideos = Video::get();
        }
        else{
            $user_ids = User::select('id')->where('city', $cityName)->get();
            $ids = array();
            foreach($user_ids as $element){
                array_push($ids, $element->id);
            }

            $cityVideos = Video::whereIn('user_id', $ids)->get();
        }

        return $cityVideos;
    }

    // show videos according to city
    public function showCityVideo(Request $request){
        $data = $request->validate(['city' => ['required', 'string']]);

        $this->CITY_NAME = $data['city'];
        return $this->showIndex();
    }

    //show specific video
    public function showSpecificVideo(Request $request){
        $data = $request->validate(['vid' => ['required', 'numeric']]);

        $video = Video::where('id', $data['vid'])->first();
        $cityList = $this->getCities();
        $videoList = $this->getVideos($this->CITY_NAME);

        return view('specific_video')->with(['cities' => $cityList, 'videos' => $videoList, 'specific_video' => $video]);
    }
}
