<template>
    <div class="container">
        ...
              <div class="card-body">
                 {{ message }}
              </div>
        ...
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: {
            message: String
        }
    }
</script>