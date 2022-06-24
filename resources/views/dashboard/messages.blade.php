@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/messages.js') }}" defer></script>

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col">
                <h1>Invia un messaggio</h1>
                {{-- <div v-if="validity" class="alert alert-success" role="alert">
                    {{ validity }}
                </div> --}}
                <form @submit.prevent="SendMessage" action="api/messages" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" v-model="name" required autocomplete="name">
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Cognome</label>
                        <input type="text" class="form-control" id="surname" name="surname" v-model="surname">
                    </div>
                    <div class="mb-3">
                        <label for="sender_mail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="sender_mail" name="sender_mail" v-model="sender_mail" required autocomplete="sender_mail">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Messaggio</label>
                        <textarea class="form-control" id="content" name="content" v-model="content"></textarea>
                    </div>
                    <button class="btn btn-primary">Invia</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        import axios from "axios";
        
        const ApiUrl = "/api/messages";
        const name = "";
        const surname = "";
        const sender_mail = "";
        const content = "";
        const validity =  "";
        
        
        SendMessage() {
            axios.post(ApiUrl, {
                name: name,
                surname: surname,
                sender_mail: sender_mail,
                content: content
            })
            .then(element => validity = element.data.validity)
        }
        
    </script>
@endsection