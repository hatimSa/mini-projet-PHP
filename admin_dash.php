<?php

include 'config.php';
include('dashboard_template.php');

?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">

<link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">

<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
<script nonce="13ab36d2-1ee0-4963-894c-9b5b88a2f68d">
    (function(w, d) {
        ! function(bg, bh, bi, bj) {
            bg[bi] = bg[bi] || {};
            bg[bi].executed = [];
            bg.zaraz = {
                deferred: [],
                listeners: []
            };
            bg.zaraz.q = [];
            bg.zaraz._f = function(bk) {
                return function() {
                    var bl = Array.prototype.slice.call(arguments);
                    bg.zaraz.q.push({
                        m: bk,
                        a: bl
                    })
                }
            };
            for (const bm of ["track", "set", "debug"]) bg.zaraz[bm] = bg.zaraz._f(bm);
            bg.zaraz.init = () => {
                var bn = bh.getElementsByTagName(bj)[0],
                    bo = bh.createElement(bj),
                    bp = bh.getElementsByTagName("title")[0];
                bp && (bg[bi].t = bh.getElementsByTagName("title")[0].text);
                bg[bi].x = Math.random();
                bg[bi].w = bg.screen.width;
                bg[bi].h = bg.screen.height;
                bg[bi].j = bg.innerHeight;
                bg[bi].e = bg.innerWidth;
                bg[bi].l = bg.location.href;
                bg[bi].r = bh.referrer;
                bg[bi].k = bg.screen.colorDepth;
                bg[bi].n = bh.characterSet;
                bg[bi].o = (new Date).getTimezoneOffset();
                if (bg.dataLayer)
                    for (const bt of Object.entries(Object.entries(dataLayer).reduce(((bu, bv) => ({
                            ...bu[1],
                            ...bv[1]
                        }))))) zaraz.set(bt[0], bt[1], {
                        scope: "page"
                    });
                bg[bi].q = [];
                for (; bg.zaraz.q.length;) {
                    const bw = bg.zaraz.q.shift();
                    bg[bi].q.push(bw)
                }
                bo.defer = !0;
                for (const bx of [localStorage, sessionStorage]) Object.keys(bx || {}).filter((bz => bz.startsWith("_zaraz_"))).forEach((by => {
                    try {
                        bg[bi]["z_" + by.slice(7)] = JSON.parse(bx.getItem(by))
                    } catch {
                        bg[bi]["z_" + by.slice(7)] = bx.getItem(by)
                    }
                }));
                bo.referrerPolicy = "origin";
                bo.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(bg[bi])));
                bn.parentNode.insertBefore(bo, bn)
            };
            ["complete", "interactive"].includes(bh.readyState) ? zaraz.init() : bg.addEventListener("DOMContentLoaded", zaraz.init)
        }(w, d, "zarazData", "script");
    })(window, document);
</script>

<?php

if (isset($users['username'])) {
    $username = $users['username'];
} else {
    $username = 'Administrateur';
}

?>

<body style="background-color: Azure">
    <div class="container">
        <h3>Bienvenue <?php echo isset($username) ? $username : ''; ?> !</h3><br><br>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="card text-white bg-primary mb-3 mr-3 mx-3 my-3" style="max-width: 20rem;">
                    <div class="card-header">Professeurs</div>
                    <div class="card-body">
                        <h5 class="card-title">Ajouter un Professeur</h5>
                        <p class="card-text">Description: Ici vous pouvez ajouter les nouveaux Professeurs qui ont rejoint l'établissement</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div><br>
                    <a href="prof_add.php" class="card-footer bg-transparent border-light"><i class="fas fa-arrow-circle-right">Plus d'Infos</i></a>
                </div>
                <div class="card text-white bg-secondary mb-3 mr-3 mx-3 my-3" style="max-width:20rem;">
                    <div class="card-header">Professeurs</div>
                    <div class="card-body">
                        <h5 class="card-title">Liste des Professeurs</h5>
                        <p class="card-text">Description: Ici vous pouvez voir la liste des Professeurs existant et leurs informations</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-person-lines-fill"></i>
                    </div><br>
                    <a href="prof_list.php" class="card-footer bg-transparent border-light"><i class="fas fa-arrow-circle-right">Plus d'Infos</i></a>
                </div>
                <div class="card text-white bg-info mb-3 mr-3 mx-3 my-3" style="max-width: 20rem;">
                    <div class="card-header">Utilisateur</div>
                    <div class="card-body">
                        <h5 class="card-title">Profil d'Utilisateur</h5>
                        <p class="card-text">Description: Ici vous pouvez consulter votre profil comme Admin de l'application</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-person-circle"></i>
                    </div><br>
                    <a href="admin_profil.php" class="card-footer bg-transparent border-light"><i class="fas fa-arrow-circle-right">Plus d'Infos</i></a>
                </div>
            </div>
    </section>

</body>

<script src="plugins/jquery/jquery.min.js"></script>

<script src="plugins/jquery-ui/jquery-ui.min.js"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="plugins/chart.js/Chart.min.js"></script>

<script src="plugins/sparklines/sparkline.js"></script>

<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

<script src="plugins/jquery-knob/jquery.knob.min.js"></script>

<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>

<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="plugins/summernote/summernote-bs4.min.js"></script>

<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script src="dist/js/adminlte.js?v=3.2.0"></script>

<script src="dist/js/demo.js"></script>

<script src="dist/js/pages/dashboard.js"></script>