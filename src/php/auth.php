<?php
ob_start();
include "../database/selectUser.php";
ob_clean();
session_start();

$cookieIsSet = false;


if (isset($_COOKIE['username'])) {
  foreach ($userList as $user) {
    if ($_COOKIE['username'] === $user['username'] && $user['is_active'] == 1 && $user['remember_me'] == 1) {
      // echo "User verified via cookie.";
      $cookieIsSet = true;
      break;
    }
  }
}

if (!$cookieIsSet) {
  if (!isset($_SESSION['user_id'])  || !isset($_SESSION['is_active']) || $_SESSION['is_active'] != 1) {
    header('Location: ../login/index.php');
    exit;
    exit;
    exit;
  }
}

if (!empty($_SESSION['login_success'])) {
  echo '
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index:1080;">
          <div id="loginToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
              <div class="toast-body">Erfolgreich eingeloggt</div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
          </div>
        </div>
        <script>
          document.addEventListener("DOMContentLoaded", function(){
            var el = document.getElementById("loginToast");
            if (el) {

              var t = new bootstrap.Toast(el, { delay: 3000 });
              t.show();
            }
          });
        </script>
        ';
  unset($_SESSION['login_success']);
}
