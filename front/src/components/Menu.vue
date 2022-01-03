<template>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse menu-container" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <router-link class="nav-link" to="/">Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/about">About</router-link>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <router-link class="nav-link" to="/login">Вход</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" to="/registration">Регистрация</router-link>
                            </li>
                        </ul>
                    </span>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    name: "Menu"
}
</script>

<style scoped>

</style>