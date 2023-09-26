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

    public function searchSong(){

        $searchLike = $this -> request -> getVar('search');

        if(!empty($searchLike)){

            $data = [
              'songs' => $this->Songs->searchSong($searchLike),
              'playlist' => $this->Playlist->findAll()
            ];
            return view('Music\new', $data);
        }else{
            return redirect()->to('/');
        }
    }

    public function createPlaylist(){
        $data = [
            'playlistName' => $this->request->getVar('playlistName')
        ];
         $this->Playlist->save($data);
        
        return redirect()->to('/');
    }

    public function addToPlaylist(){
        $data =[
            'playlist_ID' => $this->request->getVar('playlistID'),
            'songID' => $this->request->getVar('SongID')
        ];
        
        // $this->Track->save($data);
        var_dump($data);
        // return redirect()->to('/');
    }

    public function playlist($id = null){
        $db = \Config\Database::connect();
        $builder = $db->table('songs');

        $builder->select(['songs.ID', 'songs.songName','songs.songFile','playlist.playlistName','playlist.play_ID']);
        $builder->join('track', 'songs.ID = track.ID');
        $builder->join('playlist', 'track.ID = playlist.play_ID');

        if($id !== null){
            $builder->where('playlist.play_ID', $id);
        }

        $query = $builder->get();

        $data = [
            'playlists' => $this->playlist->findall(),
            'songs' => $this->song->findall()
        ];

        if($query) {
            $data['songs'] = $query->getResultArray();
        }
        else{
            echo"Query Failed";
        }

        return view('Music\new', $data);
    }
}   
