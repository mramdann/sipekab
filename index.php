<?php
include "view/_header.php";
include "view/_menu.php";
?>
      <main class="app-main">
        <!-- .wrapper -->
        <div class="wrapper">
          <!-- .empty-state -->
          <div id="notfound-state" class="empty-state">
            <!-- .empty-state-container -->
            <div class="empty-state-container">
              <div class="state-figure">
                <img class="img-fluid" src="../assets/images/illustration/img-6.svg" alt="" style="max-width: 300px">
              </div>
              <h3 class="state-header"> No Content, Yet. </h3>
              <p class="state-description lead text-muted"> Use the button below to add your awesomething, aperiam ex veniam suscipit porro ab saepe nobis odio. </p>
              <div class="state-action">
                <a href="#" class="btn btn-primary">Create New</a>
              </div>
              <div class="btn btn-light fileinput-button">
                <i class="oi oi-cloud-upload mr-1"></i> <span>Import File</span> <input id="fileupload-btn" type="file" name="file">
              </div>
            </div>
          </div>
        </div>
      </main>

<?php
include "view/_footer.php";
?>