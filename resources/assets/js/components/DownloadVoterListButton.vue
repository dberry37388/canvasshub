<template>
    <button class="btn btn-light" @click.prevent="downloadFile" :disabled="disabled">Export Voter List</button>
</template>

<script>
    export default {
        name: 'download-voter-list',
        data() {
            return {
                filters: {},
                filename: 'Coffee_County_Voter_List_',
                disabled: false
            }
        },
        created() {
            this.getParameters();
        },
        methods: {
            downloadFile() {

                this.disabled = true;

                axios({
                    url: route('exports.county', this.filters),
                    method: 'GET',
                    responseType: 'blob', // important
                }).then((response) => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', this.filename);
                    document.body.appendChild(link);
                    link.click();

                    this.disabled = false;
                });
            },

            getParameters() {
                let params = new URLSearchParams(location.search);

                if (params.has('precinct')) {
                    this.filters.precinct = params.get('precinct');
                    this.filename = this.filename + '_Precinct_' + params.get('precinct');
                }

                if (params.has('mostRecent')) {
                    this.filters.mostRecent = params.get('mostRecent');
                    this.filename = this.filename + '_Voted_Recently';
                }

                if (params.has('gender') && params.get('gender').length > 0) {
                    this.filters.gender = params.get('gender');
                    this.filename = this.filename + '_Gender_' + params.get('gender');
                }

                if (params.has('propensity') && params.get('propensity').length > 0) {
                    this.filters.propensity = params.get('propensity');
                    this.filename = this.filename + '_' + params.get('propensity');
                }

                this.filename = this.filename + '.xlsx';
            }
        }
    }
</script>
