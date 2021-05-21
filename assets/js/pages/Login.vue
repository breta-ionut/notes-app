<script src="./Login.js"></script>

<template>
    <div class="container mt-xxl-5">
        <form class="col col-md-4 mx-auto border border-start rounded rounded-2 p-4" @submit.prevent="login">
            <div class="alert alert-danger" v-if="errors.global.length">
                <p class="mb-0" v-for="error in errors.global">{{ error }}</p>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>

                <input type="text" name="username" id="username" class="form-control" :class="{'border-danger': errors.fields.username}" placeholder="john.doe" required v-model="username" />

                <p class="form-text text-danger" v-for="error in errors.fields.username">{{ error }}</p>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>

                <input type="password" name="password" id="password" class="form-control" :class="{'border-danger': errors.fields.password}" placeholder="********" required v-model="password" />

                <p class="form-text text-danger" v-for="error in errors.fields.password">{{ error }}</p>
            </div>

            <div>
                <input type="submit" name="submit" value="Login" class="btn btn-primary" />
            </div>
        </form>
    </div>
</template>
