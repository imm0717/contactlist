<template>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ this.modalTitle }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" v-model="contactdata.firstname" class="form-control" id="firstname" aria-describedby="Firstname">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" v-model="contactdata.lastname" class="form-control" id="lastname" aria-describedby="Listname">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" v-model="contactdata.email" class="form-control" id="email" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact number</label>
                            <input type="text" v-model="contactdata.contact_number" class="form-control" id="contact" aria-describedby="Listname">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="addContact(contactdata)">Submit</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ContactFormComponent",
        props: ['contactdata'],
        data: ()=> {
            return {

            }
        },
        computed: {
            modalTitle: function () {
                return (this.contactdata.id) ? 'Edit Contact' : 'New Contact';
            }
        },
        methods: {
            addContact: function (data) {
                if (!data.id){
                    console.log('Add')
                    axios.post('/contacts', data).then((resp) => {
                        this.$emit("contactAdded")
                    }).catch(error => {
                        console.log(error)
                    })
                }else{
                    console.log('Edit')
                    axios.put('/contacts/' + data.id, data).then((resp) => {
                        this.$emit("contactAdded")
                    }).catch(error => {
                        console.log(error)
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>
