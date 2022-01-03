<template>
    <div id="home" class="container">
        <div v-if="!questionForm">
            <h2>Представтесь</h2>
            <form @submit="saveUser" method="post">
                <div class="form-group mb-2">
                    <label for="fio">Как вас зовут?</label>
                    <input name="fio" v-model="formItems.fio" type="text" class="form-control" id="fio" placeholder="ФИО">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div v-if="questionForm && !endTestText">
            <h2>Тест</h2>
            <form @submit="saveTest" method="post">
                <div v-if="!question.multiple" class="form-group mb-2">
                    <div>{{question.name}}</div>
                    <p v-for="(item, i) in answer">
                        <input
                            v-model="formItems.answer"
                            type="radio" :value="item.text"
                            v-on:click="generalInformation(item.nextQuestion, item.id)"
                        >
                        {{item.text}}
                    </p>
                </div>
                <div v-if="question.multiple" class="form-group mb-2">
                    <div>{{question.name}}</div>
                    <p v-for="(item, i) in answer">
                        <input
                            v-model="formItems.answer[i]"
                            type="checkbox" :value="item.text"
                            v-on:click="generalInformation(item.nextQuestion, item.id)"
                        >
                        {{item.text}}
                    </p>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div v-if="endTestText">
            <h1>{{endTestText}}</h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Вопрос</th>
                    <th scope="col">Количество ответов</th>
                    <th scope="col">Доля</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, i) in resultTest">
                    <th scope="row">{{i+1}}</th>
                    <td>{{item.name}}</td>
                    <td>{{item.count}}</td>
                    <td>{{item.share}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            formItems: {
                fio: '',
                answer: [],
                questionId: 0,
                answerIds: [],
                nextQuestion: false,
                userId: 0,
                sort: 0
            },
            resultTest: [],
            questionForm: false,
            question: {},
            answer: {},
            endTestText: '',
            headers: {
                'Content-Type': 'text/plain'
            }
        };
    },
    methods: {
        saveUser: function(e) {
            e.preventDefault();
            const headers = this.headers;

            axios.post(`http://127.0.0.1:7777/save-user`, {
                    fio: this.formItems.fio,
                },
                {headers}
            )
                .then((response) => {
                    let data = response.data.userId;
                    this.formItems.userId = data;
                    this.questionForm = !!data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        saveTest: function(e) {
            e.preventDefault();
            const headers = this.headers;
            this.formItems.questionId = this.question.id;
            this.formItems.sort = this.question.sort;

            axios.post(`http://127.0.0.1:7777/save-test`,
                this.formItems,
                {headers}
            )
                .then((response) => {
                    if (this.formItems.nextQuestion) {
                        this.getQuestion();
                    } else {
                        this.endTestText = 'Благодарим за тест!';
                        this.getResultTest();
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        generalInformation: function(nextQuestion, answerId) {
            this.formItems.nextQuestion = !!nextQuestion;
            this.formItems.answerIds.push(answerId);
        },
        getQuestion: function() {
            axios.get(`http://127.0.0.1:7777/question?sort=${this.formItems.sort}`)
                .then((response) => {
                    let data = response.data;
                    this.question = data.question;
                    this.answer = data.answer;
                    this.formItems.answer = []
                    this.formItems.answerIds = []
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getResultTest: function() {
            axios.get(`http://127.0.0.1:7777/result-test`)
                .then((response) => {

                    console.log('response', response)

                    this.resultTest = response.data.resultTest


                    console.log('this.resultTest', this.resultTest)
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    },
    watch: {
        questionForm: function() {
            if (this.questionForm) {
                this.getQuestion();
            }
        }
    }
}


</script>