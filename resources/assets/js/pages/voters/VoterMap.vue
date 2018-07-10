<template>
    <div>
        <gmap-map :center="center" :zoom="12" style="width:100%;  min-height: 500px;">
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
                @closeclick="infoWindow.open=false">
                <div>
                    <div class="mb-1">
                        <strong>{{ infoWindow.item.first_name }} {{ infoWindow.item.last_name }}</strong> ({{ infoWindow.item.age }}/{{ infoWindow.item.gender }})
                        <br> {{ infoWindow.item.propensity }}
                    </div>

                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
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
                                <th>{{ infoWindow.item.e_1 }}</th>
                                <th>{{ infoWindow.item.e_4 }}</th>
                                <th>{{ infoWindow.item.e_5 }}</th>
                                <th>{{ infoWindow.item.e_8 }}</th>
                                <th>{{ infoWindow.item.e_9 }}</th>
                                <th>{{ infoWindow.item.e_13 }}</th>
                                <th>{{ infoWindow.item.e_14 }}</th>
                            </tr>
                        </tbody>
                    </table>
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
                // default to Montreal to keep it simple
                // change this to whatever makes sense
                center: {
                    lat: 35.49,
                    lng:  -86.07
                },
                markers: [],
                shape: {
                    coords: [35, 35, 35, 86, 86, 86, 86, 35],
                    type: 'poly'
                },
                infoWindow: {
                    position: {lat: 0, lng: 0},
                    open: false,
                    template: '',
                    item: ''
                }
            };
        },

        mounted() {
            //this.geolocate();
            this.addMarkers();
        },

        methods: {
            geolocate() {
                navigator.geolocation.getCurrentPosition(position => {
                    let marker =  {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    this.markers.push({ position: marker });
                    this.center = marker;
                });
            },

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

                        response.data.data.forEach(function(voter) {
                            self.markers.push({
                                position: {
                                    lat: voter.latitude,
                                    lng: voter.longitude
                                },
                                content: voter
                            });
                        });
                    });
            },

            mapIcon (propensity) {
                if (propensity === 'Hard Republican') {
                    return 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
                }

                if (propensity === 'Hard Democrat') {
                    return 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
                }

                return 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
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
