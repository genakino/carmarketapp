<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Vehicle</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="vehicle.name">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Car Make</label>
                                    <input type="text" class="form-control" v-model="vehicle.make">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Model</label>
                                    <input type="text" class="form-control" v-model="vehicle.model">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Year</label>
                                    <input type="text" class="form-control" v-model="vehicle.year">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Mileage</label>
                                    <input type="text" class="form-control" v-model="vehicle.mileage">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Gearbox</label>
                                    <input type="text" class="form-control" v-model="vehicle.gearbox">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Fuel Type</label>
                                    <input type="text" class="form-control" v-model="vehicle.fuel_type">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Color</label>
                                    <input type="text" class="form-control" v-model="vehicle.color">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="text" class="form-control" v-model="vehicle.image">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    name:"add-vehicle",
    data(){
        return{
            vehicle:{
                name:"",
                make:"",
                model:"",
                year:"",
                mileage:"",
                gearbox:"",
                fuel_type:"",
                color:"",
                image:""
            }
        }
    },
    methods:{
        async create(){
            await this.axios.post('/api/vehicle', this.vehicle).then(response=>{
                this.$router.push({name:"vehicleList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>