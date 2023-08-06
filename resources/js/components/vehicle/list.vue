<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"vehicleAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Vehicle</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="vehicles.length > 0">
                                <tr v-for="(vehicle,key) in vehicles" :key="key">
                                    <td>{{ vehicle.id }}</td>
                                    <td>{{ vehicle.name }}</td>
                                    <td>
                                        <router-link :to='{ name:"vehicleEdit" , params:{ id:vehicle.id } }' class="btn btn-success">Edit</router-link>
                                        <button type="button" @click="deleteVehicle(vehicle.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Vehicles Found.</td>
                                </tr>
                            </tbody>
                        </table>
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