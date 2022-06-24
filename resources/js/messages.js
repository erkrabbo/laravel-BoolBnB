import axios from "axios";

const ApiUrl = "/messages";
const name = "";
const surname = "";
const sender_mail = "";
const content = "";
const validity =  "";


SendMessage(); {
    axios.post(ApiUrl, {
        name: name,
        surname: surname,
        sender_mail: sender_mail,
        content: content
    })
    .then(element => validity = element.data.validity)
}
