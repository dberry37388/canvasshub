<template>
    <div>
        <div class="col">
            <div class="card" v-for="item in items">
                <div class="card-body">
                    <div class="mb-3">
                        <div class="text-semibold">
                            <a :href="route('voters.show', {voter: item.id})">{{ item.first_name }} {{ item.last_name }}</a>
                        </div>

                        <div class="text-muted mb-2">
                            {{ item.age }} ({{ item.gender }})
                            <span v-if="item.propensity">/ {{ item.propensity }} </span>
                            <span v-if="item.propensity">/ {{ item.phone }}</span>
                        </div>

                        <div class="registered_address">
                            <i class="icon-location3"></i> {{ item.registered_address }}, {{ item.registered_city }}
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-xs table-bordered">
                            <thead>
                            <tr class="text-semibold bg-light">
                                <th>5/18</th>
                                <th>8/16</th>
                                <th>3/16</th>
                                <th>8/14</th>
                                <th>5/14</th>
                                <th>8/12</th>
                                <th>3/12</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <th>{{ item.e_1 }}</th>
                                <th>{{ item.e_4 }}</th>
                                <th>{{ item.e_5 }}</th>
                                <th>{{ item.e_8 }}</th>
                                <th>{{ item.e_9 }}</th>
                                <th>{{ item.e_13 }}</th>
                                <th>{{ item.e_14 }}</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
    import Paginator from '../../components/Paginator';

    export default {
        name: 'voter-list',

        components: {
            Paginator
        },

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
