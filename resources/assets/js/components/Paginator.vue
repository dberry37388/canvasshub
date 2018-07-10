<template>
    <ul class="pagination" v-if="shouldPaginate">
        <li v-show="prevUrl">
            <a href="#" aria-label="Previous" rel="prev" @click.prevent="page--">
                <span aria-hidden="true">&laquo; Previous</span>
            </a>
        </li>
        <li v-show="nextUrl">
            <a href="#" aria-label="Next" rel="next" @click.prevent="page++">
                <span aria-hidden="true">Next &raquo;</span>
            </a>
        </li>
    </ul>
</template>

<script>
    export default {
        name: 'paginator',
        props: ['dataSet'],
        data() {
            return {
                page: 1,
                prevUrl: false,
                nextUrl: false
            }
        },
        watch: {
            dataSet() {
                this.page = this.dataSet.meta.current_page;
                this.prevUrl = this.dataSet.links.prev;
                this.nextUrl = this.dataSet.links.next;
            },
            page() {
                this.broadcast().updateUrl();
            }
        },
        computed: {
            shouldPaginate() {
                return !! this.prevUrl || !! this.nextUrl;
            }
        },
        methods: {
            broadcast() {
                return this.$emit('changed', this.page);
            },
            updateUrl() {
                let filters = '?page=' + this.page;
                //
                let params = new URLSearchParams(location.search);

                console.log(location.search);

                if (params.has('hasVoted')) {
                    filters.concat('&hasVoted=' + params.get('hasVoted'));
                }
                //
                // if (params.has('mostRecent')) {
                //     filters.concat('&mostRecent=' + params.get('mostRecent'));
                // }
                //
                // if (params.has('gender')) {
                //     filters.concat('&gender=' + params.get('gender'));
                // }
                //
                // if (params.has('precinct')) {
                //     filters.concat('&precinct=' + params.get('precinct'));
                // }
                //
                // if (params.has('propensity')) {
                //     filters.concat('&propensity=' + params.get('propensity'));
                // }

                history.pushState(null, null, filters);
            }
        }
    }
</script>
