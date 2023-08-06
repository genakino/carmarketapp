const Welcome = () => import('./components/Welcome.vue')
const VehicleList = () => import('./components/vehicle/list.vue')
const VehicleCreate = () => import('./components/vehicle/add.vue')
const VehicleEdit = () => import('./components/vehicle/edit.vue')
export const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
    },
    {
        name: 'vehicleList',
        path: '/vehicle',
        component: VehicleList
    },
    {
        name: 'vehicleEdit',
        path: '/vehicle/:id/edit',
        component: VehicleEdit
    },
    {
        name: 'vehicleAdd',
        path: '/vehicle/add',
        component: VehicleCreate
    }
]