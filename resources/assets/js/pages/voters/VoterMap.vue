<template>
    <div>
        <gmap-map :center="center" :zoom="12" style="width:100%;  min-height: calc(100vh - 104px);">
            <gmap-marker
                v-for="m in markers"
                :position="m.position"
                :clickable="true"
                :key="m.id"
                :icon="mapIcon (m.content.propensity)"
                @click="openInfoWindowTemplate(m.content)">
            </gmap-marker>

            <gmap-info-window
                :options="{maxWidth: 300}"
                :position="infoWindow.position"
                :opened="infoWindow.open"
                @closeclick="infoWindow.open=false"
                v-if="infoWindow.item"
            >
                <div>
                    <div class="mb-1">
                        <div class="mb-0">
                            <a :href="route('voters.show', {voter: infoWindow.item.id})">
                                <strong>{{ infoWindow.item.first_name }} {{ infoWindow.item.last_name }}</strong>
                            </a>
                        </div>

                        <span class="font-size-sm">
                            ({{ infoWindow.item.age }}/{{ infoWindow.item.gender }}) / {{ infoWindow.item.propensity }}
                        </span>

                        <div class="mt-2">
                            <i class="icon-location3"></i> {{ infoWindow.item.registered_address }}
                        </div>
                    </div>
                </div>
            </gmap-info-window>
        </gmap-map>
    </div>
</template>

<script>
    export default {
        name: "voter-map",
        data() {
            return {
                center: {
                    lat: 35.4817432,
                    lng: -86.0885993
                },
                markers: [],
                infoWindow: {
                    position: {lat: 0, lng: 0},
                    open: false,
                    template: '',
                    item: ''
                }
            };
        },

        created() {
            this.addMarkers();
        },

        methods: {
            openInfoWindowTemplate (item) {
                this.infoWindow.position = {
                    lat: item.latitude,
                    lng: item.longitude
                };

                this.infoWindow.open = true;
                this.infoWindow.item = item;
            },

            addMarkers() {
                axios.get(this.url())
                    .then(response => {
                        let self = this;
                        let center = {};

                        response.data.data.forEach(function(voter) {
                            self.markers.push({
                                position: {
                                    lat: voter.latitude,
                                    lng: voter.longitude
                                },
                                content: voter,
                            });

                            center = {
                                lat: voter.latitude,
                                lng: voter.longitude
                            };
                        });

                        this.center = center;
                    });
            },

            mapIcon (propensity) {
                if (propensity === 'Hard Republican') {
                    return 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'
                }

                if (propensity === 'Hard Democrat') {
                    return 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'
                }

                return 'https://maps.google.com/mapfiles/ms/icons/green-dot.png'
            },

            url() {
                let filters = {};

                let params = new URLSearchParams(location.search);

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

                return route('api.votermap.index', filters);
            },
        }
    };
</script>
