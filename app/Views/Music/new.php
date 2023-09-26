<?php include 'include/top.php' ; ?>
<body>
    <?php include 'include/modal1.php' ; ?>
    <?php include 'include/modal2.php' ; ?>
    <?php include 'include/modal3.php' ; ?>

    <form action="/searchSong" method="get">
    <input type="search" name="search" placeholder="search song">
    <button type="submit" class="btn btn-primary">search</button>
    </form>
    <h1>Music Player</h1>
    <a href="/" class="btn btn-primary" >All Songs</a>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">My Playlist</button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddMusicModal">Add Music</button>

    <audio id="audio" controls></audio>
    <ul id="playlist">
        <?php  foreach ($songs as $song) :?>
        <li data-src= "<?=base_url ('/uploads/songs/' .$song ['songFile']);?>">
            <?=$song['songName'];?>
            <button type="button" class="btn btn-primary mx-2" data-bs-toggle = "modal" data-bs-target = "#myModal" onclick = "setMusicID('<?=$song['ID']?>')">
                +
            </button>
    </li>
    <?php endforeach; ?>
    </ul>

    <script>
    $(document).ready(function () {
  // Get references to the button and modal
  const modal = $("#myModal");
  const modalData = $("#modalData");
  const musicID = $("#musicID");
  // Function to open the modal with the specified data
  function openModalWithData(dataId) {
    // Set the data inside the modal content
    modalData.text("Data ID: " + dataId);
    musicID.val(dataId);
    // Display the modal
    modal.css("display", "block");
  }

  // Add click event listeners to all open modal buttons

  // When the user clicks the close button or outside the modal, close it
  modal.click(function (event) {
    if (event.target === modal[0] || $(event.target).hasClass("close")) {
      modal.css("display", "none");
    }
  });
});
    </script>
    <script>
        const audio = document.getElementById('audio');
        const playlist = document.getElementById('playlist');
        const playlistItems = playlist.querySelectorAll('li');

        let currentTrack = 0;

        function playTrack(trackIndex) {
            if (trackIndex >= 0 && trackIndex < playlistItems.length) {
                const track = playlistItems[trackIndex];
                const trackSrc = track.getAttribute('data-src');
                audio.src = trackSrc;
                currentTrack = trackIndex;
            }
        }

        function nextTrack() {
            currentTrack = (currentTrack + 1) % playlistItems.length;
            playTrack(currentTrack);
        }

        function previousTrack() {
            currentTrack = (currentTrack - 1 + playlistItems.length) % playlistItems.length;
            playTrack(currentTrack);
        }

        playlistItems.forEach((item, index) => {
            item.addEventListener('click', () => {
                playTrack(index);
            });
        });

        audio.addEventListener('ended', () => {
            nextTrack();
        });

        playTrack(currentTrack);
    </script>

    <script>
        fucntion setMusicID(songID){
            document.getElementById('musicID').value = songID;
        }
    </script>

    </body>

