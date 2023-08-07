<template>
    <div class="container mt-5 mb-5">
        <h2>Add Vehicle</h2>
        <hr>

        <form @submit="create" enctype="multipart/form-data">
            <div class="form-group row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-8">
                    <!-- <input type="file" class="form-control" @change="onChange"> -->
                    <input type="text" class="form-control" v-model="vehicle.image" placeholder="Enter Image">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.name" placeholder="Enter Name">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="make" class="col-sm-2 col-form-label">Make</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.make" placeholder="Enter Car Make">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="model" class="col-sm-2 col-form-label">Model</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.model" placeholder="Enter Model">
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
                        <option value="" disabled>Choose Gearbox</option>
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
                        <option value="" disabled>Choose Fuel Type</option>
                        <option v-for="fuel_type in fuel_type_options" :value="fuel_type.value">
                            {{ fuel_type.text }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="price" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.price" placeholder="Enter Price">
                </div>
            </div>

            <div class="form-group row  mb-3">
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary">Add Vehicle</button>
                </div>
            </div>
        </form>
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
                gearbox:"",
                fuel_type:"",
                image:"",
                price:""
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
    methods:{
        onChange(e) {
            let image = e.target.files[0];
            this.vehicle.image = image;
            console.log('image xx = ' + JSON.stringify(this.vehicle.image));
        },
        async create(e){
            e.preventDefault();

            let existingObj = this;
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            let data = new FormData();
            data.append('this.vehicle.image', this.vehicle.image);

             console.log(JSON.stringify(data));

            await this.axios.post('/api/vehicle', this.vehicle).then(response=>{
                this.$router.push({name:"vehicleList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>