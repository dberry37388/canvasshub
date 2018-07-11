<template>
    <div>
        <voter-info :voter="voter" v-if="ready"></voter-info>
    </div>
</template>

<script>
    import VoterInfo from '../../pages/voters/VoterInfo';


    export default {
        name: 'voter-detail',
        props: ['id'],
        components: { VoterInfo },
        data() {
            return {
                voter: {},
                ready: false
            }
        },

        created() {
            axios.get(route('api.voters.show', {voter: this.id}))
                .then(response => {
                    this.voter = response.data.data;
                    this.ready = true;
                });
        }
    }
</script>
