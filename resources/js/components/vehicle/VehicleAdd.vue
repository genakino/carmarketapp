<template>
    <div class="container mt-5 mb-5">
        <h2>Add Vehicle</h2>
        <hr>
        <form @submit.prevent="create" enctype="multipart/form-data">
            <div class="form-group row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-8">
                    <input type="file" name ="image" class="form-control" @change="onChange" required>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.name" placeholder="Enter Name" required>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="make" class="col-sm-2 col-form-label">Make</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.make" placeholder="Enter Car Make" required>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="model" class="col-sm-2 col-form-label">Model</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.model" placeholder="Enter Model" required>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="year" class="col-sm-2 col-form-label">Year</label>
                <div class="col-sm-8">
                    <select name="year" class="form-control" v-model="vehicle.year" required>
                        <option value="" disabled>Choose Year</option>
                        <option v-for="year in yearList" v-bind:key="year" :value="year">
                            {{ year }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="gearbox" class="col-sm-2 col-form-label">Gearbox</label>
                <div class="col-sm-8">
                    <select name="gearbox" class="form-control" v-model="vehicle.gearbox" required>
                        <option value="" disabled>Choose Gearbox</option>
                        <option v-for="gearbox in gearbox_options" v-bind:key="gearbox.value" :value="gearbox.value">
                            {{ gearbox.text }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="fuel_type" class="col-sm-2 col-form-label">Fuel Type</label>
                <div class="col-sm-8">
                    <select name="fuel_type" class="form-control" v-model="vehicle.fuel_type" required>
                        <option value="" disabled>Choose Fuel Type</option>
                        <option v-for="fuel_type in fuel_type_options" v-bind:key="fuel_type.value" :value="fuel_type.value">
                            {{ fuel_type.text }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="price" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" v-model="vehicle.price" placeholder="Enter Price" required>
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
                {text: 'Automatic', value:'Automatic'},
                {text: 'Manual', value:'Manual'}
            ],
            fuel_type_options: [
                {text: 'Petrol', value:'Petrol'},
                {text: 'Diesel', value:'Diesel'}
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
        },
        async create(){
            const data = new FormData();
            data.append('name', this.vehicle.name);
            data.append('make', this.vehicle.make);
            data.append('model', this.vehicle.model);
            data.append('year', this.vehicle.year);
            data.append('gearbox', this.vehicle.gearbox);
            data.append('fuel_type', this.vehicle.fuel_type);
            data.append('image', this.vehicle.image);
            data.append('price', this.vehicle.price);

            await this.axios.post('/api/vehicle', data)
            .then(response=>{
                alert(response.data.message);
                this.$router.push({name:"vehicleList"});
            }).catch(error=>{
                console.log(error);
            })
        }
    }
}
</script>