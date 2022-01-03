<template>
    <div class="container">
        <div class="row justify-content-center">
            <div v-if="success" class="alert alert-success" role="alert">
                {{success}}
            </div>
            <div v-if="error" class="alert alert-danger" role="alert">
                {{error}}
            </div>
            <h2 class="text-center">Авторизация</h2>
            <form class="col-6" @submit="authUser" method="post">
                <div class="form-group mb-2">
                    <label for="loginInput">Логин</label>
                    <input type="text" v-model="formItems.login" class="form-control" id="loginInput" placeholder="Логин">
                </div>
                <div class="form-group mb-2">
                    <label for="exampleInputPassword1">Пароль</label>
                    <input type="password" v-model="formItems.password" class="form-control" id="exampleInputPassword1" placeholder="Пароль">
                </div>
                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Запоминть меня</label>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            formItems: {
                login: '',
                password: ''
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
        authUser: function (e) {
            e.preventDefault();
            const headers = this.headers;

            axios.post(`${this.domain}/login`, {
                    'form': this.formItems
                },
                {headers}
            )
                .then((response) => {
                    let data = response.data
                    this.error = ''
                    this.success = ''

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
