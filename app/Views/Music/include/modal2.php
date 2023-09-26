<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

          <!-- Modal Header -->
       <div class="modal-header">
          <h4 class="modal-title">Select from playlist</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
       </div>

          <!-- Modal body -->
          <div class="modal-body">
          <form action="/addToPlaylist" method="post">
            <!-- <p id="modalData"></p> -->
            <input type="text" id="musicID" name="SongID">
            <select  name="playlistID" class="form-control" >
              <?php foreach ($playlist as $playlists) :?>

              <option value="<?=$playlists['play_ID']?>">
                  <?=$playlists['playlistName']?>
              </option>
            <?php endforeach;  ?>

            </select>
            <input type="submit" name="add">
            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>