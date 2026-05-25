<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg shadow-sm px-4">
 
    <!-- LOGO -->
    <a class="navbar-brand text-white fw-bold d-flex align-items-center" href="#">
        <i class="fa-solid fa-heart-pulse me-2"></i>
        MedPatient
    </a>
 
    <!-- TOGGLE BUTTON -->
    <button class="navbar-toggler bg-light"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
 
        <span class="navbar-toggler-icon"></span>
 
    </button>
 
    <!-- NAV ITEMS -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
 
        <!-- NAV LINKS -->
        <ul class="navbar-nav align-items-center">
 
            <li class="nav-item">
                <a class="nav-link text-white active" href="#">
                    Home
                </a>
            </li>
 
            <li class="nav-item">
                <a class="nav-link text-white" href="#">
                    About
                </a>
            </li>
 
            <li class="nav-item">
                <a class="nav-link text-white" href="#">
                    Contact
                </a>
            </li>
 
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('login') }}">
                    Login
                </a>
            </li>
 
        </ul>
 
    </div>
 
</nav>
 
<!-- STYLE -->
<style>
 
    *{
        font-family: "Segoe UI", Arial, sans-serif;
    }
 
    body{
        padding-top: 80px;
        margin: 0;
    }
 
    /* FIXED NAVBAR */
    .navbar{
 
        /* NEW COLOR */
        background-color: #2FA4C8;
 
        padding-top: 12px;
        padding-bottom: 12px;
 
        position: fixed;
        top: 0;
        width: 100%;
 
        z-index: 999;
 
        /* GLASS EFFECT */
        backdrop-filter: blur(6px);
 
    }
 
    /* LOGO */
    .navbar-brand{
        font-size: 22px;
        letter-spacing: 0.5px;
    }
 
    /* NAV LINKS */
    .nav-link{
 
        margin: 0 8px;
 
        transition: 0.3s;
 
        font-weight: 500;
 
        font-size: 16px;
 
        position: relative;
    }
 
    /* HOVER EFFECT */
    .nav-link:hover{
        opacity: 0.8;
    }
 
    /* UNDERLINE EFFECT */
    .nav-link::after{
 
        content: '';
 
        position: absolute;
 
        left: 0;
        bottom: -3px;
 
        width: 0%;
 
        height: 2px;
 
        background-color: white;
 
        transition: 0.3s;
    }
 
    .nav-link:hover::after{
        width: 100%;
    }
 
</style>