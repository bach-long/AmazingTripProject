<style>
    /* Navigation Start here */
    nav {
        background-color: var(--nav-light-blue);
        padding: 5px 10px;
        z-index: 100;
    }

    .nav-logo {
        height: 40px;
        width: 142px;
    }

    .input-group {
        border-radius: 20px;
        background-color: var(--white);
        padding: 0 15px;
        color: var(--text-light-gray);
        height: 35px;
        width: 420px;
    }

    .search-icon {
        font-size: 18px;
        color: rgba(0, 0, 0, 0.2);
    }

    .delete-icon {
        font-size: 14px;
        visibility: hidden;
    }


    .search-bar input {
        font-size: 14px;
        color: var(--background-dark-blue);
        outline: none;
    }

    .search-bar input::placeholder {
        color: rgba(0, 0, 0, 0.2);
    }

    .input-group:focus-within {
        border: 2px solid var(--background-dark-blue);
    }

    .input-group:focus-within i {
        color: var(--background-dark-blue);
    }

    .input-group:focus-within .delete-icon {
        visibility: visible;
    }

    .user-avatar {
        height: 35px;
        width: 35px;
    }

    .message i, .notification i {
        font-size: 20px;
        color: var(--text-light-gray);
    }

    .message i:hover, .notification i:hover {
        color: var(--background-dark-blue);
    }
    /* Navigation End here */
</style>

<nav class="sticky-top">
    <div class="container-fluid d-sm-flex justify-content-between align-items-center">
        <a href="#">
            <img src="./assets/img/Ver1.png" alt="Logo" class="nav-logo">
        </a>
        <div class="search-bar">
            <form action="#">
                <div class="input-group d-sm-flex align-items-center">
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass me-sm-2"></i></span>
                    <input class="flex-grow-1" type="text" placeholder="Nơi bạn muốn tới...">
                    <span class="delete-icon"><i class="fa-solid fa-xmark ps-2"></i></span>
                </div>
            </form>
        </div>
        <ul class="list-unstyled d-sm-flex align-items-center m-0 nav-left-group">
            <li class="message"><i class="fa-brands fa-facebook-messenger"></i></li>
            <li class="notification"><i class="fa-solid fa-bell ms-sm-2"></i></li>
            <li class="user-avatar">
                <img src="./assets/img/a.jpg" alt="User-avatar" class="rounded-circle ms-sm-2 user-avatar">
            </li>
        </ul>
    </div>
</nav>