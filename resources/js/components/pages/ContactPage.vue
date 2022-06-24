<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Contacts</h1>
                <div v-if="validity" class="alert alert-success" role="alert">
                    {{ validity }}
                </div>
                <form @submit.prevent="SendMessage" action="api/contact" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" v-model="name">
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" v-model="surname">
                    </div>
                    <div class="mb-3">
                        <label for="sender_mail" class="form-label">Mail</label>
                        <input type="text" class="form-control" id="sender_mail" name="sender_mail" v-model="sender_mail">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">content</label>
                        <textarea class="form-control" id="content" name="content" v-model="content"></textarea>
                    </div>
                    <button class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    name: 'ContactPage',
    data() {
        return{
            ApiUrl: "/api/contact",
            name: "",
            surname: "",
            sender_mail: "",
            content: "",
            validity: "",

        }
    },
    methods: {
        SendMessage() {
            Axios.post(this.ApiUrl, {
                name: this.name,
                surname: this.surname,
                sender_mail: this.sender_mail,
                content: this.content,
            })
            .then(element => this.validity = element.data.validity)
            console.log(this.validity)
        }
        
    }
}
</script>

<style scoped>

</style>