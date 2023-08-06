<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Vehicle</h4>
                </div>
                <div class="card-body">
                    
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
                                <button type="button" class="btn btn-primary">Back</button>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
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
                mileage:"",
                gearbox:"",
                fuel_type:"",
                color:"",
                image:""
            }
        }
    },
    mounted(){
        this.showVehicle()
    },
    methods:{
        async showVehicle(){
            await this.axios.get('/api/vehicle/'+this.$route.params.id).then(response=>{
                const { 
                    name,
                    make,
                    model,
                    year,
                    mileage,
                    gearbox,
                    fuel_type,
                    color,
                    image 
                } = response.data

                this.vehicle.name = name
                this.vehicle.make = make
                this.vehicle.model = model
                this.vehicle.year = year
                this.vehicle.mileage = mileage
                this.vehicle.gearbox = gearbox
                this.vehicle.fuel_type = fuel_type
                this.vehicle.color = color
                this.vehicle.image = image

            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>