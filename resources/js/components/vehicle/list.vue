<template>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <router-link :to='{ name:"vehicleAdd"}' class="btn btn-primary">Add Vehicle</router-link>
            </div>
        </div>
        <div class="row" v-if="vehicles.length > 0">
            <div class="col-md-3" style="display:flex" 
                v-for="(vehicle,key) in vehicles" :key="key">
                <div class="card m-2 p-2" style="width: 18rem;">
                    <!-- <img src="images/{{ vehicle.image }}" class="card-img-top" alt="..."> -->
                    <div class="card-body">
                    <h5 class="card-title">{{ vehicle.name }}</h5>
                    <h5 class="card-title">Make: ${{ vehicle.make }}</h5>
                    <hr>
                    <!-- <p class="card-text">{{ $product->description}} </p> -->
                    <router-link :to='{ name:"vehicleShow" , params:{ id:vehicle.id } }' class="btn btn-light">Show More</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
export default {
    name:"vehicles",
    data(){
        return{
            vehicles:[]
        }
    },
    mounted(){
        this.getVehicles()
    },
    methods:{
        async getVehicles(){
            await this.axios.get('/api/vehicle').then(response=>{
                this.vehicles = response.data
            }).catch(error=>{
                console.log(error)
                this.vehicles = []
            })
        },
        deleteVehicle(id){
            if(confirm("Are you sure to delete this vehicle ?")){
                this.axios.delete('/api/vehicle/'+id).then(response=>{
                    this.getVehicles()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>