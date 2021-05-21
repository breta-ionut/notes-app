<script src="./Navbar.js"></script>

<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../../images/logo.png" alt="Notes" width="48" height="48" />
            </a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">My profile</a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" @click.prevent="logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
