const { createApp } = Vue

createApp({
    data() {
        return {
            lat1: '',
            lon1: '',
            lat2: '',
            lon2: '',
            errors: {
                lat1: null,
                lon1: null,
                lat2: null,
                lon2: null
            },
            allCoordinatesProvidedAndValid: false,
            distance_km: '',
            distance_m: ''
        }
    },
    mounted() {
        //console.log('It works!');
    },
    watch: {
        lat1(value) {
            this.lat1 = value;
            const validationResult = this.validateLatitude(value);
            if (validationResult.valid) {
                this.errors.lat1 = null;
            } else {
                this.errors.lat1 = validationResult.message;
            }
            this.updateDistancePanel();
        },
        lon1(value) {
            this.lon1 = value;
            const validationResult = this.validateLongitude(value);
            if (validationResult.valid) {
                this.errors['lon1'] = null;
            } else {
                this.errors['lon1'] = validationResult.message;
            }
            this.updateDistancePanel();
        },
        lat2(value) {
            this.lat2 = value;
            const validationResult = this.validateLatitude(value);
            if (validationResult.valid) {
                this.errors['lat2'] = null;
            } else {
                this.errors['lat2'] = validationResult.message;
            }
            this.updateDistancePanel();
        },
        lon2(value) {
            this.lon2 = value;
            const validationResult = this.validateLongitude(value);
            if (validationResult.valid) {
                this.errors['lon2'] = null;
            } else {
                this.errors['lon2'] = validationResult.message;
            }
            this.updateDistancePanel();
        }
    },
    methods: {
        validateLatitude(lat) {
            if (!lat) {
                return {
                    'valid': true,
                    'message': null
                }
            }
            if (!/^-?\d+(\.\d{1,6})?$/.test(lat)) {
                return {
                    'valid': false,
                    'message': 'Format must be 00.000000'
                };
            }
            const latFloat = parseFloat(lat);
            if (latFloat < -90 || latFloat > 90) {
                return {
                    'valid': false,
                    'message': 'Value must be between -90 and 90'
                };
            }
            return {
                'valid': true,
                'message': null
            };
        },
        validateLongitude(lon) {
            if (!lon) {
                return {
                    'valid': true,
                    'message': null
                }
            }
            if (!/^-?\d+(\.\d{1,6})?$/.test(lon)) {
                return {
                    'valid': false,
                    'message': 'Format must be 000.000000'
                };
            }
            const lonFloat = parseFloat(lon);
            if (lonFloat < -180 || lonFloat > 180) {
                return {
                    'valid': false,
                    'message': 'Value must be between -180 and 180'
                };
            }
            return {
                'valid': true,
                'message': null
            };
        },
        updateDistancePanel() {
            if (!this.lat1 || !this.lon1 || !this.lat2 || !this.lon2) {
                this.allCoordinatesProvidedAndValid = false;
                return;
            }
            if (this.errors.lat1 || this.errors.lon1 || this.errors.lat2 || this.errors.lon2) {
                this.allCoordinatesProvidedAndValid = false;
                return;
            }
            let vueThis = this;
            axios
                .get('/api/distance.php?lat1=' + this.lat1 + "&lon1=" + this.lon1 + "&lat2=" + this.lat2 + "&lon2=" + this.lon2)
                .then(function (response) {              
                    vueThis.distance_km = response.data.distance_kilometers;
                    vueThis.distance_m = response.data.distance_meters;
                    vueThis.allCoordinatesProvidedAndValid = true;
                });
        }
    }
}).mount('#vue-geo-app')