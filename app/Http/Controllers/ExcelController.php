<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\audio_lookup_value;
use App\video_lookup_value;
use App\image_lookup_value;
use Auth;

class ExcelController extends Controller
{
    public function upload()
    {
        return view('admin/addAudios');
    }

    public function ImportAudio()
    {
        try {
            $file = Input::file('file');
            $file_name = $file->getClientOriginalName();
            $file->move('files/audio', $file_name);
            $results = \Excel::load('files/audio/' . $file_name, function ($reader) {
                $reader->all();
            })->toArray();
            $count = count(array_filter($results, function ($results) {

                return $results['tag'];

            }));
            Log::Info($results);
            Log::Info($count);

            for ($i = 0; $i < $count; $i++) {
                $exist_tag = audio_lookup_value::where('audio_lookup_value_tag', $results[$i]['tag'])->pluck('audio_lookup_value_tag');
                $exist_link = audio_lookup_value::where('audio_lookup_value_link', $results[$i]['link'])->pluck('audio_lookup_value_link');
                if (($exist_tag->count()) > 0) {
                    audio_lookup_value::where('audio_lookup_value_tag', $results[$i]['tag'])->update(['archived' => 'true']);
                } elseif (($exist_link->count()) > 0) {
                    audio_lookup_value::where('audio_lookup_value_link', $results[$i]['link'])->update(['archived' => 'true']);
                } else {
                    $audio_lookup_value = new audio_lookup_value;
                    $audio_lookup_value['audio_lookup_value_tag'] = $results[$i]['tag'];
                    $audio_lookup_value['audio_lookup_value_link'] = $results[$i]['link'];
                    $audio_lookup_value['archived'] = false;
                    $audio_lookup_value['created_by'] = 1;
                    $audio_lookup_value['updated_by'] = 1;
                    $audio_lookup_value->save();
                }
            }
            return redirect()->route('AddAudio');
        }
        catch (\Throwable $e)
        {
            return view ('errors/error_fileupload');
        }
    }

    public function ImportVideo()
    {
        try {
            $file = Input::file('file');
            $file_name = $file->getClientOriginalName();
            $file->move('files/video', $file_name);
            $results = \Excel::load('files/video/' . $file_name, function ($reader) {
                $reader->all();
            })->toArray();
            $count = count(array_filter($results, function ($results) {

                return $results['tag'];

            }));
            Log::Info($results);
            Log::Info($count);

            for ($i = 0; $i < $count; $i++) {
                $exist_tag = video_lookup_value::where('video_lookup_value_tag', $results[$i]['tag'])->pluck('video_lookup_value_tag');
                $exist_link = video_lookup_value::where('video_lookup_value_link', $results[$i]['link'])->pluck('video_lookup_value_link');
                if (($exist_tag->count()) > 0) {
                    video_lookup_value::where('video_lookup_value_tag', $results[$i]['tag'])->update(['archived' => 'true']);
                } elseif (($exist_link->count()) > 0) {
                    video_lookup_value::where('video_lookup_value_link', $results[$i]['link'])->update(['archived' => 'true']);
                } else {
                    $video_lookup_value = new video_lookup_value;
                    $video_lookup_value['video_lookup_value_tag'] = $results[$i]['tag'];
                    $video_lookup_value['video_lookup_value_link'] = $results[$i]['link'];
                    $video_lookup_value['archived'] = false;
                    $video_lookup_value['created_by'] = 1;
                    $video_lookup_value['updated_by'] = 1;
                    $video_lookup_value->save();
                }
            }
            return redirect()->route('AddVideo');
        }
        catch (\Throwable $e)
        {
            return view ('errors/error_fileupload');
        }
    }

    public function ImportImage()
    {
        try {
            $file = Input::file('file');
            $file_name = $file->getClientOriginalName();
            $file->move('files/image', $file_name);
            $results = \Excel::load('files/image/' . $file_name, function ($reader) {
                $reader->all();
            })->toArray();
            $count = count(array_filter($results, function ($results) {

                return $results['tag'];

            }));
            Log::Info($results);
            Log::Info($count);

            for ($i = 0; $i < $count; $i++) {
                $exist_tag = image_lookup_value::where('image_lookup_value_tag', $results[$i]['tag'])->pluck('image_lookup_value_tag');
                $exist_link = image_lookup_value::where('image_lookup_value_link', $results[$i]['link'])->pluck('image_lookup_value_link');
                if (($exist_tag->count()) > 0) {
                    image_lookup_value::where('image_lookup_value_tag', $results[$i]['tag'])->update(['archived' => 'true']);
                } elseif (($exist_link->count()) > 0) {
                    image_lookup_value::where('image_lookup_value_link', $results[$i]['link'])->update(['archived' => 'true']);
                } else {
                    $image_lookup_value = new image_lookup_value;
                    $image_lookup_value['image_lookup_value_tag'] = $results[$i]['tag'];
                    $image_lookup_value['image_lookup_value_link'] = $results[$i]['link'];
                    $image_lookup_value['archived'] = false;
                    $image_lookup_value['created_by'] = 1;
                    $image_lookup_value['updated_by'] = 1;
                    $image_lookup_value->save();
                }
            }
            return redirect()->route('AddImage');
        }
        catch (\Throwable $e)
        {
            return view ('errors/error_fileupload');
        }
    }
}
