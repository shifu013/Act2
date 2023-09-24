<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Playlist;
use App\Models\Songs;
use App\Models\Track;

class MainController extends BaseController
{
    private $Playlist;
    private $Songs;
    private $Track;

    public function __construct(){
        $this->Playlist = new Playlist();
        $this->Songs = new Songs();
        $this->Track = new Track();
    }

    public function index(){
        $data = [
            'playlist' => $this->Playlist->findAll(),
          'songs' => $this->Songs->findAll(),
            
        ];
        return view('Music\new', $data);
    }

    public function upload(){
        $file = $this -> request -> getFile('songFile');
        var_dump($file);

        $newfileName = $file -> getRandomName();

        $data =[
            'songName' => $file->getName(),
            'songFile' => $newfileName,
        ];

        $rules = [
            'songFile' => [
                'uploaded[songFile]',
                'mime_in[songFile,audio/mpeg]',
                'max_size[songFile,10240]',
                'ext_in[songFile,mp3]'
            ]
        ];

        if($this->validate($rules)){
            if($file->isValid() && !$file->hasMoved()){
                if($file->move(FCPATH. 'uploads/songs', $newfileName)){
                    echo 'File uploaded successfully';
                    $this->Songs->save($data);
        }else{
            echo $file->getErrorString(). ' ' .$file->getError();
        }
    }else{
        $data['validation'] = $this->validator;
    }

    return redirect()->to('/');
    }
    }
}   
