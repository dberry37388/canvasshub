<template>
    <div>
        <div class="col" v-for="item in items">
            <voter-info :voter="item"></voter-info>
        </div>

        <div class="mt-4">
            <ul class="pagination pagination-pager justify-content-center">
                <li class="page-item"><a href="#" class="page-link" @click="fetch(pagination.prev)" v-if="pagination.prev">Previous</a></li>
                <li class="page-item"><a href="#" class="page-link" @click="fetch(pagination.next)" v-if="pagination.next">Next</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
    import VoterInfo from '../../pages/voters/VoterInfo';

    export default {
        name: 'voter-list',
        components: { VoterInfo },

        data: () => ({
            dataSet: {},
            items: [],
            pagination: {}
        }),

        created() {
            this.fetch();
        },

        methods: {
            fetch(page) {
                axios.get(this.url(page)).then(this.refresh);
            },

            url(page) {
                let filters = {};

                let params = new URLSearchParams(location.search);

                if (page) {
                    page = new URL(page);
                    let pageParams = new URLSearchParams(page.search);

                    filters.page = pageParams.get('page');
                }

                if (params.has('hasVoted')) {
                    filters.hasVoted = params.get('hasVoted');
                }

                if (params.has('mostRecent')) {
                    filters.mostRecent = params.get('mostRecent');
                }

                if (params.has('gender')) {
                    filters.gender = params.get('gender');
                }

                if (params.has('precinct')) {
                    filters.precinct = params.get('precinct');
                }

                if (params.has('propensity')) {
                    filters.propensity = params.get('propensity');
                }

                return route('api.voters.index', filters);
            },

            refresh({data}) {
                this.dataSet = data;
                this.items = data.data;
                this.makePagination(data);
                window.scrollTo(0, 0);
            },

            makePagination: function(data){
                 this.pagination = {
                     current: data.meta.current,
                     next: data.links.next,
                     prev: data.links.prev,
                     first_page_url: data.links.first,
                     last_page_url: data.links.last,
                };

                this.$set('pagination', pagination)
            }
        }
    }
</script>
