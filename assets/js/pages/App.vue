<script src="./App.js"></script>

<template>
    <router-view></router-view>

    <div class="modal-backdrop show" v-if="activeModal"></div>

    <div class="container mt-xxl-5 pt-xxl-5" v-if="userLoading">
        <div class="col col-md-4 mx-auto main-loader"></div>
    </div>
</template>
