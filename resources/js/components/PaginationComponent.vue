<template>
    <nav aria-label="...">
        <ul class="pagination justify-content-center">
            <li class="page-item" v-bind:class="{disabled: paginator.current_page == 1}">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true" @click.prevent="previous()">Previous</a>
            </li>

            <li v-for="n in total_pages" class="page-item" v-bind:class="{ active: n==paginator.current_page}">
                <a class="page-link" href="#" @click.prevent="paginateTo(n)">{{n}}<span v-if="n==paginator.current_page" class="sr-only">(current)</span></a>
            </li>

            <li class="page-item" v-bind:class="{disabled: paginator.current_page == total_pages}">
                <a class="page-link" href="#" @click.prevent="next()">Next</a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: "PaginationComponent",
        props: ['paginator'],
        computed: {
            total_pages: function () {
                return Math.ceil(this.paginator.total / this.paginator.per_page)
            }
        },
        methods: {
            next: function () {
                let page = (this.paginator.current_page < this.total_pages) ? this.paginator.current_page + 1 : this.paginator.current_page;
                this.paginator.current_page = page;
                this.$emit('paginate', page)
            },
            previous: function () {
                let page = (this.paginator.current_page > 1 ) ? this.paginator.current_page - 1 : this.paginator.current_page;
                this.paginator.current_page = page;
                this.$emit('paginate', page)
            },
            paginateTo: function (pageNumber) {
                this.paginator.current_page = pageNumber;
                this.$emit('paginate', pageNumber)
            }
        }
    }
</script>

<style scoped>

</style>
