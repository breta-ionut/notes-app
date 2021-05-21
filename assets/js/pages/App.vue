<script src="./App.js"></script>

<template>
    <router-view></router-view>

    <div v-if="userLoading">
        <div class="main-loader"></div>
    </div>
</template>
