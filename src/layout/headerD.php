<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <title>Header</title>
</head>

<div class="parallelogram" id="header">
    <div class="textDashboard d-flex justify-content-between align-items-center" style="margin-left: 3%; margin-right: 3%;">
        <div id="headerTitle"> Infoterminal CJD Offenburg</div>
        <div id="selectPanel">
            <div class="mx-auto pl-auto bg-gray-100 w-100">
                <div class="d-flex justify-content-between gap-2" id="startBtns">
                    <button type="button" id="infotherminalBereich"
                        class="btn text-dark start-btn navbuttons">Infoterminal</button>
                    <button id="templates" type="button" class="btn text-dark start-btn navbuttons">Templates</button>
                    <button id="adminBereich" type="button" class="btn text-dark start-btn navbuttons">Administration</button>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center ">
            <i id="themeToggle" class="bi bi-sun me-2" style="font-size: 1.5rem; cursor: pointer;" aria-label="Theme wechseln" title="Theme wechseln"></i>
            <i class="bi bi-person-circle me-2" style="font-size: 1.5rem; padding-left: 10px;"></i>
            <span id="usernameDisplay" style="font-size: 1.3rem;">
                <?php
                if (isset($_SESSION['username'])) {
                    echo $_SESSION['username'];
                } else if (isset($_COOKIE['username'])) {
                    echo $_COOKIE['username'];
                }
                ?>
            </span>
            <button id="logout" type="button" onclick="logout()" class="btn text-dark start-btn adddelLogoutbtn"
                aria-label="Logout" title="Logout">
                <i class="bi bi-box-arrow-right" style="font-size: 1.6rem"></i>
            </button>
        </div>
        <script>
            if (window.location.href.includes("dashboard.php")) {
                document.getElementById("infotherminalBereich").classList.add("btn-active");
            } else if (window.location.href.includes("adminbereich.php")) {
                document.getElementById("adminBereich").classList.add("btn-active");
            } else if (window.location.href.includes("templates.php")) {
                document.getElementById("templates").classList.add("btn-active");
            }
        </script>
    </div>

</div>