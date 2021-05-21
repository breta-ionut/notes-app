<script src="./Login.js"></script>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>

            <form class="col-md-4" @submit.prevent="login">
                <div v-if="errors.global.length">
                    <p class="text-danger" v-for="error in errors.global">{{ error }}</p>
                </div>

                <div class="form-group">
                    <label for="username">Email</label>

                    <input type="text" name="username" id="username" class="form-control" :class="{'border-danger': errors.fields.username}" placeholder="john.doe@example.com" required v-model="username" />

                    <p class="text-danger" v-for="error in errors.fields.username">{{ error }}</p>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <input type="password" name="password" id="password" class="form-control" :class="{'border-danger': errors.fields.password}" placeholder="********" required v-model="password" />

                    <p class="text-danger" v-for="error in errors.fields.password">{{ error }}</p>
                </div>

                <input type="submit" name="submit" value="Login" class="btn btn-default" />
            </form>
        </div>
    </div>
</template>
