<template>
    <div>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Precinct</th>
                <th>Propensity</th>
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
            <tr v-for="item in items">
                <td>{{ item.first_name }}</td>
                <td>{{ item.last_name }}</td>
                <td>{{ item.age }}</td>
                <td>{{ item.gender }}</td>
                <td>{{ item.registered_address }}, {{ item.registered_city }}</td>
                <td>{{ item.phone }}</td>
                <td>{{ item.pct_nbr }}</td>
                <td>{{ item.propensity }}</td>
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
