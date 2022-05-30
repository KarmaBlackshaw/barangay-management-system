<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
<link rel="icon" href="assets/img/icon.ico" type="image/x-icon" />

<!-- Fonts and icons -->
<script src="assets/js/plugin/webfont/webfont.min.js"></script>
<script>
WebFont.load({
  google: {
    "families": ["Lato:300,400,700,900"]
  },
  custom: {
    "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
      "simple-line-icons"
    ],
    urls: ['assets/css/fonts.min.css']
  },
  active: function() {
    sessionStorage.fonts = true;
  }
});
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/atlantis.css">
<link rel="stylesheet" href="assets/css/custom.css">

<style>
#loading-container {
  position: absolute;
  display: flex;
  height: 100%;
  width: 100%;
  background-color: white;
  z-index: 9999;
}

#loading-screen {
  position: absolute;
  left: 48%;
  top: 48%;
  z-index: 9999;
  text-align: center;
}

a {
  text-decoration: none;
}


/* body,
html,
.preloader {
  background-color: #18181b !important;
  color: #a1a1aa !important;
}

th,
td {
  color: #a1a1aa !important;
}

.card {
  background-color: #27272a;
}

.card-title {
  color: #d4d4d8;
}

.card-header {
  border-bottom: 1px solid #27272a !important;
}

.modal-content {
  background-color: #27272a;
}

input,
textarea,
select {
  background-color: #18181b !important;
  color: #d4d4d8 !important;
  border-color: #27272a !important;
}

.footer {
  background-color: #18181b;
  border-top: 1px solid #27272a;
}

    .form-check>.btn-group>label {
      border: 1px solid #3f3f46;
    }


.form-control:disabled, .form-control[readonly] {
  background: #171717!important;
  border: 1px solid #262626!important;
}

.sidebar-wrapper {
  background-color: #18181b !important;
  border-right: 1px solid #27272a;
} */

</style>
