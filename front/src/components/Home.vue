<template>
    <div class="container">
        <div class="row">
            <div>1111</div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            formItems: {
            },
            headers: {
                // 'Content-Type': 'text/plain',
                'credentials': 'include'
            },
            domain: 'http://127.0.0.1:7777'
        };
    },
    methods: {
        getUser: function() {
            const headers = this.headers;
            console.log('111111111111')

            axios.get(
                `${this.domain}/get-user`,
                {headers}
            )
                .then((response) => {
                    console.log('response', response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    },
    mounted: function() {
        this.getUser()
    }
}


</script>