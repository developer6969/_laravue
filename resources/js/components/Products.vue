<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Product Component</div>

                    <div class="card-body">
                        I'm an Product component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        methods: {
            some() {
                axios.get('/api/user')
                .then(response => {
                    console.log(response.data);
                });
            },
        },
        created() {
            this.some();
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
