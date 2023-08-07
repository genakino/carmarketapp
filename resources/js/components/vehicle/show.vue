<template>
        <div class="container mt-5 mb-5">
        <h2>Vehicle Details</h2>
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
                    <input type="text" class="form-control" v-model="vehicle.name" readonly>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="make" class="col-sm-2 col-form-label">Make</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.make" readonly>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="model" class="col-sm-2 col-form-label">Model</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.model" readonly>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="year" class="col-sm-2 col-form-label">Year</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.year" readonly>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="gearbox" class="col-sm-2 col-form-label">Gearbox</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.gearbox" readonly>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="fuel_type" class="col-sm-2 col-form-label">Fuel Type</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.fuel_type" readonly>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="price" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.price" readonly>
                </div>
            </div>

            <div class="form-group row  mb-3">
                <div class="col-sm-8">
                    <button type="button" class="btn btn-secondary" @click="goBack">Back</button>
                    <button type="submit" class="btn btn-primary" @click="goUpdate">Update Vehicle</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default{
    name:"show-vehicle",
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
                price:""
            }
        }
    },
    mounted(){
        this.showVehicle()
    },
    methods:{
        goBack() {
            this.$router.go(-1)
        },
        goUpdate() {
            this.$router.push({name:"vehicleEdit"})
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
        }
    }
}
</script>