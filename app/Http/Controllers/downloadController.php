<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
include '../vendor/autoload.php';
use YoutubeDl\YoutubeDl;
use YoutubeDl\Exception\CopyrightException;
use YoutubeDl\Exception\NotFoundException;
use YoutubeDl\Exception\PrivateVideoException;
use App\Reqhistory;
class downloadController extends Controller
{
    public function index()
    {
        return view('index');  
    }


    public function downloader(Request $request)
    {
        $url = $request->get('url');
        $format =$request->get('format');
       
        if($format!='.mp4'){
            $dl = new YoutubeDl([
                'continue' => true,
                'extract-audio' => true,
                'audio-format' => 'mp3',
                'audio-quality' => 0, 
            ]);
        }else{
            $dl = new YoutubeDl([
                'continue' => true, 
                'format' => 'mp4',  
            ]);
        }
        $dl->setDownloadPath('../public/converted');

        function convertToReadableSize($size){
            $base = log($size) / log(1024);
            $suffix = array("", "KB", "MB", "GB", "TB");
            $f_base = floor($base);
            return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
          }
        
        try {
            $video = $dl->download($url);
            if($format=='.mp4'){
                $size = convertToReadableSize($video->get('filesize'));
            }else{
                $size = $video->get('filesize');
            }
          if(!empty($video)){
                $inHistory = new Reqhistory;
                $inHistory->URl = $url;
                $inHistory->format = $format;
                $inHistory->thumbnail = $video->get('thumbnail');
                $inHistory->title = $video->getTitle();
                $inHistory->name = $video->get('_filename');
                $inHistory->size = $size;
                $inHistory->save();
                return redirect()->route('makingDecision',['id'=>$inHistory->id]);
            }
            
        } catch (NotFoundException $e) {
            // Video not found
        } catch (PrivateVideoException $e) {
            // Video is private
        } catch (CopyrightException $e) {
            // The YouTube account associated with this video has been terminated due to multiple third-party notifications of copyright infringement
        } catch (\Exception $e) {
            // Failed to download
        }
    }

    public function makingDecision($id){
        $getInfo = Reqhistory::find($id);
        return view('makingDecision')->with('getInfo',$getInfo);
    }
   
   /* public function deleteFlocal(Request $request){
       // unlink("../public/converted/$name");
        return redirect()->route('index');
    }*/
    
}