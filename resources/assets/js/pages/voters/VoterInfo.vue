<template>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <div class="d-flex">
                    <div>
                        <a :href="route('voters.show', {voter: voter.id})">
                            <strong>{{ voter.first_name }} {{ voter.last_name }}</strong>
                        </a>
                    </div>

                    <div class="ml-auto">
                        <strong>{{ voter.pct_nbr }}</strong>
                    </div>
                </div>

                <div class="text-muted mb-2">
                    {{ voter.age }} ({{ voter.gender }})
                    <span v-if="voter.propensity">/ {{ voter.propensity }} </span>
                    <span v-if="voter.propensity">/ {{ voter.phone }}</span>
                </div>

                <div class="registered_address">
                    <i class="icon-location3"></i> {{ voter.registered_address }}, {{ voter.registered_city }}
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
                        <th>{{ voter.e_1 }}</th>
                        <th>{{ voter.e_4 }}</th>
                        <th>{{ voter.e_5 }}</th>
                        <th>{{ voter.e_8 }}</th>
                        <th>{{ voter.e_9 }}</th>
                        <th>{{ voter.e_13 }}</th>
                        <th>{{ voter.e_14 }}</th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'voter-info',
        props: ['voter']
    }
</script>
