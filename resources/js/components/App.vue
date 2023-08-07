<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <!-- <router-link to="/vehicles" class="navbar-brand" href="#"></router-link> -->
                <h2 class="navbar-brand">CarMarketApp</h2>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item" exact-active-class="active">
                            <router-link to="/vehicles" class=" nav-link">Vehicles</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </main>
</template>
<script>
    export default {}
</script>