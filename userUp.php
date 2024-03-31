<?php
include 'database.php';
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>


<?php require('includes/header.php'); ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create New Folder </h4>
                        <p class="card-description">

                            <?php
                            if (isset($_SESSION['new_folder_created'])) {
                            ?>
                        <div id="notification" class="alert alert-success" role="alert">
                            <b> <i class="bi bi-check-circle-fill"></i>Success ! </b>New Folder created
                            successfully.
                        </div>
                    <?php
                                unset($_SESSION['new_folder_created']);
                            }
                    ?>
                    <?php
                    if (isset($_SESSION['folder_exists'])) {
                    ?>
                        <div id="notification" class="alert alert-danger" role="alert">
                            <b> <i class="bi bi-x-circle-fill"></i>Failed ! </b> Folder name not available.
                            Please choose another name.
                        </div>
                    <?php
                        unset($_SESSION['folder_exists']);
                    }
                    ?>
                    </p>
                    <form class="forms-sample" action="newfolder.php" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="exampleInputUsername1">Folder Name </label>
                            <input type="text" name="folder" class="form-control" id="exampleInputUsername1" placeholder="Document Name" required>
                        </div>

                        <button type="submit" name="sub" class="btn btn-primary me-2">Create Folder</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="font-family:Georgia, 'Times New Roman', Times, serif;"> <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAE70lEQVR4nO2Z3W8bRRDAXb7+AHiJw3uBJ5KKB0BJJMRbE0poGmQHCRCNlNhNIHaiJm6lBoVKLnYahCjUaT6aXatpGvqAKtEqPYPbPrSB2kIqBZqIdM9ICFESO5YCorfnDpprY2yfP87nu1IkjzSytL6d3d/NzuzunMVSlapUpSoPgiRC1m1JocadEGrr7+vAAMMPATv+NGczr8ki7ZFjdFBRkfZgG/6Hz5Sysy5Yv0SIdcHKkyErrAtWKbFQW2fu5CPjj/Kb5FWZ0XnO6KosUiim+Axn5BSPBXdg30J2k6GafoRIq1DjNgfg+vxjskh6uUh/KTX5glAijaG38gElhNp69MSmR+JfPfms4RBSLNjIRfqjXgC1l8gPUow0qGAWauuSQo3LcAgA2CIzsp8zIhsFkQHDZUY9OIahk1ZDzD/MGZk0GiAP0ASOlTl2vKGtJd7Ulow3tjdXCAFbcACzIeR/EwLN9AwCIMha087tmiedfLn1idWGNtf68+2Pb7bhcsod7M+laRBmBuG4rxemdSr2DZFB2LgxpQZiZKiit7/W1O6ON+0ChEkHdk5MLIdHocveCt3+UeiZOw29n3+hS7Fvt88P7+zcDktfj6piRhLpi7pB0BOJxl19+IspNjc7oScQYuDCFRi4uAi7/WPw9vsflKWdYx/D4NVraUVbXfZW+Gt5SpXNiu01mgX3iVyX43JCTyDEG+/2gft8OGtSerXL54fz1JMeJ/XrGUVlRpyV79h5NrtJr1NZEp2+McMgUHvmTsOE16kC4SIRK/IKZ7Q1X0YJHHQo6/ut/QfSk3B/Ng7DPq+i7qOBrLaRwz6VZj6nLK2Li4pNtJ03i4mkpQIQckoLSN9ZAeaCk5CS44rO0mPgnDmR1ZZP8TnsizbQVm9xkFldEHhC5Yz8oRXkJJ3ImuAeMpvVVgjEdS6kzSOMrmo5NatBGHmm0GaVd2kdDcCI/xCM+LzQHxjPavOO+VWa+Rxqd2CqKAgq3Aw+VTbIvfuEZpBKtdTSktErseAOQ9KumcHumA6WBJFFuqd8EBbcpxXEiGB/78y50iCMenSDpH47C6m1b0COnTA12LUsLVkXCN63McBSfwOKAmNisGsCEXUsrc1gv7PBFBj0zP8y2KHc9FthsGsBAT3pV4ranpN+Gt6Qfz7yoOzsv5d9Bb4deX2bFLVzHrUDj3aAvPKp6Tu7KUcUKWLrvwtxT2+MmL6zlwYJln9Xv/2trV6K2iSEkKIdd+SVI3mP8XihMuIY71oIQ+foR6pjfIY3RIDwI2WDKDDfddRJUZuLLx3yorGNyy+lDeMd25FxscKJVAKBNgYuLULXh34Qgvvy7R8OS6WCb0Jm5FqmYSwU4B1buepeWlTe5pt7h3Qp9kUbAxcuw+62ZuUanQNx3ZCrLgpWAJXiWcYAWCjAOza+xUqLD2gDIZbDh9XFB0ZesBgpeDzIdTkWCgTqgfGDDvjkQKcuxb6hoEftCVHRvRaj5T8o0B3jkY4WKWpL8oit2YyS6cT9gAAcK2JrVkCu2rVXF8ssYg/lxowxAISbspyKCVYAMaMYBsLI94YHtlbBtIjFM9ywdHsB+zLqMCzF6i1upwt5MfoKF8lJLtJbpSdPb+HZCWtVundsI4vbhWIIVsjWu98UiTP9MRQ9h98MV8hW0z/klFPcLvlwVapSlapYTJB/ADDipBPyNLeSAAAAAElFTkSuQmCC">Folders List</h4>
                        <p class="card-description fs-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                                        <th>Name </th>
                                        <th>Date</th>
                                        <th>UserName</th>
                                        <th>Privacy</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $user = $_SESSION['user'];
                                    $sql = "SELECT * from folders where folder_user = '$user'";
                                    //$sql = "SELECT * from folders where folder_user = ".$user;

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 100 100">
                                                        <path fill="#ee3e54" d="M13 27A2 2 0 1 0 13 31A2 2 0 1 0 13 27Z"></path>
                                                        <path fill="#f1bc19" d="M77 12A1 1 0 1 0 77 14A1 1 0 1 0 77 12Z"></path>
                                                        <path fill="#fce0a2" d="M50 13A37 37 0 1 0 50 87A37 37 0 1 0 50 13Z"></path>
                                                        <path fill="#f1bc19" d="M83 11A4 4 0 1 0 83 19A4 4 0 1 0 83 11Z"></path>
                                                        <path fill="#ee3e54" d="M87 22A2 2 0 1 0 87 26A2 2 0 1 0 87 22Z"></path>
                                                        <path fill="#fbcd59" d="M81 74A2 2 0 1 0 81 78 2 2 0 1 0 81 74zM15 59A4 4 0 1 0 15 67 4 4 0 1 0 15 59z"></path>
                                                        <path fill="#ee3e54" d="M25 85A2 2 0 1 0 25 89A2 2 0 1 0 25 85Z"></path>
                                                        <path fill="#fff" d="M18.5 51A2.5 2.5 0 1 0 18.5 56A2.5 2.5 0 1 0 18.5 51Z"></path>
                                                        <path fill="#f1bc19" d="M21 66A1 1 0 1 0 21 68A1 1 0 1 0 21 66Z"></path>
                                                        <path fill="#fff" d="M80 33A1 1 0 1 0 80 35A1 1 0 1 0 80 33Z"></path>
                                                        <g>
                                                            <path fill="#cdcbbd" d="M29.509,69.3c-0.503,0-1.126-0.145-1.482-1.275c-0.274-0.872-0.273-1.945-0.272-2.655L27.7,37.796v-3.822c0-1.694,1.321-3.072,2.945-3.072h17.646c1.659,0,3.009,1.455,3.009,3.244v1.459c0,1.244,0.968,2.257,2.157,2.257h16.086c0.417,0,0.757,0.385,0.757,0.857v23.565c0,0.334,0.013,0.748,0.026,1.214c0.05,1.703,0.131,4.46-0.436,5.802H29.509z"></path>
                                                            <path fill="#472b29" d="M48.291,31.601c1.273,0,2.309,1.141,2.309,2.544v1.458c0,1.631,1.282,2.957,2.857,2.957l16.076-0.002c0.011,0.005,0.067,0.053,0.067,0.159v23.566c0,0.339,0.012,0.761,0.026,1.234c0.038,1.287,0.11,3.738-0.236,5.082h-39.88c-0.266,0-0.567,0-0.815-0.786c-0.242-0.769-0.241-1.777-0.241-2.444l0-0.092L28.4,37.797v-3.824c0-1.308,1.007-2.372,2.245-2.372H48.291 M48.291,30.201H30.645c-2.005,0-3.645,1.698-3.645,3.772v3.824l0.054,27.484C27.054,66.704,27,70,29.509,70h40.804C71.368,68.355,71,64.102,71,62.285V38.719c0-0.86-0.652-1.557-1.457-1.557H53.457c-0.805,0-1.457-0.697-1.457-1.557v-1.458C52,31.977,50.331,30.201,48.291,30.201L48.291,30.201z"></path>
                                                        </g>
                                                        <g>
                                                            <path fill="#fdfcee" d="M29.594,69.3c-0.061-0.007-0.15-0.105-0.214-0.215c1.214-0.343,1.32-2.538,1.32-5.146V42.231c0-0.293,0.229-0.531,0.512-0.531h41.576c0.282,0,0.512,0.238,0.512,0.531v23.582c0,1.923-1.534,3.486-3.42,3.486H29.594z"></path>
                                                            <path fill="#472b29" d="M72.6,42.4v23.413c0,1.537-1.22,2.787-2.72,2.787H30.849c0.551-1.191,0.551-3.047,0.551-4.66V42.4H72.6 M72.788,41H31.212C30.542,41,30,41.551,30,42.231V63.94c0,2.779-0.188,4.492-0.974,4.492c-0.85,0-0.282,1.568,0.568,1.568H69.88c2.275,0,4.12-1.874,4.12-4.187V42.231C74,41.551,73.458,41,72.788,41L72.788,41z"></path>
                                                        </g>
                                                        <g>
                                                            <path fill="#472b29" d="M41.5,35h-11c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h11c0.276,0,0.5,0.224,0.5,0.5S41.776,35,41.5,35z"></path>
                                                        </g>
                                                        <g>
                                                            <path fill="#472b29" d="M48.5,35h-4c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h4c0.276,0,0.5,0.224,0.5,0.5S48.776,35,48.5,35z"></path>
                                                        </g>
                                                        <g>
                                                            <path fill="#472b29" d="M51.5,53h-14c-0.276,0-0.5-0.224-0.5-0.5v-6c0-0.276,0.224-0.5,0.5-0.5h14c0.276,0,0.5,0.224,0.5,0.5v6C52,52.776,51.776,53,51.5,53z M38,52h13v-5H38V52z"></path>
                                                        </g>
                                                    </svg>
                                                    <span class="text-capitalize"><?= $row['folder_name'] ?></span>
                                                </td>
                                                <td><?= date('d M Y', strtotime($row['folder_date'])) ?></td>
                                                <td><span class="text -capitalize"><?=$_SESSION['user']?></td></span>
                                                <td>
                                                    <?php
                                                    $lock = $row['folder_lock'];
                                                    if ($lock == 1) {
                                                    ?>

                                                        <button type="button" class="btn btn-inverse-success btn-icon rounded-pill btn-sm" data-bs-toggle="modal" data-bs-target="#locked<?= $row['folder_id'] ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1" />
                                                            </svg> Locked
                                                        </button>


                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button type="button" class="" data-bs-toggle="modal" data-bs-target="#locked<?= $row['folder_id'] ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock" viewBox="0 0 16 16">
                                                                <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2M3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1z" />
                                                            </svg>
                                                        </button>
                                                    <?php
                                                    }
                                                    ?>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="locked<?= $row['folder_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog ">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <form action="php/verify_pin.php" method="POST">
                                                                        <label for="exampleInputEmail1" class="form-label">Enter PIN</label>
                                                                        <input type="text" name="pin" maxlength="4" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                                        <input type="hidden" name="folderid" value="<?= $row['folder_id'] ?>">
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">
                                                                                <?php
                                                                                if ($lock == 1) {
                                                                                    echo "Unlock";
                                                                                } else {
                                                                                    echo "Lock";
                                                                                }

                                                                                ?>
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#delete<?= $row['folder_id'] ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 30 30">
    <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z"></path>
</svg>
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="delete<?= $row['folder_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body fs-6 text-wrap">
                                                                    Are you sure want to delete
                                                                    <b class="text-capitalize">"<?= $row['folder_name'] ?>"</b>
                                                                    Folder ?
                                                                    You can't undo this action.
                                                                </div>
                                                                <div class="modal-header d-flex flex-nowrap">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <a href="php/delete_folder.php?fid=<?= $row['folder_id'] ?>" class="btn btn-danger">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    $conn->close();
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>

</div></div>
</div>

</div>





<?php require('includes/footer.php'); ?>