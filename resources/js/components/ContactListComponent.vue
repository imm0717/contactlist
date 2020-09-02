<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Contacts</div>
                    <div class="card-body">
                        <nav class="navbar navbar-light bg-light">
                            <form class="form-inline">
                                <input class="form-control mr-sm-2" v-model="search_data" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" @click.prevent="search()">Search</button>
                            </form>
                        </nav>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">
                                        <button type="button" class="btn btn-primary btn-sm"
                                                @click="showModal()">Add
                                        </button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(contact, index) in contacts.data">
                                    <th scope="row">{{ ++index }}</th>
                                    <td>{{ contact.firstname }}</td>
                                    <td>{{ contact.lastname }}</td>
                                    <td>{{ contact.email }}</td>
                                    <td>{{ contact.contact_number }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" @click="showModal({...contact})">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-sm" @click="showModal({...contact}, true)">
                                            View
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" @click="deleteContact(contact.id)">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <pagination-component :paginator="paginator" @paginate="paginate($event)"/>

                        <contactform-component :contactdata="contactformdata" :disabled="modal_disabled" @contactAdded="onContactAdded()"></contactform-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ContactFormComponent from "./ContactFormComponent";
    import PaginationComponent from "./PaginationComponent";

    export default {
        name: "ContactListComponent",
        components: {
            'contactform-component': ContactFormComponent,
            'pagination-component': PaginationComponent
        },
        data: function () {
            return {
                contacts: [],
                contactformdata: {
                    id: null,
                    firstname: '',
                    lastname: '',
                    email: '',
                    contact_number: ''
                },
                paginator: {
                    total: 20,
                    per_page: 5,
                    current_page: 2,
                    last_page: 4
                },
                search_data: '',
                modal_disabled: false
            }
        },
        methods: {
            getContacts: function () {
                axios.get('/contacts').then((resp) => {
                    this.contacts = resp.data;
                    this.handelPaginationData(resp.data);
                }).catch(error => console.log(error))

            },
            search: function(){
                axios.get('/contacts?search=' + this.search_data).then((resp) => {
                    this.contacts = resp.data;
                    this.handelPaginationData(resp.data);
                }).catch(error => console.log(error))

            },
            onContactAdded: function(){
                $('#staticBackdrop').modal('hide');
                this.getContacts();
            },
            showModal: function (data, disabled = false) {
                this.contactformdata = (!data) ? {
                    id: null,
                    firstname: '',
                    lastname: '',
                    email: '',
                    contact_number: ''
                } : data;

                this.modal_disabled = disabled;

                $('#staticBackdrop').modal('show');
            },
            deleteContact: function(id){
                axios.delete('/contacts/' + id).then(response => {
                    this.getContacts();
                }).catch(error => {
                    console.log(error)
                })
            },
            paginate: function (page) {
                axios.get('/contacts?page='+page).then((resp) => {
                    this.contacts = resp.data
                    this.handelPaginationData(resp.data);
                }).catch(error => console.log(error))
            },
            handelPaginationData: function (data) {
                this.paginator.total = data.total;
                this.paginator.current_page = data.current_page;
                this.paginator.last_page = data.last_page;
                this.paginator.per_page = data.per_page;
            }
        },
        mounted: function () {
            this.getContacts()
        }
    }
</script>

<style scoped>

</style>
