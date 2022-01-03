<template>
    <div class="container">
        <div class="row justify-content-center">
            <div v-if="success" class="alert alert-success" role="alert">
                {{success}}
            </div>
            <div v-if="error" class="alert alert-danger" role="alert">
                {{error}}
            </div>
            <h2 class="text-center">Регистрация</h2>
            <form class="col-6" @submit="saveUser" method="post">
                <div class="form-group mb-2">
                    <label for="loginInput">Логин</label>
                    <input type="text" v-model="formItems.login" class="form-control" id="loginInput" placeholder="Логин">
                </div>
                <div class="form-group mb-2">
                    <label for="exampleInputPassword">Пароль</label>
                    <input type="password" v-model="formItems.password" class="form-control" id="exampleInputPassword" placeholder="Пароль">
                </div>
                <div class="form-group mb-2">
                    <label for="nameInput">Имя</label>
                    <input type="text" v-model="formItems.first_name" class="form-control" id="nameInput" placeholder="Имя">
                </div>
                <div class="form-group mb-2">
                    <label for="surNameInput">Фамилия</label>
                    <input type="text" v-model="formItems.sur_name" class="form-control" id="surNameInput" placeholder="Фамилия">
                </div>
                <div class="form-group mb-2">
                    <label for="ageInput">Возраст</label>
                    <input type="number" v-model="formItems.age" class="form-control" id="ageInput" placeholder="Возраст">
                </div>
                <div class="form-group mb-2">
                    <label for="cityInput">Город</label>
                    <input type="text" v-model="formItems.city" class="form-control" id="cityInput" placeholder="Город">
                </div>
                <div class="form-group mb-2">
                    <label for="interestsTextarea">Интересы</label>
                    <textarea class="form-control" v-model="formItems.interest" id="interestsTextarea"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Зарегистрировать</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "registration",
    data() {
        return {
            formItems: {
               login: 'Логин',
               password: 'пароль',
               first_name: 'имя',
               sur_name: '',
               age: null,
               city: '',
               interest: '',
            },
            error: '',
            success: '',
            headers: {
                'Content-Type': 'text/plain'
            },
            domain: 'http://127.0.0.1:7777'
        }
    },
    methods: {
        saveUser: function (e) {
            e.preventDefault();
            const headers = this.headers;

            axios.post(`${this.domain}/registration`, {
                    'form': this.formItems
                },
                {headers}
            )
                .then((response) => {
                    let data = response.data

                    if (data.error) {
                        this.error = data.error
                    }

                    if (data.success) {
                        this.success = data.success
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }
}
</script>

<style scoped>

</style>