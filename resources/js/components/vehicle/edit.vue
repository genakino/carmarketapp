<template>
    <div class="container mt-5 mb-5">
        <h2>Update Vehicle</h2>
        <hr>
        <form @submit.prevent="update">
            <div class="form-group row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-8">
                    <!-- <input type="file" class="form-control" @change="onChange"> -->
                    <input type="text" class="form-control" v-model="vehicle.image">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.name">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="make" class="col-sm-2 col-form-label">Make</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.make">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="model" class="col-sm-2 col-form-label">Model</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.model">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="year" class="col-sm-2 col-form-label">Year</label>
                <div class="col-sm-8">
                    <select name="year" class="form-control"v-model="vehicle.year">
                        <option value="" disabled>Choose Year</option>
                        <option v-for="year in yearList" :value="year">
                            {{ year }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="gearbox" class="col-sm-2 col-form-label">Gearbox</label>
                <div class="col-sm-8">
                    <select name="gearbox" class="form-control"v-model="vehicle.gearbox">
                        <option v-for="gearbox in gearbox_options" :value="gearbox.value">
                            {{ gearbox.text }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="fuel_type" class="col-sm-2 col-form-label">Fuel Type</label>
                <div class="col-sm-8">
                    <select name="fuel_type" class="form-control" v-model="vehicle.fuel_type">
                        <option v-for="fuel_type in fuel_type_options" :value="fuel_type.value">
                            {{ fuel_type.text }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="price" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.price">
                </div>
            </div>

            <div class="form-group row  mb-3">
                <div class="col-sm-8">
                    <button type="button" class="btn btn-secondary" @click="goBack">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Vehicle</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default{
    name:"update-vehicle",
    data(){
        return{
            vehicle:{
                name:"",
                make:"",
                model:"",
                year:"",
                gearbox:"",
                fuel_type:"",
                image:"",
                price:"",
                _method:"patch"
            },
            startYear: 2000,
            endYear: new Date().getFullYear(),
            gearbox_options: [
                {text: 'Automatic', value:'automatic'},
                {text: 'Manual', value:'manual'}
            ],
            fuel_type_options: [
                {text: 'Petrol', value:'petrol'},
                {text: 'Diesel', value:'diesel'}
            ]
        }
    },
    computed: {
        yearList() {
        const years = [];
        for (let i = this.endYear; i >= this.startYear; i--) {
            years.push(i);
        }
        return years;
        },
    },
    mounted(){
        this.showVehicle()
    },
    methods:{
        goBack() {
            this.$router.go(-1)
        },
        async showVehicle(){
            await this.axios.get('/api/vehicle/'+this.$route.params.id).then(response=>{
                const { 
                    name,
                    make,
                    model,
                    year,
                    gearbox,
                    fuel_type,
                    image,
                    price 
                } = response.data
                this.vehicle.name = name
                this.vehicle.make = make
                this.vehicle.model = model
                this.vehicle.year = year
                this.vehicle.gearbox = gearbox
                this.vehicle.fuel_type = fuel_type
                this.vehicle.image = image
                this.vehicle.price = price
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            await this.axios.post('/api/vehicle/'+this.$route.params.id, this.vehicle).then(response=>{
                this.$router.push({name:"vehicleList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>